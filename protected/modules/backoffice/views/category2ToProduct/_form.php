<?php
/* @var $this Category2ToProductController */
/* @var $model Category2ToProduct */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category2-to-product-form',
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
		<?php echo $form->labelEx($model,'productId', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'productId',array('size'=>20,'maxlength'=>20, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'productId'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'groupName', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'groupName',array('size'=>60,'maxlength'=>200, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'groupName'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'quantity', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'quantity', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'quantity'); ?>
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
		<?php echo $form->labelEx($model,'sortOrder', array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'sortOrder', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'sortOrder'); ?>
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