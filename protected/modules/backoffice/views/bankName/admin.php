<?php
/* @var $this BankNameController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bank Names',
);

$this->menu=array(
	array('label'=>'Create BankName', 'url'=>array('create')),
	array('label'=>'Manage BankName', 'url'=>array('index')),
);
?>

<h1>Bank Names</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
