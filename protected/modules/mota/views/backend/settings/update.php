<?php
/* @var $this SettingsController */
/* @var $model Settings */

$this->menu = array(
    array('label' => 'Добавить получателя', 'url' => array('create')),
    array('label' => 'Список получателей', 'url' => array('admin')),
);
?>

    <h1>Редактирование получателя уведомлений №<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>