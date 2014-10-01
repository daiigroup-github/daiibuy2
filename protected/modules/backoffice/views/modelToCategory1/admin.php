<?php
/* @var $this ModelToCategory1Controller */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Model To Category1s',
);

$this->menu=array(
	array('label'=>'Create ModelToCategory1', 'url'=>array('create')),
	array('label'=>'Manage ModelToCategory1', 'url'=>array('admin')),
);
?>

<h1>Model To Category1s</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
