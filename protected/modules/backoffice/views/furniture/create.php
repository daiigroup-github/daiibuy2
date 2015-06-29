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

<div class="panel panel-default">
	<div class="panel-heading">Create Furniture</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>