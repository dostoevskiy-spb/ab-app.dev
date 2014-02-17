<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs = array(
    'Пользователи' => array('admin'),
    'Список',
);

$this->menu = array(
    array('label' => 'Добавить пользователя', 'url' => array('create')),
);
?>

<h1>Список пользователей</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'            => 'users-grid',
    'itemsCssClass' => 'default',
    'template'      => '{items} {pager}',
    'dataProvider'  => $model->search(),
    'filter'        => $model,
    'columns'       => array(
        'username',
        array(
            'class'    => 'CButtonColumn',
            'header'   => 'Возможные действия',
            'template' => '{update} {delete}',
        ),
    ),
)); ?>
