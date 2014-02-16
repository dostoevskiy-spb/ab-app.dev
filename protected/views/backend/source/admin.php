<?php
/* @var $this SourceController */
/* @var $model Source */

$this->menu=array(
	array('label'=>'Добавить источник', 'url'=>array('create')),
);

?>

<h1>Список источников</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'source-grid',
	'dataProvider'=>$model->search(),
    'itemsCssClass'   => 'default',
    'filter'=>$model,
	'columns'=>array(
		'title',
        array(
            'value'=>function($data){
                return Yii::app()->createAbsoluteUrl('').'/?source='.$data->id;
            },
            'header'=>'Ссылка для использования'
        ),
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update} {delete}'
		),
	),
)); ?>
