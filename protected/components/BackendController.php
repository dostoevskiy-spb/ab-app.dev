<?php
Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');
/**
 * Created by JetBrains PhpStorm.
 * User: mota-systems
 * Date: 08.02.13
 * Time: 1:53
 * To change this template use File | Settings | File Templates.
 */
class BackendController extends Controller
{
    public $layout = '//layouts/motacms';
    public $defaultAction = 'admin';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
//            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),)
        );
    }

}
