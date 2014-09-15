<?php
/* @var $this OrderDetailController */
/* @var $data OrderDetail */
?>

<div class="alert alert-info">

	<b><?php echo CHtml::encode($data->getAttributeLabel('orderDetailId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->orderDetailId), array('view', 'id'=>$data->orderDetailId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orderId')); ?>:</b>
	<?php echo CHtml::encode($data->orderId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updateDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->updateDateTime); ?>
	<br />


</div>