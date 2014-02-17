<?php
Yii::setPathOfAlias('users', __DIR__ . '/..');

return array(
    'import' => array(
        'users.models',
        'users.components'
    ),
    'rules'  => array(
        'backend/users'                                   => 'users/backend/default/admin',
        'backend/users/<action:(delete|update)>/<id:\d+>' => 'users/backend/default/<action>/<id>',
        'backend/users/<action:(create|admin)>'           => 'users/backend/default/<action>',
    ),
);