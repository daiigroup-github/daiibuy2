<?php
/* @var $this BrandModelImageController */
/* @var $data BrandModelImage */
?>

<div class="alert alert-info">

	<b><?php echo CHtml::encode($data->getAttributeLabel('brandModelImageId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->brandModelImageId), array('view', 'id'=>$data->brandModelImageId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('brandModelId')); ?>:</b>
	<?php echo CHtml::encode($data->brandModelId); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('sortOrder')); ?>:</b>
	<?php echo CHtml::encode($data->sortOrder); ?>
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