<?php
/* @var $this OrderGroupController */
/* @var $model OrderGroup */

$this->breadcrumbs=array(
	'Order Groups'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List OrderGroup', 'url'=>array('index')),
array('label'=>'Create OrderGroup', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#order-group-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Order Groups
		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-lg-12">
				<?php $this->renderPartial('_search',array(
					'model'=>$model,
				)); ?>
			</div>
		</div>
	</div>

		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'order-group-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'itemsCssClass'=>'table table-striped table-bordered table-hover',
			'columns'=>array(
				array('class'=>'IndexColumn'),
				'orderGroupId',
				'userId',
				'supplierId',
				'orderNo',
				'invoiceNo',
				'firstname',
				/*
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
				*/
				array(
					'class'=>'CButtonColumn',
				),
			),
		)); ?>

	</div>


