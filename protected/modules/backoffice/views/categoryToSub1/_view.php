<?php
/* @var $this CategoryToSubController */
/* @var $data CategoryToSub */
?>

<div class="alert alert-info">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('categoryId')); ?>:</b>
	<?php echo CHtml::encode($data->categoryId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subCategoryId')); ?>:</b>
	<?php echo CHtml::encode($data->subCategoryId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isTheme')); ?>:</b>
	<?php echo CHtml::encode($data->isTheme); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isSet')); ?>:</b>
	<?php echo CHtml::encode($data->isSet); ?>
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