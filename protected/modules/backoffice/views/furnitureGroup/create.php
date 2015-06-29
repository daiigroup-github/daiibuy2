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

<h1>Create FurnitureGroup</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>