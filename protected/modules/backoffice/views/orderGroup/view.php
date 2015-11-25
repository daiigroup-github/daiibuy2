<?php
/* @var $this OrderGroupController */
/* @var $model OrderGroup */

$this->breadcrumbs=array(
	'Order Groups'=>array('index'),
	$model->orderGroupId,
);

$this->menu=array(
	array('label'=>'List OrderGroup', 'url'=>array('index')),
	array('label'=>'Create OrderGroup', 'url'=>array('create')),
	array('label'=>'Update OrderGroup', 'url'=>array('update', 'id'=>$model->orderGroupId)),
	array('label'=>'Delete OrderGroup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->orderGroupId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OrderGroup', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View OrderGroup #<?php echo $model->orderGroupId; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'orderGroupId',
		'userId',
		'supplierId',
		'orderNo',
		'invoiceNo',
		'firstname',
		'lastname',
		'email',
		'telephone',
		'total',
		'vatPercent',
		'vatValue',
		'totalIncVAT',
		'discountPercent',
		'discountValue',
		'totalPostDiscount',
		'distributorDiscountPercent',
		'distributorDiscount',
		'totalPostDistributorDiscount',
		'extraDiscount',
		'partnerDiscountCode',
		'partnerDiscountPercent',
		'partnerDiscountValue',
		'summary',
		'paymentDateTime',
		'paymentCompany',
		'paymentFirstname',
		'paymentLastname',
		'paymentAddress1',
		'paymentAddress2',
		'paymentDistrictId',
		'paymentAmphurId',
		'paymentProvinceId',
		'paymentPostcode',
		'paymentMethod',
		'paymentTaxNo',
		'shippingCompany',
		'shippingAddress1',
		'shippingAddress2',
		'shippingDistrictId',
		'shippingAmphurId',
		'shippingProvinceId',
		'shippingPostCode',
		'usedPoint',
		'isSentToCustomer',
		'remark',
		'supplierShippingDateTime',
		'partnerCode',
		'partnerType',
		'partnerId',
		'parentId',
		'mainId',
		'mainFurnitureId',
		'furnitureGroupId',
		'furnitureId',
		'isRequestSpacialProject',
		'status',
		'createDateTime',
		'updateDateTime',
		),
	)); ?>
</div>
