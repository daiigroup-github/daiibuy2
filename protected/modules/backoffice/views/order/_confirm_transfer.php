<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'confirm-transfer-form',
		//'enableAjaxValidation' => true,
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,),
		'htmlOptions'=>array(
			'enctype'=>'multipart/form-data',
			'class'=>'form-horizontal well'),
	));
	?>
	<h2>ยืนยันโอนเงิน</h2>
	<h4>กรุณาอัพโหลดเอกสารยืนยันการโอนเงิน...</h4>
	<div class="row">
		<div class="form-group">
			<label class="control-label col-sm-3"><?php echo $form->labelEx($orderFileModel, "fileName"); ?></label>
			<div class="col-sm-9">
				<?php echo $form->textField($orderFileModel, "fileName"); ?>
				<?php echo $form->error($orderFileModel, 'fileName'); ?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3"><?php echo $form->labelEx($orderFileModel, "filePath"); ?></label>
			<div class="col-sm-9">
				<?php echo CHtml::activeFileField($orderFileModel, "filePath"); ?>
				<?php echo $form->error($orderFileModel, 'filePath'); ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-sm-offset-3">
				<?php echo CHtml::submitButton('ยืนยันโอนเงิน'); ?>
			</div>
		</div>

	</div>
	<?php $this->endWidget(); ?>

</div><!-- form -->
