<?php
/* @var $this SupplierSpacialProjectController */
/* @var $model SupplierSpacialProject */

$this->breadcrumbs=array(
	'Supplier Spacial Projects'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List SupplierSpacialProject', 'url'=>array('index')),
	array('label'=>'Create SupplierSpacialProject', 'url'=>array('create')),
	array('label'=>'Update SupplierSpacialProject', 'url'=>array('update', 'id'=>$model->supplierSpacialProjectId)),
	array('label'=>'Delete SupplierSpacialProject', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->supplierSpacialProjectId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SupplierSpacialProject', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View SupplierSpacialProject #<?php echo $model->supplierSpacialProjectId; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'supplierSpacialProjectId',
		'supplierId',
		'code',
		'title',
		'description',
		'image',
		'status',
		'createDateTime',
		'updateDateTime',
		),
	)); ?>
</div>
