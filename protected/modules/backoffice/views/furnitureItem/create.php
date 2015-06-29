<?php
/* @var $this FurnitureItemController */
/* @var $model FurnitureItem */

$this->breadcrumbs=array(
	'Furniture Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FurnitureItem', 'url'=>array('index')),
	array('label'=>'Manage FurnitureItem', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create FurnitureItem</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>