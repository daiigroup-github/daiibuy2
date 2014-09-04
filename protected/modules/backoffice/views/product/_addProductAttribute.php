<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'productAttribute-form',
	'enableAjaxValidation'=>false,
	));
?>
<div class="control-group">
	<label class="control-label"><?php echo $form->labelEx($productAttributeModel, 'attributeName'); ?></label>
	<div class="controls">
		<?php
		echo $form->textField($productAttributeModel, 'attributeName', array(
		));
		?>
		<?php echo $form->error($productAttributeModel, 'attributeName'); ?>
	</div>
</div>

<div class="control-group">
	<div class="controls">
		<?php
		echo CHtml::submitButton('Save', array(
			'class'=>'btn btn-primary pull-right'));
		?>
	</div>
</div>

<?php $this->endWidget(); ?>