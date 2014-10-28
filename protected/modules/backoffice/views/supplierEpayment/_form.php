<?php
/* @var $this SupplierEpaymentController */
/* @var $model SupplierEpayment */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'supplier-epayment-form',
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

	<?php
	echo $form->errorSummary($model, '', '', array(
		'class'=>'alert alert-danger'));
	?>

	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'supplierId', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php echo isset($model->supplier) ? $model->supplier->name : "-"; ?>
			<?php echo $form->error($model, 'supplierId'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'enableEPayment', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->checkBox($model, 'enableEPayment', array(
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'enableEPayment'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'ePaymentMerchantId', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->textField($model, 'ePaymentMerchantId', array(
				'size'=>50,
				'maxlength'=>50,
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'ePaymentMerchantId'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'ePaymentOrgId', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->textField($model, 'ePaymentOrgId', array(
				'size'=>50,
				'maxlength'=>50,
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'ePaymentOrgId'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'ePaymentUrl', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->textArea($model, 'ePaymentUrl', array(
				'rows'=>6,
				'cols'=>50,
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'ePaymentUrl'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'ePaymentAccessKey', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->textArea($model, 'ePaymentAccessKey', array(
				'rows'=>6,
				'cols'=>50,
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'ePaymentAccessKey'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'ePaymentProfileId', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php if($this->action->id == 'update') echo CHtml::link('Show File', Yii::app()->baseUrl . $model->ePaymentProfileId); ?>
			<?php
			echo $form->textField($model, 'ePaymentProfileId', array(
				'size'=>50,
				'maxlength'=>50,
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'ePaymentProfileId'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'ePaymentSecretKey', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->textArea($model, 'ePaymentSecretKey', array(
				'rows'=>6,
				'cols'=>50,
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'ePaymentSecretKey'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'ePaymentTel', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->textField($model, 'ePaymentTel', array(
				'size'=>30,
				'maxlength'=>30,
				'class'=>'form-control'));
			?>
			<?php echo $form->error($model, 'ePaymentTel'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'type', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->dropDownList($model, 'type', SupplierEpayment::model()->findAllEpaymentTypeArray(), array(
				'class'=>'form-control',
				'prompt'=>'-- Select Server Type --'));
			?>
			<?php echo $form->error($model, 'type'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'status', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->checkBox($model, 'status', array(
				'class'=>'form-control'));
			?>
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