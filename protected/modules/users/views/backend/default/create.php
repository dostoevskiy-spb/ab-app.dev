<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs = array(
    'Пользователи' => array('admin'),
    'Новый пользователь',
);

$this->menu = array(
    array('label' => 'Список пользователей', 'url' => array('admin')),
);
?>

    <h1>Новый пользователь</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>