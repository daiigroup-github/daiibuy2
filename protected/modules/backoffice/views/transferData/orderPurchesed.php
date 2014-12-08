<?php
/* @var $this BankNameController */
/* @var $model BankName */

$this->breadcrumbs = array(
	'Bank Names'=>array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label'=>'List BankName',
		'url'=>array(
			'admin')),
	array(
		'label'=>'Manage BankName',
		'url'=>array(
			'index')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">Transfer Old Order From Daiibuy1</div>
	<div class="panel-body">
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
			<div class="control-label col-sm-2">Email</div>
			<div class='col-sm-10'>
				<?php
				echo $model->email;
				?>
			</div>
		</div>
		<div class="form-group">
			<div class="control-label col-sm-2">Old Order No</div>
			<div class='col-sm-10'>
				<?php
				echo $model->orderNo;
				?>
			</div>
		</div>
		<div class="form-group">
			<div class="control-label col-sm-2">Total</div>
			<div class='col-sm-10'>
				<?php
				echo number_format($model->totalIncVAT - $model->usedPoint) . " บาท";
				?>
			</div>
		</div>
		<div class="form-group">
			<div class="control-label col-sm-2"><?php echo $form->labelEx($model, 'title'); ?></div>
			<div class='col-sm-10'>
				<?php
				echo $form->dropDownList($model, 'supplierId', Supplier::model()->findAllSupplierArray(), array(
					'prompt'=>'-- Select Supplier --'));
				?>
				<?php echo $form->error($model, 'supplierId'); ?>
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
	</div>
</div>
