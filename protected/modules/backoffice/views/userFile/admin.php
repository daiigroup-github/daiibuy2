<?php
/* @var $this UserFileController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Files',
);

$this->menu=array(
	array('label'=>'Create UserFile', 'url'=>array('create')),
	array('label'=>'Manage UserFile', 'url'=>array('admin')),
);
?>

<h1>User Files</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
