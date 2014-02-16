<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'                   => 'users-form',
        'enableAjaxValidation' => TRUE,
        'clientOptions'        => array(
            'inputContainer' => 'tr'
        ),
    )); ?>
    <?php echo $form->errorSummary($model); ?>
    <table class='edit'>
        <? if ($model->isNewRecord) { ?>
            <tr>
                <td>
                    <?php echo $form->labelEx($model, 'username'); ?>
                </td>
                <td>
                    <?php echo $form->textField($model, 'username', array('size' => 30, 'maxlength' => 30)); ?>
                    <?php echo $form->error($model, 'username')?>
                </td>
            </tr>
        <? } ?>
        <tr>
            <td>
                <?php echo $form->labelEx($model, 'password'); ?>
            </td>
            <td>
                <?php echo $form->passwordField($model, 'password', array('value' => ''))?>
                <!--                <input name='Users[password]' type='password'/>-->
                <?php echo $form->error($model, 'password')?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $form->labelEx($model, 'password'); ?>
            </td>
            <td>
                <?php echo $form->passwordField($model, 'password_repeat', array('value' => ''))?>
                <!--                <input name="Users[password_repeat]" type='password'/>-->
                <?php echo $form->error($model, 'password_repeat')?>
            </td>
        </tr>
        <tr>
            <td colspan=2>
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class' => 'button')); ?>
            </td>
        </tr>
    </table>
    <?php $this->endWidget(); ?>

</div><!-- form -->