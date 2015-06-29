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

<div class="panel panel-default">
	<div class="panel-heading">
		Update Furniture <?php echo $model->furnitureId; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>