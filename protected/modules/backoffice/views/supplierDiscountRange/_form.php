<?php
/* @var $this SupplierDiscountRangeController */
/* @var $model SupplierDiscountRange */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'supplier-discount-range-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array(
			'class'=>'form-horizontal',
		//'enctype' => 'multipart/form-data',
		),
	));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model, '', '', array(
		'class'=>'alert alert-danger'));
	?>

	<div class="form-group">
		<?php echo $form->labelEx($model, 'supplierId', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
<?php echo $model->supplier->companyName; ?>
<?php echo $form->error($model, 'supplierId'); ?>
		</div>
	</div>
	<div class="form-group">
			<?php echo $form->labelEx($model, 'min', array(
				'class'=>'col-sm-2 control-label'));
			?>
		<div class="col-sm-10">
			<?php
			echo $form->textField($model, 'min', array(
				'size'=>15,
				'maxlength'=>15,
				'class'=>'form-control'));
			?>
		<?php echo $form->error($model, 'min'); ?>
		</div>
	</div>
	<div class="form-group">
			<?php echo $form->labelEx($model, 'max', array(
				'class'=>'col-sm-2 control-label'));
			?>
		<div class="col-sm-10">
<?php
echo $form->textField($model, 'max', array(
	'size'=>15,
	'maxlength'=>15,
	'class'=>'form-control'));
?>
			<?php echo $form->error($model, 'max'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model, 'percentDiscount', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php echo $form->textField($model, 'percentDiscount', array(
				'class'=>'form-control'));
			?>
<?php echo $form->error($model, 'percentDiscount'); ?>
		</div>
	</div>
	<div class="form-group">
			<?php echo $form->labelEx($model, 'status', array(
				'class'=>'col-sm-2 control-label'));
			?>
		<div class="col-sm-10">
<?php echo $form->checkBox($model, 'status', array(
	'class'=>'form-control'));
?>
<?php echo $form->error($model, 'status'); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-9">
<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
	'class'=>'btn btn-primary'));
?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->