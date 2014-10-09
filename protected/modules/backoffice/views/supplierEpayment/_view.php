<?php
/* @var $this SupplierEpaymentController */
/* @var $data SupplierEpayment */
?>

<div class="alert alert-info">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('supplierId')); ?>:</b>
	<?php echo CHtml::encode($data->supplierId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enableEPayment')); ?>:</b>
	<?php echo CHtml::encode($data->enableEPayment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ePaymentTel')); ?>:</b>
	<?php echo CHtml::encode($data->ePaymentTel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ePaymentMerchantId')); ?>:</b>
	<?php echo CHtml::encode($data->ePaymentMerchantId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ePaymentOrgId')); ?>:</b>
	<?php echo CHtml::encode($data->ePaymentOrgId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ePaymentUrl')); ?>:</b>
	<?php echo CHtml::encode($data->ePaymentUrl); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ePaymentAccessKey')); ?>:</b>
	<?php echo CHtml::encode($data->ePaymentAccessKey); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ePaymentProfileId')); ?>:</b>
	<?php echo CHtml::encode($data->ePaymentProfileId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ePaymentSecretKey')); ?>:</b>
	<?php echo CHtml::encode($data->ePaymentSecretKey); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
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