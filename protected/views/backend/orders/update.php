<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->menu=array(
//	array('label'=>'Create Orders', 'url'=>array('create')),
	array('label'=>'Список заявок', 'url'=>array('admin')),
);
?>

<h1>Редактирование заявки <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>