<?php
/* @var $this CategoryToSubController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Category To Subs',
);

$this->menu=array(
	array('label'=>'Create CategoryToSub', 'url'=>array('create')),
	array('label'=>'Manage CategoryToSub', 'url'=>array('admin')),
);
?>

<h1>Category To Subs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
