<?php

class DefaultController extends Controller
{
    public function filters()
    {
        return array(
            'ajaxOnly +order, ticket',
            'postOnly +order, ticket'
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
//        echo 'hi';
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'

        $visit         = new Visits();
        $visit->source = isset($_GET['source']) ? $_GET['source'] : 1;
        $p             = Yii::app()->request->cookies['p'];
        $active        = CHtml::listData(Page::model()->active()->findAll(), 'id', 'id');
        if (is_null($p)) {
            $page = Visits::model()->withActive($active)->getMin($visit->source);
            if (is_null($page))
                $page = array_rand($active);
            Yii::app()->request->cookies['p'] = new CHttpCookie('p', $page);
        } else {
            $page = Yii::app()->request->cookies['p']->value;
        }
        if (!in_array($page, $active)) {
            $page = Visits::model()->withActive($active)->getMin($visit->source);
        }
        $visit->page = $page;
        $visit->ip   = Yii::app()->request->userHostAddress;
        $d           = new DateTime();
        $visit->date = $d->format('Y-m-d H:i:s');
        $visit->save();
        $currentPage = Page::model()->findByPk($page);
        while (is_null($currentPage) OR !in_array($page, $active)) {
            $page        = array_rand($active);
            $currentPage = Page::model()->findByPk($page);
        }
        $html = $currentPage->html;

        Yii::app()->request->cookies['p'] = new CHttpCookie('p', $page);

        echo str_replace('{{source}}', $visit->source, $html);
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionOrder()
    {
        $model = new Orders;
        if (isset($_POST['Orders'])) {
            $model->attributes = $_POST['Orders'];
            $model->type       = Orders::TYPE_PHONE;
            $model->page       = Yii::app()->request->cookies['p']->value;
            $model->source     = isset($_GET['source']) ? (int) $_GET['source'] : 1;
            $model->ip         = Yii::app()->request->userHostAddress;
            $d                 = new DateTime();
            $model->date       = $d->format('Y-m-d H:i:s');
            if ($model->save()) {
                $notifier = Settings::model()->findAll();
                $phones   = CHtml::listData($notifier, 'id', 'phone');
//                $email    = CHtml::listData($notifier, 'id', 'email');
                $this->sendEmail($model, $notifier);
                $result         = $this->sendSms($model, $phones);
                $model->comment = $result->sendresult->error ? 'Смс не отправилось' : 'Смс ушло';
            } else {
                echo CVarDumper::dumpAsString($model->errors, 10, TRUE);
            }
        }
    }

    public function actionTicket()
    {
        $model = new Orders;
        if (isset($_POST['Orders'])) {
//            $model->ticket     = $_POST['Orders']['type'];
            $model->attributes = $_POST['Orders'];
            $model->type       = Orders::TYPE_TICKET;
            $model->source     = $_GET['source'] ? (int) $_GET['source'] : 1;
            $model->page       = Yii::app()->request->cookies['p']->value;
            $model->ip         = Yii::app()->request->userHostAddress;
            $d                 = new DateTime();
            $model->date       = $d->format('Y-m-d H:i:s');
            if ($model->save()) {
                $notifier = Settings::model()->findAll();
                $phones   = CHtml::listData($notifier, 'id', 'phone');
//                $email    = CHtml::listData($notifier, 'id', 'email');
                $mail           = $this->sendEmail($model, $notifier);
                $result         = $this->sendSms($model, $phones);
                $model->comment = $result->sendresult->error ? 'Смс не отправилось' : 'Смс ушло';
                echo var_dump($mail);
            } else {
                echo CVarDumper::dumpAsString($model->errors, 10, TRUE);
//                echo CVarDumper::dumpAsString($_POST);

            }
        }

    }

    protected function sendSms($model, $phones)
    {
        $client = new SoapClient ("http://smsc.ru/sys/soap.php?wsdl");
        $body   = "Спасибо, $model->name. Ваша заявка принята. Мы вам перезвоним. Режим работы нашей компании с 10:00 до 18:00";
        $result = $client->send_sms(array("login" => "motasystems", "psw" => "motasmscsystems", "phones" => $model->phone, "mes" => $body, "id" => "", "sender" => Yii::app()->params['siteName'], "time" => 0));
        foreach ($phones as $phone) {
            if (!empty($phone)) {
                $ownBody = "
                Новый клиент с сайта Васильева.\r\n
                Имя: $model->name\r\n
                Телефон: $model->phone\r\n
                ";
                $client->send_sms(array("login" => "motasystems", "psw" => "motasmscsystems", "phones" => $phone, "mes" => $ownBody, "id" => "", "sender" => Yii::app()->params['siteName'], "time" => 0));
            }
        }

        return $result;
    }

    /**
     * @param $model
     * @param $notifier
     */
    protected function sendEmail($model, $notifier)
    {
        $subject = Yii::app()->params->siteName.' site order';
        $headers = "From: ".Yii::app()->params->siteName." <{pr@zimaevents.ru}>\r\n" .
            "Reply-To: pr@zimaevents.ru\r\n" .
            "MIME-Version: 1.0\r\n" .
            "Content-type: text/plain; charset=UTF-8";

        $body = "Новый клиент с вашего сайта\r\n" .
            "Имя: $model->name\r\n" .
            "Телефон: $model->phone\r\n" .
            "E-mail: $model->mail\r\n" .
            "Дата регистрации: " . Yii::app()->dateFormatter->formatDateTime($model->date, 'long', 'short');
        if ($model->type == Orders::TYPE_TICKET) {
            $types  = Orders::type();
            $ticket = Orders::ticketName($model->ticket);
            $type   = isset($types[$model->type]) ? $types[$model->type] : 'Не выбран';
            $pay    = Orders::payType($model->pay);
            $body .= "Тип заявки: $type\r\n";
            $body .= "Тип билета:  $ticket\r\n";
            $body .= "Тип оплаты:  $pay\r\n";
            $body .= "Количество билетов:  $$model->quantity\r\n";
        }
        $sended = '';
        foreach ($notifier as $mail) {
            $sended .= mail($mail->email, $subject, $body, $headers);
        }

        return $sended;
//        mail(Yii::app()->params['adminEmail'], $subject, $body, $headers);
    }

    public function actionNewrequest()
    {
        $model = new Orders;
        if (isset($_POST['Orders'])) {
            $model->type       = Orders::TYPE_REQUEST;
            $model->ticket     = $_POST['Orders']['type'];
            $model->attributes = $_POST['Orders'];
            $model->page       = Yii::app()->request->cookies['p']->value;
            $model->source     = isset($_GET['source']) ? (int) $_GET['source'] : 1;
            $model->ip         = Yii::app()->request->userHostAddress;
            $d                 = new DateTime();
            $model->date       = $d->format('Y-m-d H:i:s');
            if ($model->save()) {
                $notifier = Settings::model()->findAll();
                $phones   = CHtml::listData($notifier, 'id', 'phone');
//                $email    = CHtml::listData($notifier, 'id', 'email');
                $this->sendEmail($model, $notifier);
                $result         = $this->sendSms($model, $phones);
                $model->comment = $result->sendresult->error ? 'Смс не отправилось' : 'Смс ушло';
                $this->redirect('/');
            } else {
                echo $model->errors;
            }
        }
    }
}