<?php
/* @var $this FurnitureGroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Furniture Groups',
);

$this->menu=array(
	array('label'=>'Create FurnitureGroup', 'url'=>array('create')),
	array('label'=>'Manage FurnitureGroup', 'url'=>array('admin')),
);
?>

<h1>Furniture Groups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
