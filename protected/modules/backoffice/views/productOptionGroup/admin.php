<?php
/* @var $this ProductOptionGroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Product Option Groups',
);

$this->menu=array(
	array('label'=>'Create ProductOptionGroup', 'url'=>array('create')),
	array('label'=>'Manage ProductOptionGroup', 'url'=>array('admin')),
);
?>

<h1>Product Option Groups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
