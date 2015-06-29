<?php
/* @var $this FurnitureGroupController */
/* @var $model FurnitureGroup */

$this->breadcrumbs=array(
	'Furniture Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FurnitureGroup', 'url'=>array('index')),
	array('label'=>'Manage FurnitureGroup', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create FurnitureGroup</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>