<?php
/* @var $this PageController */
/* @var $model Page */

$this->menu=array(
	array('label'=>'Список шаблонов', 'url'=>array('admin')),
);
?>

<h1>Новый шаблон</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>