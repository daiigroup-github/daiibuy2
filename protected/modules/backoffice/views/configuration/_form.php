<?php
/* @var $this ConfigurationController */
/* @var $model Configuration */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'configuration-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array(
			'class'=>'form-horizontal'
		),
	));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<div class="control-label col-sm-2">
			<?php echo $form->labelEx($model, 'name'); ?>
		</div>
		<div class="col-sm-10">
			<?php
			echo $form->textField($model, 'name', array(
				'size'=>60,
				'maxlength'=>200));
			?>
			<?php echo $form->error($model, 'name'); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="control-label col-sm-2">
			<?php echo $form->labelEx($model, 'description'); ?>
		</div>
		<div class='col-sm-10'>
			<?php
			$this->widget('ext.editMe.widgets.ExtEditMe', array(
				'model'=>$model,
				'attribute'=>'description',
				//'filebrowserImageUploadUrl' => Yii::app()->createUrl('admin/product/uploadFile'),
				'filebrowserImageBrowseUrl'=>Yii::app()->request->baseUrl . '/ext/kcfinder/browse.php?type=files&cms=yii',
			));
			?>
			<?php echo $form->error($model, 'description'); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="control-label col-sm-2">
			<?php echo $form->labelEx($model, 'value'); ?>
		</div>
		<div class="col-sm-10">
			<?php
			echo $form->textField($model, 'value');
			?>
			<?php echo $form->error($model, 'value'); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="control-label col-sm-2">
			<?php echo $form->labelEx($model, 'status'); ?>
		</div>
		<div class="col-sm-10">
			<?php echo $form->checkBox($model, 'status'); ?>
			<?php echo $form->error($model, 'status'); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="controls col-sm-offset-2 col-sm-9">
			<?php
			echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
				'class'=>'btn btn-primary'));
			?>
		</div>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->