<?php
/* @var $this PageController */
/* @var $model Page */

$this->menu = array(
    array('label' => 'Новый шаблон', 'url' => array('create')),
);

?>

<h1>Список шаблонов</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'            => 'page-grid',
    'dataProvider'  => $model->search(),
    'itemsCssClass' => 'default',
    'filter'        => $model,
    'columns'       => array(
        'id',
//        'html',
        array(
            'name'  => 'active',
            'value' => function ($data) {
                return Page::getStateProperties($data->active);
            }
        ),
        array(
            'class' => 'CButtonColumn',
        ),
    ),
)); ?>
