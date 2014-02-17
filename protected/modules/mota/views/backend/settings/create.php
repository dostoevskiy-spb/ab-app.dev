<?php
/* @var $this SettingsController */
/* @var $model Settings */

$this->menu = array(
    array('label' => 'Список получателей', 'url' => array('admin')),
);
?>

    <h1>Добавить получателя уведомлений</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>