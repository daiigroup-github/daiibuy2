<?php
/* @var $this OrderGroupController */
/* @var $data OrderGroup */
?>

<div class="alert alert-info">

	<b><?php echo CHtml::encode($data->getAttributeLabel('orderGroupId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->orderGroupId), array('view', 'id'=>$data->orderGroupId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userId')); ?>:</b>
	<?php echo CHtml::encode($data->userId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('supplierId')); ?>:</b>
	<?php echo CHtml::encode($data->supplierId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orderNo')); ?>:</b>
	<?php echo CHtml::encode($data->orderNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoiceNo')); ?>:</b>
	<?php echo CHtml::encode($data->invoiceNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('firstname')); ?>:</b>
	<?php echo CHtml::encode($data->firstname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastname')); ?>:</b>
	<?php echo CHtml::encode($data->lastname); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telephone')); ?>:</b>
	<?php echo CHtml::encode($data->telephone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total')); ?>:</b>
	<?php echo CHtml::encode($data->total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vatPercent')); ?>:</b>
	<?php echo CHtml::encode($data->vatPercent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vatValue')); ?>:</b>
	<?php echo CHtml::encode($data->vatValue); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('totalIncVAT')); ?>:</b>
	<?php echo CHtml::encode($data->totalIncVAT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discountPercent')); ?>:</b>
	<?php echo CHtml::encode($data->discountPercent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discountValue')); ?>:</b>
	<?php echo CHtml::encode($data->discountValue); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('totalPostDiscount')); ?>:</b>
	<?php echo CHtml::encode($data->totalPostDiscount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('distributorDiscountPercent')); ?>:</b>
	<?php echo CHtml::encode($data->distributorDiscountPercent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('distributorDiscount')); ?>:</b>
	<?php echo CHtml::encode($data->distributorDiscount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('totalPostDistributorDiscount')); ?>:</b>
	<?php echo CHtml::encode($data->totalPostDistributorDiscount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('extraDiscount')); ?>:</b>
	<?php echo CHtml::encode($data->extraDiscount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('partnerDiscountCode')); ?>:</b>
	<?php echo CHtml::encode($data->partnerDiscountCode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('partnerDiscountPercent')); ?>:</b>
	<?php echo CHtml::encode($data->partnerDiscountPercent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('partnerDiscountValue')); ?>:</b>
	<?php echo CHtml::encode($data->partnerDiscountValue); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('summary')); ?>:</b>
	<?php echo CHtml::encode($data->summary); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paymentDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->paymentDateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paymentCompany')); ?>:</b>
	<?php echo CHtml::encode($data->paymentCompany); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paymentFirstname')); ?>:</b>
	<?php echo CHtml::encode($data->paymentFirstname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paymentLastname')); ?>:</b>
	<?php echo CHtml::encode($data->paymentLastname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paymentAddress1')); ?>:</b>
	<?php echo CHtml::encode($data->paymentAddress1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paymentAddress2')); ?>:</b>
	<?php echo CHtml::encode($data->paymentAddress2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paymentDistrictId')); ?>:</b>
	<?php echo CHtml::encode($data->paymentDistrictId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paymentAmphurId')); ?>:</b>
	<?php echo CHtml::encode($data->paymentAmphurId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paymentProvinceId')); ?>:</b>
	<?php echo CHtml::encode($data->paymentProvinceId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paymentPostcode')); ?>:</b>
	<?php echo CHtml::encode($data->paymentPostcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paymentMethod')); ?>:</b>
	<?php echo CHtml::encode($data->paymentMethod); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paymentTaxNo')); ?>:</b>
	<?php echo CHtml::encode($data->paymentTaxNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shippingCompany')); ?>:</b>
	<?php echo CHtml::encode($data->shippingCompany); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shippingAddress1')); ?>:</b>
	<?php echo CHtml::encode($data->shippingAddress1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shippingAddress2')); ?>:</b>
	<?php echo CHtml::encode($data->shippingAddress2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shippingDistrictId')); ?>:</b>
	<?php echo CHtml::encode($data->shippingDistrictId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shippingAmphurId')); ?>:</b>
	<?php echo CHtml::encode($data->shippingAmphurId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shippingProvinceId')); ?>:</b>
	<?php echo CHtml::encode($data->shippingProvinceId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shippingPostCode')); ?>:</b>
	<?php echo CHtml::encode($data->shippingPostCode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usedPoint')); ?>:</b>
	<?php echo CHtml::encode($data->usedPoint); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isSentToCustomer')); ?>:</b>
	<?php echo CHtml::encode($data->isSentToCustomer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remark')); ?>:</b>
	<?php echo CHtml::encode($data->remark); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('supplierShippingDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->supplierShippingDateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('partnerCode')); ?>:</b>
	<?php echo CHtml::encode($data->partnerCode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('partnerType')); ?>:</b>
	<?php echo CHtml::encode($data->partnerType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('partnerId')); ?>:</b>
	<?php echo CHtml::encode($data->partnerId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parentId')); ?>:</b>
	<?php echo CHtml::encode($data->parentId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mainId')); ?>:</b>
	<?php echo CHtml::encode($data->mainId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mainFurnitureId')); ?>:</b>
	<?php echo CHtml::encode($data->mainFurnitureId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('furnitureGroupId')); ?>:</b>
	<?php echo CHtml::encode($data->furnitureGroupId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('furnitureId')); ?>:</b>
	<?php echo CHtml::encode($data->furnitureId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isRequestSpacialProject')); ?>:</b>
	<?php echo CHtml::encode($data->isRequestSpacialProject); ?>
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