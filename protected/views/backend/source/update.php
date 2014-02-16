<?php
/* @var $this SourceController */
/* @var $model Source */

$this->menu=array(
	array('label'=>'Добавить источник', 'url'=>array('create')),
	array('label'=>'Список источников', 'url'=>array('admin')),
);
?>

<h1>Редактирование источника <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>