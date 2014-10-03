<?php
/* @var $this UserFileController */
/* @var $model UserFile */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'user-file-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array(
			'class'=>'form well'
		),
	));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="control-group">
		<?php echo $form->labelEx($model, 'userFileName'); ?>
		<?php
		echo $form->textField($model, 'userFileName', array(
			'size'=>60,
			'maxlength'=>500));
		?>
		<?php echo $form->error($model, 'userFileName'); ?>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model, 'type'); ?>
		<?php echo $form->dropdownList($model, 'type', User::model()->getAllUserType()); ?>
		<?php echo $form->error($model, 'type'); ?>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model, 'isShowInProductView'); ?>
		<?php echo $form->checkBox($model, 'isShowInProductView'); ?>
		<?php echo $form->error($model, 'isShowInProductView'); ?>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model, 'isPublic'); ?>
		<?php echo $form->checkBox($model, 'isPublic'); ?>
		<?php echo $form->error($model, 'isPublic'); ?>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model, 'status'); ?>
		<?php echo $form->checkBox($model, 'status'); ?>
		<?php echo $form->error($model, 'status'); ?>
	</div>



	<div class="control-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->