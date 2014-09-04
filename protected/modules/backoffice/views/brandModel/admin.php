<?php
/* @var $this BrandModelController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Brand Models',
);

$this->menu=array(
	array('label'=>'Create BrandModel', 'url'=>array('create')),
	array('label'=>'Manage BrandModel', 'url'=>array('admin')),
);
?>

<h1>Brand Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
