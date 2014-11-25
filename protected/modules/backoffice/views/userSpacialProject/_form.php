<?php
/* @var $this UserSpacialProjectController */
/* @var $model UserSpacialProject */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'user-spacial-project-form',
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
	<h3 class="<?php echo ($this->action->id == "approve") ? "text-success" : "text-danger" ?>"><?php echo ($this->action->id == "approve") ? "" : "ไม่" ?>อนุมัติรายการ</h3>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php
	echo $form->errorSummary($model, '', '', array(
		'class'=>'alert alert-danger'));
	?>

	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'userId', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php echo $model->user->email . " โทร. " . $model->user->telephone; ?>
			<?php echo $form->error($model, 'userId'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'orderGroupId', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo isset($model->orderGroup) ? $model->orderGroup->orderNo . "<span class='text-danger'> ยอดเงิน " . $model->orderGroup->summary . " บาท</span>" : "";
			?>
			<?php echo $form->error($model, 'orderGroupId'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'orderId', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo isset($model->order) ? $model->order->title . "<span class='text-danger'> ยอดเงิน " . $model->order->totalIncVAT . " บาท</span>" : "";
			?>
			<?php echo $form->error($model, 'orderId'); ?>
		</div>
	</div>
	<?php if($this->action->id == "approve"): ?>
		<div class="form-group">
			<?php
			echo $form->labelEx($model, 'supplierSpacialProjectId', array(
				'class'=>'col-sm-2 control-label'));
			?>
			<div class="col-sm-10">
				<?php
				echo $form->dropDownList($model, "supplierSpacialProjectId", SupplierSpacialProject::model()->findAllSpacialArray(), array(
					'class'=>'form-control',
					'prompt'=>'-- Select Spacial Code --'))
				?>
				<?php echo $form->error($model, 'supplierSpacialProjectId'); ?>
			</div>
		</div>
	<?php endif; ?>
	<div class="form-group">
		<?php
		echo $form->labelEx($model, 'remark', array(
			'class'=>'col-sm-2 control-label'));
		?>
		<div class="col-sm-10">
			<?php
			echo $form->textArea($model, 'remark', array(
				'rows'=>4,
				'class'=>'form-control'))
			?>
			<?php echo $form->error($model, 'remark'); ?>
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