<?php
/* @var $this SettingsController */
/* @var $model Settings */

$this->menu = array(
    array('label' => 'Добавить получателя', 'url' => array('create')),
);

?>

<h1>Настройки уведомлений</h1>



<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'            => 'settings-grid',
    'itemsCssClass' => 'default',
    'dataProvider'  => $model->search(),
    'filter'        => $model,
    'columns'       => array(
        'name',
        'phone',
        'email',
        array(
            'class'    => 'CButtonColumn',
            'template' => '{update} {delete}'
        ),
    ),
)); ?>
