<?php
/* @var $this OrderDetailTemplateController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Order Detail Templates',
);

$this->menu=array(
	array('label'=>'Create OrderDetailTemplate', 'url'=>array('create')),
	array('label'=>'Manage OrderDetailTemplate', 'url'=>array('admin')),
);
?>

<h1>Order Detail Templates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
