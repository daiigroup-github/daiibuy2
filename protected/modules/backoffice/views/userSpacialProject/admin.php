<?php
/* @var $this UserSpacialProjectController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Spacial Projects',
);

$this->menu=array(
	array('label'=>'Create UserSpacialProject', 'url'=>array('create')),
	array('label'=>'Manage UserSpacialProject', 'url'=>array('admin')),
);
?>

<h1>User Spacial Projects</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
