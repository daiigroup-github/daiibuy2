<?php
/* @var $this ProductSpecController */
/* @var $data ProductSpec */
?>

<div class="alert alert-info">

	<b><?php echo CHtml::encode($data->getAttributeLabel('productSpecId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->productSpecId), array('view', 'id'=>$data->productSpecId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('productSpecGroupId')); ?>:</b>
	<?php echo CHtml::encode($data->productSpecGroupId); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('updateDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->updateDateTime); ?>
	<br />

	*/ ?>

</div>