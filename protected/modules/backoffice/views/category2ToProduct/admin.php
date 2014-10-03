<?php
/* @var $this Category2ToProductController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Category2 To Products',
);

$this->menu=array(
	array('label'=>'Create Category2ToProduct', 'url'=>array('create')),
	array('label'=>'Manage Category2ToProduct', 'url'=>array('admin')),
);
?>

<h1>Category2 To Products</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
