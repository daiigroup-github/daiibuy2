<?php
/* @var $this FurnitureController */
/* @var $model Furniture */

$this->breadcrumbs=array(
	'Furnitures'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Furniture', 'url'=>array('index')),
	array('label'=>'Create Furniture', 'url'=>array('create')),
	array('label'=>'Update Furniture', 'url'=>array('update', 'id'=>$model->furnitureId)),
	array('label'=>'Delete Furniture', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->furnitureId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Furniture', 'url'=>array('admin')),
);
?>

<h1>View Furniture #<?php echo $model->furnitureId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'furnitureId',
		'furnitureGroupId',
		'title',
		'description',
		'image',
		'status',
		'createDateTime',
		'updateDateTime',
	),
)); ?>
