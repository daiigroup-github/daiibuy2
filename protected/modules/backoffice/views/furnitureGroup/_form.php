<?php
/* @var $this FurnitureGroupController */
/* @var $model FurnitureGroup */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'furniture-group-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'categoryId', array('class'=>'')); ?>
		<?php echo $form->textField($model,'categoryId',array('size'=>20,'maxlength'=>20, 'class'=>'')); ?>
		<?php echo $form->error($model,'categoryId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title', array('class'=>'')); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>200, 'class'=>'')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description', array('class'=>'')); ?>
		<?php echo $this->widget('ext.editMe.widgets.ExtEditMe', array('model'=>$model,'attribute'=>'description',
				//'filebrowserImageUploadUrl' => Yii::app()->createUrl('admin/product/uploadFile'),
				'filebrowserImageBrowseUrl'=>Yii::app()->request->baseUrl . '/ext/kcfinder/browse.php?type=files&cms=yii',)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image', array('class'=>'')); ?>
		<?php echo $form->fileField($model,'image',array('class'=>'')); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status', array('class'=>'')); ?>
		<?php echo $form->checkBox($model,'status', array('class'=>'')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'createDateTime', array('class'=>'')); ?>
		<?php echo $form->textField($model,'createDateTime', array('class'=>'')); ?>
		<?php echo $form->error($model,'createDateTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updateDateTime', array('class'=>'')); ?>
		<?php echo $form->textField($model,'updateDateTime', array('class'=>'')); ?>
		<?php echo $form->error($model,'updateDateTime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->