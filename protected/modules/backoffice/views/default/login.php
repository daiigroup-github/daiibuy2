<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
	'Login',
);
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'login-form',
	'enableClientValidation' => true,
	'clientOptions' => array(
		'validateOnSubmit' => true,
	),
	'htmlOptions' => array('class' => 'form-signin', 'role'=>'form'),
	));
?>

<h2 class="form-signin-heading">Please sign in</h2>

<?php
echo $form->emailField($model, 'username', array(
	'class' => 'form-control', 'placeholder'=>'Email'));
?>
<?php echo $form->error($model, 'username'); ?>

<?php
echo $form->passwordField($model, 'password', array(
	'class' => 'form-control', 'placeholder'=>'Password'));
?>
<?php echo $form->error($model, 'password'); ?>

<label class="checkbox">
	<?php echo $form->checkbox($model, 'rememberMe'); ?> Remember me
</label>

<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

<?php $this->endWidget(); ?>
