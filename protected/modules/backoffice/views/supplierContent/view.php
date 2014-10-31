<?php
/* @var $this SupplierContentController */
/* @var $model SupplierContent */

$this->breadcrumbs=array(
	'Supplier Contents'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List SupplierContent', 'url'=>array('index')),
	array('label'=>'Create SupplierContent', 'url'=>array('create')),
	array('label'=>'Update SupplierContent', 'url'=>array('update', 'id'=>$model->supplierContentId)),
	array('label'=>'Delete SupplierContent', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->supplierContentId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SupplierContent', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View SupplierContent #<?php echo $model->supplierContentId; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'supplierContentId',
		'supplierContentGroupId',
		'title',
		'description',
		'image',
		'status',
		'createDateTime',
		'updateDateTime',
		),
	)); ?>
</div>
