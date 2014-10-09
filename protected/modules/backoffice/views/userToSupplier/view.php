<?php
/* @var $this UserToSupplierController */
/* @var $model UserToSupplier */

$this->breadcrumbs=array(
	'User To Suppliers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserToSupplier', 'url'=>array('index')),
	array('label'=>'Create UserToSupplier', 'url'=>array('create')),
	array('label'=>'Update UserToSupplier', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserToSupplier', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserToSupplier', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View UserToSupplier #<?php echo $model->id; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'id',
		'userId',
		'supplierId',
		'status',
		'createDateTime',
		'updateDateTime',
		),
	)); ?>
</div>
