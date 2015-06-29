<?php
/* @var $this FurnitureController */
/* @var $model Furniture */

$this->breadcrumbs=array(
	'Furnitures'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Furniture', 'url'=>array('index')),
	array('label'=>'Manage Furniture', 'url'=>array('admin')),
);
?>

<h1>Create Furniture</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>