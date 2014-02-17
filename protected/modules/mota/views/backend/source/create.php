<?php
/* @var $this SourceController */
/* @var $model Source */

$this->menu=array(
	array('label'=>'Список источников', 'url'=>array('admin')),
);
?>

<h1>Новый источник</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>