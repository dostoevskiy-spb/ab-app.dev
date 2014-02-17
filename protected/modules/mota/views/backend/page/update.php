<?php
/* @var $this PageController */
/* @var $model Page */

$this->menu=array(
	array('label'=>'Новый шабллон', 'url'=>array('create')),
	array('label'=>'Просмотр шаблона', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Список шаблонов', 'url'=>array('admin')),
);
?>

<h1>Редактирование шаблона <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>