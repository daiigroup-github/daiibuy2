<?php
/* @var $this BrandImageController */
/* @var $model BrandImage */

$this->breadcrumbs=array(
	'Brand Images'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List BrandImage', 'url'=>array('index')),
	array('label'=>'Create BrandImage', 'url'=>array('create')),
	array('label'=>'Update BrandImage', 'url'=>array('update', 'id'=>$model->brandImageId)),
	array('label'=>'Delete BrandImage', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->brandImageId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BrandImage', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View BrandImage #<?php echo $model->brandImageId; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'brandImageId',
		'brandId',
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
