<?php
/* @var $this SupplierContentGroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Supplier Content Groups',
);

$this->menu=array(
	array('label'=>'Create SupplierContentGroup', 'url'=>array('create')),
	array('label'=>'Manage SupplierContentGroup', 'url'=>array('admin')),
);
?>

<h1>Supplier Content Groups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
