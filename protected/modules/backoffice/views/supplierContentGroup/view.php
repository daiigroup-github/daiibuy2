<?php
/* @var $this SupplierContentGroupController */
/* @var $model SupplierContentGroup */

$this->breadcrumbs=array(
	'Supplier Content Groups'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List SupplierContentGroup', 'url'=>array('index')),
	array('label'=>'Create SupplierContentGroup', 'url'=>array('create')),
	array('label'=>'Update SupplierContentGroup', 'url'=>array('update', 'id'=>$model->supplierContentGroupId)),
	array('label'=>'Delete SupplierContentGroup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->supplierContentGroupId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SupplierContentGroup', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View SupplierContentGroup #<?php echo $model->supplierContentGroupId; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'supplierContentGroupId',
		'supplierId',
		'title',
		'description',
		'image',
		'status',
		'createDateTime',
		'updateDateTime',
		),
	)); ?>
</div>
