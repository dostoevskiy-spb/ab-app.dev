<?php
Yii::setPathOfAlias('mota-ab', 'application.modules.mota-ab');

return array(
    'components' => array(
        'image'  => array(
            'class' => 'mota-ab.extensions.image.Image',
        ),
        'log'    => array(
            'routes' => array(
                array(
                    'class'     => 'mota-ab.extensions.yii-debug-toolbar-master.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters' => array('127.0.0.1', '176.117.143.48', '109.167.206.169', '178.236.140.18'),
                    'enabled'   => defined('YII_DEBUG')
                ),
            ),
        ),
        # Системная база данных
        'motaDb' => array(
            'class'            => 'CDbConnection',
            'connectionString' => 'sqlite:' . $_SERVER['DOCUMENT_ROOT'] . '/protected/modules/mota-ab/data/private.sl3'
        ),
        'rules'  => array(
            ''                                               => '',
            'backend/<act:(login|logout)>'                   => 'mota-ab/backend/site/<act>',
            'backend'                                        => 'mota-ab/backend/site',
            'backend/<controller:\w+>/<id:\d+>'              => 'mota-ab/backend/<controller>/view',
            'backend/<controller:\w+>/<action:\w+>/<id:\d+>' => 'mota-ab/backend/<controller>/<action>',
            'backend/<controller:\w+>/<action:\w+>'          => 'mota-ab/backend/<controller>/<action>',
            'order'                                          => 'site/order',
            'order/<action>'                                 => 'site/<action>',
            'newRequest'                                     => 'site/newRequest',
        ),
    ),
);