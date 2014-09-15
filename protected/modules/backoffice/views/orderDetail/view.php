<?php
/* @var $this OrderDetailController */
/* @var $model OrderDetail */

$this->breadcrumbs=array(
	'Order Details'=>array('index'),
	$model->orderDetailId,
);

$this->menu=array(
	array('label'=>'List OrderDetail', 'url'=>array('admin')),
	array('label'=>'Create OrderDetail', 'url'=>array('create')),
	array('label'=>'Update OrderDetail', 'url'=>array('update', 'id'=>$model->orderDetailId)),
	array('label'=>'Delete OrderDetail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->orderDetailId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OrderDetail', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>View OrderDetail #<?php echo $model->orderDetailId; ?></h3>
	</div>
	<div class="module-option clearfix">
		<div class="btn-group pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i>', $this->createUrl('create'), array('class'=>'btn btn-small btn-primary'));?>
			<?php echo CHtml::link('<i class="icon-edit"></i>', $this->createUrl('update', array('id'=>$model->orderDetailId)), array('class'=>'btn btn-small btn-warning'));?>
		</div>
	</div>
	<div class="module-body">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'htmlOptions'=>array('class'=>'table table-striped table-border table-hover', 'style'=>'margin-top:20px;'),
			'attributes'=>array(
				'orderId',
		'createDateTime',
		'updateDateTime',
			),
		)); ?>
	</div>
</div>