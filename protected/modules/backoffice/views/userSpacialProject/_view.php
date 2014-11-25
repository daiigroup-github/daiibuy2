<?php
/* @var $this UserSpacialProjectController */
/* @var $data UserSpacialProject */
?>

<div class="alert alert-info">

	<b><?php echo CHtml::encode($data->getAttributeLabel('userSpacialProjectId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->userSpacialProjectId), array('view', 'id'=>$data->userSpacialProjectId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('supplierId')); ?>:</b>
	<?php echo CHtml::encode($data->supplierId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userId')); ?>:</b>
	<?php echo CHtml::encode($data->userId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orderGroupId')); ?>:</b>
	<?php echo CHtml::encode($data->orderGroupId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orderId')); ?>:</b>
	<?php echo CHtml::encode($data->orderId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('supplierSpacialProjectId')); ?>:</b>
	<?php echo CHtml::encode($data->supplierSpacialProjectId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('spacialCode')); ?>:</b>
	<?php echo CHtml::encode($data->spacialCode); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('spacialPercent')); ?>:</b>
	<?php echo CHtml::encode($data->spacialPercent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php echo CHtml::encode($data->image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updateDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->updateDateTime); ?>
	<br />

	*/ ?>

</div>