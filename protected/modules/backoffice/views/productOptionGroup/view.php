<?php
/* @var $this ProductOptionGroupController */
/* @var $model ProductOptionGroup */

$this->breadcrumbs=array(
	'Product Option Groups'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ProductOptionGroup', 'url'=>array('index')),
	array('label'=>'Create ProductOptionGroup', 'url'=>array('create')),
	array('label'=>'Update ProductOptionGroup', 'url'=>array('update', 'id'=>$model->productOptionGroupId)),
	array('label'=>'Delete ProductOptionGroup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->productOptionGroupId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductOptionGroup', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View ProductOptionGroup #<?php echo $model->productOptionGroupId; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'productOptionGroupId',
		'productId',
		'title',
		'description',
		'image',
		'sortOrder',
		'status',
		'createDateTime',
		'updateDateTime',
		),
	)); ?>
</div>
