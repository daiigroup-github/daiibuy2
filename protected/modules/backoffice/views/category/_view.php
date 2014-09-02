<?php
/* @var $this CategoryController */
/* @var $data Category */
?>

<div class="alert alert-info">

	<b><?php echo CHtml::encode($data->getAttributeLabel('categoryId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->categoryId), array('view', 'id'=>$data->categoryId)); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('updateDatetime')); ?>:</b>
	<?php echo CHtml::encode($data->updateDatetime); ?>
	<br />

	*/ ?>

</div>