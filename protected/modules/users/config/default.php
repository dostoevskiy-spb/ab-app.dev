<?php
Yii::setPathOfAlias('users', __DIR__ . '/..');

return array(
    'import'     => array(
        'users.models',
        'users.components'
    ),
    'components' => array(
        'rules' => array(
            ''                                               => 'mota-ab/site/index',
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