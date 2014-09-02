<?php
/* @var $this BrandModelController */
/* @var $model BrandModel */

$this->breadcrumbs=array(
	'Brand Models'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List BrandModel', 'url'=>array('index')),
	array('label'=>'Create BrandModel', 'url'=>array('create')),
	array('label'=>'Update BrandModel', 'url'=>array('update', 'id'=>$model->brandModelId)),
	array('label'=>'Delete BrandModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->brandModelId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BrandModel', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View BrandModel #<?php echo $model->brandModelId; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'brandModelId',
		'supplierId',
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
