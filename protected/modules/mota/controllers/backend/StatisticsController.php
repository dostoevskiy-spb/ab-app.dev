<?php

class StatisticsController extends BackendController
{
    public function actionAdmin()
    {
        $visits = new Visits('search');
        $visits->unsetAttributes(); // clear any default values
        $criteria = new CDbCriteria(array(
            'select'   => 'ip',
            'distinct' => TRUE,
        ));
        $uniq     = count($visits->findAll($criteria));
        $all      = $visits->count();
        $orders = new Orders('search');
        $orders->unique();
        $this->render('index', array(
            'visits' => $visits,
            'orders' => $orders,
            'uniq'  => $uniq,
            'all'   => $all,
        ));
    }

}