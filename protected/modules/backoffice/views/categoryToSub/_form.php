<?php
/* @var $this CategoryToSubController */
/* @var $model CategoryToSub */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-to-sub-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		//'enctype' => 'multipart/form-data',
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model, '', '', array('class'=>'alert alert-danger')); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'categoryId', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'categoryId',array('size'=>20,'maxlength'=>20, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'categoryId'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'subCategoryId', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'subCategoryId',array('size'=>20,'maxlength'=>20, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'subCategoryId'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'isTheme', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'isTheme', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'isTheme'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'isSet', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'isSet', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'isSet'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'status', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'status', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'status'); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-9">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->