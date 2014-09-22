<?php
/* @var $this ProductOptionController */
/* @var $data ProductOption */
?>

<div class="alert alert-info">

	<b><?php echo CHtml::encode($data->getAttributeLabel('productOptionId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->productOptionId), array('view', 'id'=>$data->productOptionId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('productIOptionGroupd')); ?>:</b>
	<?php echo CHtml::encode($data->productIOptionGroupd); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('priceValue')); ?>:</b>
	<?php echo CHtml::encode($data->priceValue); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pricePercent')); ?>:</b>
	<?php echo CHtml::encode($data->pricePercent); ?>
	<br />

	<?php /*
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