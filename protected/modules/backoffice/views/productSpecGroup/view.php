<?php
/* @var $this ProductSpecGroupController */
/* @var $model ProductSpecGroup */

$this->breadcrumbs=array(
	'Product Spec Groups'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ProductSpecGroup', 'url'=>array('index')),
	array('label'=>'Create ProductSpecGroup', 'url'=>array('create')),
	array('label'=>'Update ProductSpecGroup', 'url'=>array('update', 'id'=>$model->productSpecGroupId)),
	array('label'=>'Delete ProductSpecGroup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->productSpecGroupId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductSpecGroup', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View ProductSpecGroup #<?php echo $model->productSpecGroupId; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'productSpecGroupId',
		'productId',
		'title',
		'description',
		'image',
		'parentId',
		'type',
		'status',
		'createDateTime',
		'updateDateTime',
		),
	)); ?>
</div>
