<?php

class VisitsController extends BackendController
{


    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }


    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Visits('search');
        $model->unsetAttributes(); // clear any default values
        $criteria = new CDbCriteria(array(
            'select'   => 'ip',
            'distinct' => TRUE,
        ));
        if (isset($_GET['Visits'])) {
            $model->attributes = $_GET['Visits'];
            $uniq              = count($model->findAll($criteria));
        } else {
            $uniq = count($model->findAll($criteria));
        }
        $all = $model->count();
        $this->render('admin', array(
            'model' => $model,
            'uniq'  => $uniq,
            'all'   => $all,
        ));
    }

    public function actionDeleteAll(){
        Visits::model()->deleteAll();
        $this->redirect('admin');
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Visits the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Visits::model()->findByPk($id);
        if ($model === NULL)
            throw new CHttpException(404, 'The requested page does not exist.');

        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Visits $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'visits-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
