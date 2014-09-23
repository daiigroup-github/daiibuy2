<?php
/* @var $this ProductSpecGroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Product Spec Groups',
);

$this->menu=array(
	array('label'=>'Create ProductSpecGroup', 'url'=>array('create')),
	array('label'=>'Manage ProductSpecGroup', 'url'=>array('admin')),
);
?>

<h1>Product Spec Groups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
