<?php
/* @var $this ProductOptionController */
/* @var $model ProductOption */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-option-form',
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
		<?php echo $form->labelEx($model,'productIOptionGroupd', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'productIOptionGroupd',array('size'=>20,'maxlength'=>20, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'productIOptionGroupd'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'title', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>200, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'title'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'description', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'description'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'image', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php if($this->action->id=='update') echo CHtml::image(Yii::app()->baseUrl.$model->image, '', array('style'=>'width:150px;'));?>
			<?php echo $form->textField($model,'image',array('size'=>60,'maxlength'=>255, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'image'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'priceValue', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'priceValue',array('size'=>15,'maxlength'=>15, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'priceValue'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'pricePercent', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'pricePercent',array('size'=>5,'maxlength'=>5, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'pricePercent'); ?>
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