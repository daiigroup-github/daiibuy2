<?php
/* @var $this ProductSpecController */
/* @var $model ProductSpec */

$this->breadcrumbs=array(
	'Product Specs'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ProductSpec', 'url'=>array('index')),
	array('label'=>'Create ProductSpec', 'url'=>array('create')),
	array('label'=>'Update ProductSpec', 'url'=>array('update', 'id'=>$model->productSpecId)),
	array('label'=>'Delete ProductSpec', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->productSpecId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductSpec', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View ProductSpec #<?php echo $model->productSpecId; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'productSpecId',
		'productSpecGroupId',
		'title',
		'description',
		'image',
		'status',
		'createDateTime',
		'updateDateTime',
		),
	)); ?>
</div>
