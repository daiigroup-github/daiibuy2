<?php
/* @var $this ProductOptionController */
/* @var $model ProductOption */

$this->breadcrumbs=array(
	'Product Options'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ProductOption', 'url'=>array('index')),
	array('label'=>'Create ProductOption', 'url'=>array('create')),
	array('label'=>'Update ProductOption', 'url'=>array('update', 'id'=>$model->productOptionId)),
	array('label'=>'Delete ProductOption', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->productOptionId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductOption', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View ProductOption #<?php echo $model->productOptionId; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'productOptionId',
		'productIOptionGroupd',
		'title',
		'description',
		'image',
		'priceValue',
		'pricePercent',
		'status',
		'createDateTime',
		'updateDateTime',
		),
	)); ?>
</div>
