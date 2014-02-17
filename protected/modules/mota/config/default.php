<?php
Yii::setPathOfAlias('mota', __DIR__ . '/../');
//echo var_dump(Yii::getPathOfAlias('mota'));
//die();
return array(
    'module'     => array(
        'class'             => 'application.modules.mota.MotaModule',
        'modules'           => array(
            'users',
        )
    ),
    'import'     => array(
        'application.modules.mota.models.*',
        'application.modules.mota.components.*',
        'application.modules.controllers.*',
    ),
    'preload'    => array(
        'log',
    ),
    'components' => array(
        'image'  => array(
            'class'  => 'mota.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver' => 'GD',
            // ImageMagick setup path
            'params' => array('directory' => '/opt/local/bin'),
        ),
        /*'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'mota-ab/site/error',
        ),*/
        'log'    => array(
            'class'  => 'CLogRouter',
            'routes' => array(
                array(
                    'class'     => 'mota.extensions.yii-debug-toolbar-master.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters' => array('127.0.0.1', '176.117.143.48', '109.167.206.169', '178.236.140.18'),
                    'enabled'   => defined('YII_DEBUG')
                ),
            ),
        ),
        # Системная база данных
        'motaDb' => array(
            'class'            => 'CDbConnection',
            'connectionString' => 'sqlite:' . $_SERVER['DOCUMENT_ROOT'] . '/protected/modules/mota/data/private.sl3'
        ),
    ),
    'rules'      => array(
        '/'                                              => 'mota/default/index',
        'backend/<act:(login|logout)>'                   => 'mota-ab/backend/site/<act>',
        'backend'                                        => 'mota-ab/backend/site',
        'backend/<controller:\w+>/<id:\d+>'              => 'mota-ab/backend/<controller>/view',
        'backend/<controller:\w+>/<action:\w+>/<id:\d+>' => 'mota-ab/backend/<controller>/<action>',
        'backend/<controller:\w+>/<action:\w+>'          => 'mota-ab/backend/<controller>/<action>',
        'order'                                          => 'site/order',
        'order/<action>'                                 => 'site/<action>',
        'newRequest'                                     => 'site/newRequest',
    ),
);