<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'upload-file-form',
		//'enableAjaxValidation' => true,
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,),
		'htmlOptions'=>array(
			'enctype'=>'multipart/form-data',
			'class'=>'form-horizontal well'),
	));
	?>
	<h2>อัพโหลดเอกสารหลักฐานการโอนเงินให้ <?php echo $supplierName; ?></h2>
	<h4></h4>
	<div class="row-fluid">
		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($btModel, "fileName"); ?></label>
			<div class="controls">
				<?php echo $form->textField($btModel, "fileName"); ?>
				<?php echo $form->error($btModel, 'fileName'); ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($btModel, "description"); ?></label>
			<div class="controls">
				<?php echo $form->textArea($btModel, "description"); ?>
				<?php echo $form->error($btModel, "description"); ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label"><?php echo $form->labelEx($orderFileModel, "filePath"); ?></label>
			<div class="controls">
				<?php echo CHtml::activeFileField($orderFileModel, "filePath"); ?>
				<?php echo $form->error($orderFileModel, 'filePath'); ?>
			</div>
		</div>

		<div class="control-group">
			<div class="controls">
				<?php echo CHtml::submitButton('ยืนยันการโอน'); ?>
			</div>
		</div>

	</div>
	<?php $this->endWidget(); ?>

</div><!-- form -->
