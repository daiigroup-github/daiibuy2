<?php
/* @var $this SupplierSpacialProjectController */
/* @var $data SupplierSpacialProject */
?>

<div class="alert alert-info">

	<b><?php echo CHtml::encode($data->getAttributeLabel('supplierSpacialProjectId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->supplierSpacialProjectId), array('view', 'id'=>$data->supplierSpacialProjectId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('supplierId')); ?>:</b>
	<?php echo CHtml::encode($data->supplierId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?php echo CHtml::encode($data->code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php echo CHtml::encode($data->image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updateDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->updateDateTime); ?>
	<br />

	*/ ?>

</div>