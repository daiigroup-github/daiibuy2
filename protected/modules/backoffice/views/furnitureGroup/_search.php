<?php
/* @var $this FurnitureGroupController */
/* @var $model FurnitureGroup */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'furnitureGroupId'); ?>
		<?php echo $form->textField($model,'furnitureGroupId',array('size'=>20,'maxlength'=>20, 'class'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'categoryId'); ?>
		<?php echo $form->textField($model,'categoryId',array('size'=>20,'maxlength'=>20, 'class'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>200, 'class'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $this->widget('ext.editMe.widgets.ExtEditMe', array('model'=>$model,'attribute'=>'description',
				//'filebrowserImageUploadUrl' => Yii::app()->createUrl('admin/product/uploadFile'),
				'filebrowserImageBrowseUrl'=>Yii::app()->request->baseUrl . '/ext/kcfinder/browse.php?type=files&cms=yii',)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'image'); ?>
		<?php echo $form->fileField($model,'image',array('class'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->checkBox($model,'status', array('class'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'createDateTime'); ?>
		<?php echo $form->textField($model,'createDateTime', array('class'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updateDateTime'); ?>
		<?php echo $form->textField($model,'updateDateTime', array('class'=>'')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->