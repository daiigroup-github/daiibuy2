<?php
/* @var $this FurnitureItemController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Furniture Items',
);

$this->menu=array(
	array('label'=>'Create FurnitureItem', 'url'=>array('create')),
	array('label'=>'Manage FurnitureItem', 'url'=>array('admin')),
);
?>

<h1>Furniture Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
