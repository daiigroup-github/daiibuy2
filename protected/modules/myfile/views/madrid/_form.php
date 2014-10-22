<?php
/* @var $this MadridController */
/* @var $model Order */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-form',
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
		<?php echo $form->labelEx($model,'userId', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'userId',array('size'=>20,'maxlength'=>20, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'userId'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'supplierId', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'supplierId',array('size'=>20,'maxlength'=>20, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'supplierId'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'provinceId', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'provinceId',array('size'=>20,'maxlength'=>20, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'provinceId'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'token', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'token',array('size'=>60,'maxlength'=>200, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'token'); ?>
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
		<?php echo $form->labelEx($model,'type', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'type', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'type'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'total', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'total',array('size'=>15,'maxlength'=>15, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'total'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'totalIncVAT', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'totalIncVAT',array('size'=>15,'maxlength'=>15, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'totalIncVAT'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'remark', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textArea($model,'remark',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'remark'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'status', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->checkBox($model,'status'); ?>
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