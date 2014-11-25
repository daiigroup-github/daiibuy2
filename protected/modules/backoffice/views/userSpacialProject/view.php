<?php
/* @var $this UserSpacialProjectController */
/* @var $model UserSpacialProject */

$this->breadcrumbs=array(
	'User Spacial Projects'=>array('index'),
	$model->userSpacialProjectId,
);

$this->menu=array(
	array('label'=>'List UserSpacialProject', 'url'=>array('index')),
	array('label'=>'Create UserSpacialProject', 'url'=>array('create')),
	array('label'=>'Update UserSpacialProject', 'url'=>array('update', 'id'=>$model->userSpacialProjectId)),
	array('label'=>'Delete UserSpacialProject', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->userSpacialProjectId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserSpacialProject', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View UserSpacialProject #<?php echo $model->userSpacialProjectId; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'userSpacialProjectId',
		'supplierId',
		'userId',
		'orderGroupId',
		'orderId',
		'supplierSpacialProjectId',
		'spacialCode',
		'spacialPercent',
		'image',
		'status',
		'createDateTime',
		'updateDateTime',
		),
	)); ?>
</div>
