<?php
/* @var $this OrderDetailTemplateController */
/* @var $data OrderDetailTemplate */
?>

<div class="alert alert-info">

	<b><?php echo CHtml::encode($data->getAttributeLabel('orderDetailTemplateId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->orderDetailTemplateId), array('view', 'id'=>$data->orderDetailTemplateId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orderDetailId')); ?>:</b>
	<?php echo CHtml::encode($data->orderDetailId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('supplierId')); ?>:</b>
	<?php echo CHtml::encode($data->supplierId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updateDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->updateDateTime); ?>
	<br />


</div>