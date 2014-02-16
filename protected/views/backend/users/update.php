<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Пользователи'=>array('admin'),
	'Редактирование',
);

$this->menu=array(
	array('label'=>'Добавить пользователя', 'url'=>array('create')),
	array('label'=>'Список пользователей', 'url'=>array('admin')),
);
?>

<h1>Редактирование пользователя <?php echo $model->username; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>