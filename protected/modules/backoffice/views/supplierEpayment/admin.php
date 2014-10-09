<?php
/* @var $this SupplierEpaymentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Supplier Epayments',
);

$this->menu=array(
	array('label'=>'Create SupplierEpayment', 'url'=>array('create')),
	array('label'=>'Manage SupplierEpayment', 'url'=>array('admin')),
);
?>

<h1>Supplier Epayments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
