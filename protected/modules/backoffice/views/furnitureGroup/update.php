<?php
/* @var $this FurnitureGroupController */
/* @var $model FurnitureGroup */

$this->breadcrumbs=array(
	'Furniture Groups'=>array('index'),
	$model->title=>array('view','id'=>$model->furnitureGroupId),
	'Update',
);

$this->menu=array(
	array('label'=>'List FurnitureGroup', 'url'=>array('index')),
	array('label'=>'Create FurnitureGroup', 'url'=>array('create')),
	array('label'=>'View FurnitureGroup', 'url'=>array('view', 'id'=>$model->furnitureGroupId)),
	array('label'=>'Manage FurnitureGroup', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update FurnitureGroup <?php echo $model->furnitureGroupId; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>