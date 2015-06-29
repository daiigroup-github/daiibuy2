<?php
/* @var $this FurnitureController */
/* @var $model Furniture */

$this->breadcrumbs=array(
	'Furnitures'=>array('index'),
	$model->title=>array('view','id'=>$model->furnitureId),
	'Update',
);

$this->menu=array(
	array('label'=>'List Furniture', 'url'=>array('index')),
	array('label'=>'Create Furniture', 'url'=>array('create')),
	array('label'=>'View Furniture', 'url'=>array('view', 'id'=>$model->furnitureId)),
	array('label'=>'Manage Furniture', 'url'=>array('admin')),
);
?>

<h1>Update Furniture <?php echo $model->furnitureId; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>