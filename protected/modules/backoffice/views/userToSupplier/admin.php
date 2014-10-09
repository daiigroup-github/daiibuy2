<?php
/* @var $this UserToSupplierController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User To Suppliers',
);

$this->menu=array(
	array('label'=>'Create UserToSupplier', 'url'=>array('create')),
	array('label'=>'Manage UserToSupplier', 'url'=>array('admin')),
);
?>

<h1>User To Suppliers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
