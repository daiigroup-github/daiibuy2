<?php
/* @var $this BankNameController */
/* @var $model BankName */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'bank-name-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'enctype'=>'multipart/form-data',),
	));
?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php
echo $form->errorSummary($model, '', '', array(
	'class'=>'alert alert-error'));
?>

<div class="form-group">
	<div class="control-label col-sm-2"><?php echo $form->labelEx($model, 'title'); ?></div>
	<div class='col-sm-10'>
		<?php
		echo $form->textField($model, 'title', array(
			'size'=>60,
			'maxlength'=>200));
		?>
		<?php echo $form->error($model, 'title'); ?>
	</div>
</div>
<!--<div class="control-group">
<?php // echo $form->labelEx($model, 'description');  ?>
	<div class='controls'>
<?php
// $form->textArea($model, 'description', array(
//			'rows'=>6,
//			'cols'=>50));
?>
<?php // echo $form->error($model, 'description');   ?>
	</div>
</div>-->
<div class="form-group">
	<div class="control-label col-sm-2"><?php echo $form->labelEx($model, 'logo'); ?></div>
	<div class="col-sm-10">
		<?php
		if($this->action->id != 'create')
		{
			echo CHtml::image(Yii::app()->request->baseUrl . $model->logo, 'logo', array(
				'style'=>'height:250px;',
				'class'=>'img-polaroid'));
			echo '<br />';
			echo CHtml::hiddenField("oldLogo", $model->logo);
		}

		echo $form->fileField($model, 'logo');
		echo $form->error($model, 'logo');
		?>
	</div>
</div>
<div class="form-group">
	<div class="control-label col-sm-2"><?php echo $form->labelEx($model, 'status'); ?></div>
	<div class='col-sm-10'>
		<?php echo $form->checkBox($model, 'status'); ?>
		<?php echo $form->error($model, 'status'); ?>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2 col-sm-9">
		<?php
		echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
			'class'=>'btn btn-primary'));
		?>
	</div>
</div>

<?php $this->endWidget(); ?>
