<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

/*
  $this->pageTitle=Yii::app()->name . ' - Login';
  $this->breadcrumbs=array(
  'Вход',
  );
 *
 */
?>

<h1>Вход в панель управления</h1>

<p>Пожалуйста, введите логин и пароль для входа в систему.</p>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
            ));
    ?>

    <p class="note">Поля, отмеченные знаком <span class="required">*</span>, обязательны для заполнения.</p>

    <table class='login'>
        <tr>
            <td><?php echo $form->labelEx($model, 'username'); ?></td>
            <td>
                <?php echo $form->textField($model, 'username'); ?>
                <div class='clear'></div>
                <?php echo $form->error($model, 'username'); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model, 'password'); ?></td>
            <td>
                <?php echo $form->passwordField($model, 'password'); ?>
                <div class='clear'></div>
                <?php echo $form->error($model, 'password'); ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?php echo $form->checkBox($model, 'rememberMe'); ?>
                <?php echo $form->label($model, 'rememberMe'); ?>
                <div class='clear'></div>
                <?php echo $form->error($model, 'rememberMe'); ?>
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                <nav class='button_set'>
        <?php echo CHtml::submitButton('Вход', array('class' => 'button')); ?>
    </nav>
            </td>
        </tr>
    </table>

    <?php $this->endWidget(); ?>
</div><!-- form -->
