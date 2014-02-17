<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'                   => 'page-form',
        'enableAjaxValidation' => FALSE,
    )); ?>

    <?php echo $form->errorSummary($model); ?>
    <table class="edit">
        <tr>
            <td>
                <?php echo $form->labelEx($model, 'active'); ?>
            </td>
            <td>
                <?php echo $form->dropDownList($model, 'active', Page::getStateProperties()); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2"><?php echo $form->labelEx($model, 'html'); ?></td>
        </tr>
        <tr>
            <td colspan="2">
                <?php echo $form->textArea($model, 'html', array('rows' => 6, 'cols' => 50)); ?>
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