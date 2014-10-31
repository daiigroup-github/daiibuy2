<?php
/* @var $this SupplierContentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Supplier Contents',
);

$this->menu=array(
	array('label'=>'Create SupplierContent', 'url'=>array('create')),
	array('label'=>'Manage SupplierContent', 'url'=>array('admin')),
);
?>

<h1>Supplier Contents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
