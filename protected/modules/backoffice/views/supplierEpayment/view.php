<?php
/* @var $this SupplierEpaymentController */
/* @var $model SupplierEpayment */

$this->breadcrumbs=array(
	'Supplier Epayments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SupplierEpayment', 'url'=>array('index')),
	array('label'=>'Create SupplierEpayment', 'url'=>array('create')),
	array('label'=>'Update SupplierEpayment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SupplierEpayment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SupplierEpayment', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View SupplierEpayment #<?php echo $model->id; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'id',
		'supplierId',
		'enableEPayment',
		'ePaymentTel',
		'ePaymentMerchantId',
		'ePaymentOrgId',
		'ePaymentUrl',
		'ePaymentAccessKey',
		'ePaymentProfileId',
		'ePaymentSecretKey',
		'type',
		'status',
		'createDateTime',
		'updateDateTime',
		),
	)); ?>
</div>
