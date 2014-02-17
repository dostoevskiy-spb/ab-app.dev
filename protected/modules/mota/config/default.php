<?php
Yii::setPathOfAlias('mota', __DIR__ . '/../');
//echo var_dump(Yii::getPathOfAlias('mota'));
//die();
return array(
    'module'     => array(
        'class' => 'application.modules.mota.MotaModule',
    ),
    'import'     => array(
        'mota.models.*',
        'mota.components.*',
    ),
    'preload'    => array(
        'log',
    ),
    'components' => array(
        'image'        => array(
            'class'  => 'mota.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver' => 'GD',
            // ImageMagick setup path
            'params' => array('directory' => '/opt/local/bin'),
        ),
        'user'         => array(
            'allowAutoLogin' => TRUE,
            'loginUrl'       => array('backend/login'),
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'mota/default/error',
        ),
        'log'          => array(
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
        'motaDb'       => array(
            'class'            => 'CDbConnection',
            'connectionString' => 'sqlite:' . $_SERVER['DOCUMENT_ROOT'] . '/protected/modules/mota/data/private.sl3'
        ),
    ),
    'rules'      => array(
        '/'                                                             => 'mota/default/index',
        'backend/<act:(login|logout)>'                                  => 'mota/backend/default/<act>',
        'backend'                                                       => 'mota/backend/default',
        'backend/<con:(visits|orders|settings|page|statistics|source)>' => 'mota/backend/<con>',
        'order'                                                         => 'mota/default/order',
        'order/<action>'                                                => 'mota/default/<action>',
        'newRequest'                                                    => 'mota/default/newRequest',
    ),
);