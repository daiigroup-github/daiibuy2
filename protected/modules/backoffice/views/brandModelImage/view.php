<?php
/* @var $this BrandModelImageController */
/* @var $model BrandModelImage */

$this->breadcrumbs=array(
	'Brand Model Images'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List BrandModelImage', 'url'=>array('index')),
	array('label'=>'Create BrandModelImage', 'url'=>array('create')),
	array('label'=>'Update BrandModelImage', 'url'=>array('update', 'id'=>$model->brandModelImageId)),
	array('label'=>'Delete BrandModelImage', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->brandModelImageId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BrandModelImage', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View BrandModelImage #<?php echo $model->brandModelImageId; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'brandModelImageId',
		'brandModelId',
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
