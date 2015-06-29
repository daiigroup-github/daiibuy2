<?php
/* @var $this FurnitureItemController */
/* @var $data FurnitureItem */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('furnitureItemId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->furnitureItemId), array('view', 'id'=>$data->furnitureItemId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('furnitureId')); ?>:</b>
	<?php echo CHtml::encode($data->furnitureId); ?>
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