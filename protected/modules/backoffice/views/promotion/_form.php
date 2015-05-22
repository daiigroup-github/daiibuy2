<?php
/* @var $this PromotionController */
/* @var $model Promotion */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'promotion-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'form-horizontal', 
		'enctype' => 'multipart/form-data',),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model, '', '', array('class'=>'alert alert-error')); ?>

	<div class="control-group">
			<?php echo $form->labelEx($model,'partnerTypeId', array('class'=>'control-label')); ?>
		<div class='controls'>
			<?php echo $form->textField($model,'partnerTypeId',array('class'=>'input-block-level')); ?>
			<?php echo $form->error($model,'partnerTypeId'); ?>
		</div>
	</div>
	<div class="control-group">
			<?php echo $form->labelEx($model,'title', array('class'=>'control-label')); ?>
		<div class='controls'>
			<?php echo $form->textField($model,'title',array('class'=>'input-block-level')); ?>
			<?php echo $form->error($model,'title'); ?>
		</div>
	</div>
	<div class="control-group">
			<?php echo $form->labelEx($model,'description', array('class'=>'control-label')); ?>
		<div class='controls'>
			<?php $this->widget('ext.editMe.widgets.ExtEditMe', array(
					'model' => $model,
					'attribute' => 'description',
					'filebrowserImageBrowseUrl' => Yii::app()->request->baseUrl . '/ext/kcfinder/browse.php?type=files',
				)); ?>
			<?php echo $form->error($model,'description'); ?>
		</div>
	</div>
	<div class="control-group">
			<?php echo $form->labelEx($model,'creatorId', array('class'=>'control-label')); ?>
		<div class='controls'>
			<?php echo $form->textField($model,'creatorId',array('class'=>'input-block-level')); ?>
			<?php echo $form->error($model,'creatorId'); ?>
		</div>
	</div>
	<div class="control-group">
			<?php echo $form->labelEx($model,'startDateTime', array('class'=>'control-label')); ?>
		<div class='controls'>
			<?php echo $form->textField($model,'startDateTime', array('class'=>'input-block-level')); ?>
			<?php echo $form->error($model,'startDateTime'); ?>
		</div>
	</div>
	<div class="control-group">
			<?php echo $form->labelEx($model,'endDateTime', array('class'=>'control-label')); ?>
		<div class='controls'>
			<?php echo $form->textField($model,'endDateTime', array('class'=>'input-block-level')); ?>
			<?php echo $form->error($model,'endDateTime'); ?>
		</div>
	</div>
	<div class="control-group">
			<?php echo $form->labelEx($model,'percent', array('class'=>'control-label')); ?>
		<div class='controls'>
			<?php echo $form->textField($model,'percent',array('class'=>'input-block-level')); ?>
			<?php echo $form->error($model,'percent'); ?>
		</div>
	</div>
	<div class="control-group">
			<?php echo $form->labelEx($model,'value', array('class'=>'control-label')); ?>
		<div class='controls'>
			<?php echo $form->textField($model,'value',array('class'=>'input-block-level')); ?>
			<?php echo $form->error($model,'value'); ?>
		</div>
	</div>
	<div class="control-group">
			<?php echo $form->labelEx($model,'accumulation', array('class'=>'control-label')); ?>
		<div class='controls'>
			<?php echo $form->textField($model,'accumulation',array('class'=>'input-block-level')); ?>
			<?php echo $form->error($model,'accumulation'); ?>
		</div>
	</div>
	<div class="control-group">
			<?php echo $form->labelEx($model,'type', array('class'=>'control-label')); ?>
		<div class='controls'>
			<?php echo $form->textField($model,'type', array('class'=>'input-block-level')); ?>
			<?php echo $form->error($model,'type'); ?>
		</div>
	</div>
	<div class="control-group">
			<?php echo $form->labelEx($model,'image', array('class'=>'control-label')); ?>
		<div class='controls'>
			<?php if($this->action->id=='update') echo CHtml::image(Yii::app()->baseUrl.$model->image, '', array('style'=>'width:150px;'));?>
			<?php echo $form->fileField($model,'image'); ?>
			<?php echo $form->error($model,'image'); ?>
		</div>
	</div>
	<div class="control-group">
			<?php echo $form->labelEx($model,'status', array('class'=>'control-label')); ?>
		<div class='controls'>
			<?php echo $form->checkBox($model,'status'); ?>
			<?php echo $form->error($model,'status'); ?>
		</div>
	</div>
	
	<div class="form-actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
