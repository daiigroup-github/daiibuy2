<?php
/* @var $this SupplierDiscountRangeController */
/* @var $data SupplierDiscountRange */
?>

<div class="alert alert-info">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('supplierId')); ?>:</b>
	<?php echo CHtml::encode($data->supplierId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('min')); ?>:</b>
	<?php echo CHtml::encode($data->min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('max')); ?>:</b>
	<?php echo CHtml::encode($data->max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('percentDiscount')); ?>:</b>
	<?php echo CHtml::encode($data->percentDiscount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('updateDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->updateDateTime); ?>
	<br />

	*/ ?>

</div>