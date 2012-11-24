<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>
<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array(
        'class' => 'form-signin',
    ),
)); ?>

<h2 class="form-signin-heading">Login</h2>

<?php // echo $form->labelEx($model,'username'); ?>
<?php echo $form->error($model, 'username', array('class' => 'text-error')); ?>
<?php echo $form->textField($model, 'username', array('class' => 'input-block-level', 'placeholder' => 'Numele utilizatorului')); ?>

<?php // echo $form->labelEx($model,'password'); ?>
<?php echo $form->error($model, 'password', array('class' => 'text-error')); ?>
<?php echo $form->passwordField($model, 'password', array('class' => 'input-block-level', 'placeholder' => 'Parola')); ?>

<label class="checkbox">
    <input type="checkbox" value="1" name="rememberMe">
    Tine-ma minte
</label>
<?php //echo $form->label($model,'rememberMe', array('class'=>'checkbox')); ?>
<?php //echo $form->checkBox($model,'rememberMe'); ?>
<?php // echo $form->error($model,'rememberMe'); ?>



<?php echo CHtml::submitButton('Login', array('class' => 'btn btn-large btn-primary')); ?>


<?php $this->endWidget(); ?>
<!-- form -->
