<?
$this->menu = array(
    array('label' => 'Удалить посещения', 'url' => array('deleteAll'), 'linkOptions' => array('submit' => array('deleteAll'), 'confirm' => 'Вы действительно хотите очистить список посещений?')),
);
?>
<h1>Посещения</h1>
<ul>
    <li id="uniq_vis">Уникальных: <?= $uniq ?></li>
    <li id="all_vis">Всего: <?= $all ?></li>
</ul>
<?php
$this->widget('application.components.CustomGridView', array(
    'id'              => 'visits-grid',
    'dataProvider'    => $model->search(),
    'filter'          => $model,
    'itemsCssClass'   => 'default',
    'enableHistory'   => TRUE,
    'columns'         => array(
        array(
            'name'        => 'id',
            'htmlOptions' => array('width' => '10px'),
        ),
//        'ip',
        array(
            'name'   => 'source',
            'filter' => CHtml::listData(Source::model()->findAll(), 'id', 'title'),
            'value'=>function($data){
               $source = $data->sourceName;
                return is_null($source) ? 'Неизвестный источник' : $source->title;
            },
        ),
        array(
            'name'        => 'page',
            'htmlOptions' => array('width' => '10px'),
        ),
        array(
            'name'   => 'date',
            'value'  => function ($data) {
                return Yii::app()->dateFormatter->formatDateTime($data->date, 'long', 'short');
            },
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'     => $model,
                'attribute' => 'date',
                'language'  => 'ru',
                'options'   => array(
                    'showAnim'        => 'fold',
                    'dateFormat'      => 'yy-mm-dd',
                    'changeMonth'     => 'true',
                    'showButtonPanel' => 'true',
                    'changeYear'      => 'true',
                ),
            ), TRUE)
        ),
//        array(
//            'class' => 'CButtonColumn',
//        ),
    ),
));
?>
