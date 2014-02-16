<?php
/* @var $this SourceController */
/* @var $model Source */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'                   => 'source-form',
        'enableAjaxValidation' => FALSE,
    )); ?>

    <table class="edit">
        <?php echo $form->errorSummary($model); ?>

        <tr>
            <td>
                <?php echo $form->labelEx($model, 'title'); ?>
            </td>
            <td>
                <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'title'); ?>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class'=>'button')); ?>
            </td>
        </tr>

        <?php $this->endWidget(); ?>
    </table>
</div><!-- form -->