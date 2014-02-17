<?php
/* @var $this SettingsController */
/* @var $model Settings */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'                   => 'settings-form',
        'enableAjaxValidation' => FALSE,
    )); ?>


    <?php echo $form->errorSummary($model); ?>

    <table class='edit'>
        <tr>
            <td>
                <?php echo $form->labelEx($model, 'name'); ?>
            </td>
            <td>
                <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'name'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $form->labelEx($model, 'phone'); ?>
            </td>
            <td>
                <?php echo $form->textField($model, 'phone', array('size' => 60, 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'phone'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $form->labelEx($model, 'email'); ?>
            </td>
            <td>
                <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'email'); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
            </td>
        </tr>
    </table>

    <?php $this->endWidget(); ?>

</div><!-- form -->