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

<h1>Create FurnitureItem</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>