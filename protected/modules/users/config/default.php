<?php
Yii::setPathOfAlias('users', __DIR__ . '/..');

return array(
    'import'     => array(
        'users.models',
        'users.components'
    ),
    'components' => array(
        'rules' => array(
            'backend/users' => 'users/backend/default',
//            'order'                                          => 'site/order',
//            'order/<action>'                                 => 'site/<action>',
//            'newRequest'                                     => 'site/newRequest',
        ),
    ),
);