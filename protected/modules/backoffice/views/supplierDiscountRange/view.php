<?php
/* @var $this SupplierDiscountRangeController */
/* @var $model SupplierDiscountRange */

$this->breadcrumbs=array(
	'Supplier Discount Ranges'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SupplierDiscountRange', 'url'=>array('index')),
	array('label'=>'Create SupplierDiscountRange', 'url'=>array('create')),
	array('label'=>'Update SupplierDiscountRange', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SupplierDiscountRange', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SupplierDiscountRange', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View SupplierDiscountRange #<?php echo $model->id; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'id',
		'supplierId',
		'min',
		'max',
		'percentDiscount',
		'status',
		'createDateTime',
		'updateDateTime',
		),
	)); ?>
</div>
