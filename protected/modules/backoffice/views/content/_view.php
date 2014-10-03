<?php
/* @var $this ContentController */
/* @var $data Content */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('contentId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->contentId), array(
		'view',
		'id'=>$data->contentId));
	?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('subview')); ?>:</b>
	<?php echo CHtml::encode($data->subview); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parentId')); ?>:</b>
	<?php echo CHtml::encode($data->parentId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
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