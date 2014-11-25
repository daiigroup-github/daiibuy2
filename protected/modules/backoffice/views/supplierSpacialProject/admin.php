<?php
/* @var $this SupplierSpacialProjectController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Supplier Spacial Projects',
);

$this->menu=array(
	array('label'=>'Create SupplierSpacialProject', 'url'=>array('create')),
	array('label'=>'Manage SupplierSpacialProject', 'url'=>array('admin')),
);
?>

<h1>Supplier Spacial Projects</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
