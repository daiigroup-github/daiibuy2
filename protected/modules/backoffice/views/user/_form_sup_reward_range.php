<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'sup-reward-range-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'enctype'=>'multipart/form-data',
		'class'=>'form-horizontal well'
	),
	));
?>
<div class="control-group">
    <div class="controls">
		<?php
		echo CHtml::submitButton($model->isNewRecord ? 'สร้าง' : 'บันทึก', array(
			'class'=>'btn btn-primary pull-right')); //'onclick'=>"validatePromotion()" ));
		?>
    </div>
</div>

<div class="row-fluid">
	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'supplierId'); ?></label>
		<div class="controls">
			<?php
			echo $model->supplier->firstname . " " . $model->supplier->lastname;
			?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'min'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'min', array(
				'size'=>32,
				'maxlength'=>32
			));
			?>
			<?php echo $form->error($model, 'min'); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'max'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'max', array(
				'size'=>32,
				'maxlength'=>32
			));
			?>
			<?php echo $form->error($model, 'max'); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"><?php echo $form->labelEx($model, 'percentDiscount'); ?></label>
		<div class="controls">
			<?php
			echo $form->textField($model, 'percentDiscount', array(
				'size'=>32,
				'maxlength'=>32
			));
			?>
			<?php echo $form->error($model, 'percentDiscount'); ?>
		</div>
	</div>


</div>
<?php $this->endWidget(); ?>
<!-- form -->