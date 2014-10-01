<?php
/* @var $this CategoryImageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Category Images',
);

$this->menu=array(
	array('label'=>'Create CategoryImage', 'url'=>array('create')),
	array('label'=>'Manage CategoryImage', 'url'=>array('admin')),
);
?>

<h1>Category Images</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
