<?php
/* @var $this PromotionController */
/* @var $data Promotion */
?>

<div class="alert alert-info">

	<b><?php echo CHtml::encode($data->getAttributeLabel('promotionId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->promotionId), array('view', 'id'=>$data->promotionId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('partnerTypeId')); ?>:</b>
	<?php echo CHtml::encode($data->partnerTypeId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creatorId')); ?>:</b>
	<?php echo CHtml::encode($data->creatorId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('startDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->startDateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('endDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->endDateTime); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('percent')); ?>:</b>
	<?php echo CHtml::encode($data->percent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('value')); ?>:</b>
	<?php echo CHtml::encode($data->value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('accumulation')); ?>:</b>
	<?php echo CHtml::encode($data->accumulation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
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