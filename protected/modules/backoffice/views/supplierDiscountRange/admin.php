<?php
/* @var $this SupplierDiscountRangeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Supplier Discount Ranges',
);

$this->menu=array(
	array('label'=>'Create SupplierDiscountRange', 'url'=>array('create')),
	array('label'=>'Manage SupplierDiscountRange', 'url'=>array('admin')),
);
?>

<h1>Supplier Discount Ranges</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
