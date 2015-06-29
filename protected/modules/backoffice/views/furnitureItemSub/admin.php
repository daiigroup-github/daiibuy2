<?php
/* @var $this FurnitureItemSubController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Furniture Item Subs',
);

$this->menu=array(
	array('label'=>'Create FurnitureItemSub', 'url'=>array('create')),
	array('label'=>'Manage FurnitureItemSub', 'url'=>array('admin')),
);
?>

<h1>Furniture Item Subs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
