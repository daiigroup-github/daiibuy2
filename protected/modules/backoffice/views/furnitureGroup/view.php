<?php
/* @var $this FurnitureGroupController */
/* @var $model FurnitureGroup */

$this->breadcrumbs=array(
	'Furniture Groups'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List FurnitureGroup', 'url'=>array('index')),
	array('label'=>'Create FurnitureGroup', 'url'=>array('create')),
	array('label'=>'Update FurnitureGroup', 'url'=>array('update', 'id'=>$model->furnitureGroupId)),
	array('label'=>'Delete FurnitureGroup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->furnitureGroupId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FurnitureGroup', 'url'=>array('admin')),
);
?>

<h1>View FurnitureGroup #<?php echo $model->furnitureGroupId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'furnitureGroupId',
		'categoryId',
		'title',
		'description',
		'image',
		'status',
		'createDateTime',
		'updateDateTime',
	),
)); ?>
