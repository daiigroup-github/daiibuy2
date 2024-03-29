<?php
/* @var $this UserFileController */
/* @var $data UserFile */
?>

<div class="alert alert-info">

	<b><?php echo CHtml::encode($data->getAttributeLabel('userFileId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->userFileId), array('view', 'id'=>$data->userFileId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userFileName')); ?>:</b>
	<?php echo CHtml::encode($data->userFileName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isShowInProductView')); ?>:</b>
	<?php echo CHtml::encode($data->isShowInProductView); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isPublic')); ?>:</b>
	<?php echo CHtml::encode($data->isPublic); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />


</div>