<?php
/* @var $this UserFileController */
/* @var $model UserFile */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'user-file-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array(
			'class'=>'form-horizontal',
		//'enctype' => 'multipart/form-data',
		),
	));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

		<?php echo $form->errorSummary($model, '', '', array(
			'class'=>'alert alert-danger')); ?>

	<div class="form-group">
			<?php echo $form->labelEx($model, 'userFileName', array(
				'class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
<?php if($this->action->id == 'update') echo CHtml::link('Show File', Yii::app()->baseUrl . $model->userFileName); ?>
		<?php echo $form->textField($model, 'userFileName', array(
			'size'=>60,
			'maxlength'=>500,
			'class'=>'form-control')); ?>
			<?php echo $form->error($model, 'userFileName'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model, 'type', array(
			'class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->dropDownList($model, 'type', User::model()->getAllUserType(), array(
				'class'=>'form-control')); ?>
<?php echo $form->error($model, 'type'); ?>
		</div>
	</div>
	<div class="form-group">
			<?php echo $form->labelEx($model, 'status', array(
				'class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
<?php echo $form->textField($model, 'status', array(
	'class'=>'form-control')); ?>
		<?php echo $form->error($model, 'status'); ?>
		</div>
	</div>
	<div class="form-group">
<?php echo $form->labelEx($model, 'isShowInProductView', array(
	'class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
<?php echo $form->textField($model, 'isShowInProductView', array(
	'class'=>'form-control')); ?>
			<?php echo $form->error($model, 'isShowInProductView'); ?>
		</div>
	</div>
	<div class="form-group">
	<?php echo $form->labelEx($model, 'isPublic', array(
		'class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
<?php echo $form->textField($model, 'isPublic', array(
	'class'=>'form-control')); ?>
<?php echo $form->error($model, 'isPublic'); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-9">
<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
	'class'=>'btn btn-primary')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->