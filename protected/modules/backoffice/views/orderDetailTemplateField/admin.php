<?php
/* @var $this OrderDetailTemplateFieldController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Order Detail Template Fields',
);

$this->menu=array(
	array('label'=>'Create OrderDetailTemplateField', 'url'=>array('create')),
	array('label'=>'Manage OrderDetailTemplateField', 'url'=>array('index')),
);
?>

<h1>Order Detail Template Fields</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
