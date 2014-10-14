<?php
/* @var $this BankController */
/* @var $model Bank */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'bank-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array(
			'enctype'=>'multipart/form-data',
			'class'=>'form-horizontal'),
	));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<div class="control-label col-sm-2"><?php echo $form->labelEx($model, 'bankNameId'); ?></div>
		<div class="col-sm-10">
			<?php
			echo $form->dropDownList($model, 'bankNameId', BankName::model()->findAllBankNameArray(), array(
				'prompt'=>'-- Select Bank --'));
			?>
			<?php echo $form->error($model, 'bankNameId'); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="control-label col-sm-2"><?php echo $form->labelEx($model, 'compCode'); ?></div>
		<div class="col-sm-10">
			<?php
			echo $form->textField($model, 'compCode', array(
				'length'=>5));
			?>
			<?php echo $form->error($model, 'compCode'); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="control-label col-sm-2"><?php echo $form->labelEx($model, 'accNo'); ?></div>
		<div class="col-sm-10">
			<?php
			echo $form->textField($model, 'accNo', array(
				'rows'=>6,
				'cols'=>50));
			?>
			<?php echo $form->error($model, 'accNo'); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="control-label col-sm-2"><?php echo $form->labelEx($model, 'accName'); ?></div>
		<div class="controls col-sm-10">
			<?php
			echo $form->textField($model, 'accName', array(
				'size'=>60,
				'maxlength'=>300));
			?>
			<?php echo $form->error($model, 'accName'); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="control-label col-sm-2"><?php echo $form->labelEx($model, 'accType'); ?></div>
		<div class="col-sm-10">
			<?php echo $form->dropdownList($model, 'accType', Bank::model()->getAllBankAccType()); ?>
			<?php echo $form->error($model, 'accType'); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="control-label col-sm-2"><?php echo $form->labelEx($model, 'branch'); ?></div>
		<div class="col-sm-10">
			<?php
			echo $form->textField($model, 'branch', array(
				'size'=>25,
				'maxlength'=>25));
			?>
			<?php echo $form->error($model, 'branch'); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="control-label col-sm-2"><?php echo $form->labelEx($model, 'supplierId'); ?></div>
		<div class="col-sm-10">
			<?php
			echo $form->dropDownList($model, 'supplierId', User::model()->findAllSupplierArray(), array(
				'prompt'=>'-- Select Supplier --'));
			?>
			<?php echo $form->error($model, 'supplierId'); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="control-label col-sm-2"><?php echo $form->labelEx($model, 'status'); ?></div>
		<div class="col-sm-10">
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

</div><!-- form -->