<?php
/* @var $this PriceGroupController */
/* @var $data PriceGroup */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('priceGroupId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->priceGroupId), array(
		'view',
		'id'=>$data->priceGroupId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('priceGroupName')); ?>:</b>
	<?php echo CHtml::encode($data->priceGroupName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('priceRate')); ?>:</b>
	<?php echo CHtml::encode($data->priceRate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>