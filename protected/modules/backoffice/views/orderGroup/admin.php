<?php
/* @var $this OrderGroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Order Groups',
);

$this->menu=array(
	array('label'=>'Create OrderGroup', 'url'=>array('create')),
	array('label'=>'Manage OrderGroup', 'url'=>array('admin')),
);
?>

<h1>Order Groups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
