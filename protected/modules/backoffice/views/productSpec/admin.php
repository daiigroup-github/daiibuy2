<?php
/* @var $this ProductSpecController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Product Specs',
);

$this->menu=array(
	array('label'=>'Create ProductSpec', 'url'=>array('create')),
	array('label'=>'Manage ProductSpec', 'url'=>array('admin')),
);
?>

<h1>Product Specs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
