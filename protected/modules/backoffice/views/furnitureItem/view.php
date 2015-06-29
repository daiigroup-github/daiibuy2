<?php
/* @var $this FurnitureItemController */
/* @var $model FurnitureItem */

$this->breadcrumbs=array(
	'Furniture Items'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List FurnitureItem', 'url'=>array('index')),
	array('label'=>'Create FurnitureItem', 'url'=>array('create')),
	array('label'=>'Update FurnitureItem', 'url'=>array('update', 'id'=>$model->furnitureItemId)),
	array('label'=>'Delete FurnitureItem', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->furnitureItemId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FurnitureItem', 'url'=>array('admin')),
);
?>

<h1>View FurnitureItem #<?php echo $model->furnitureItemId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'furnitureItemId',
		'furnitureId',
		'title',
		'description',
		'image',
		'status',
		'createDateTime',
		'updateDateTime',
	),
)); ?>
