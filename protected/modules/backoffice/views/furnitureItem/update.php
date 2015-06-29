<?php
/* @var $this FurnitureItemController */
/* @var $model FurnitureItem */

$this->breadcrumbs=array(
	'Furniture Items'=>array('index'),
	$model->title=>array('view','id'=>$model->furnitureItemId),
	'Update',
);

$this->menu=array(
	array('label'=>'List FurnitureItem', 'url'=>array('index')),
	array('label'=>'Create FurnitureItem', 'url'=>array('create')),
	array('label'=>'View FurnitureItem', 'url'=>array('view', 'id'=>$model->furnitureItemId)),
	array('label'=>'Manage FurnitureItem', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update FurnitureItem <?php echo $model->furnitureItemId; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>