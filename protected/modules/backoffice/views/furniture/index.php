<?php
/* @var $this FurnitureController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Furnitures',
);

$this->menu=array(
	array('label'=>'Create Furniture', 'url'=>array('create')),
	array('label'=>'Manage Furniture', 'url'=>array('admin')),
);
?>

<h1>Furnitures</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
