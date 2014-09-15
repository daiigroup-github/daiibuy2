<?php
/* @var $this OrderDetailTemplateFieldController */
/* @var $data OrderDetailTemplateField */
?>

<div class="alert alert-info">

	<b><?php echo CHtml::encode($data->getAttributeLabel('orderDetailTemplateFieldId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->orderDetailTemplateFieldId), array('view', 'id'=>$data->orderDetailTemplateFieldId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orderDetailTemplateId')); ?>:</b>
	<?php echo CHtml::encode($data->orderDetailTemplateId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updateDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->updateDateTime); ?>
	<br />


</div>