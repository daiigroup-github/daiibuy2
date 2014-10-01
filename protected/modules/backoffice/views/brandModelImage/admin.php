<?php
/* @var $this BrandModelImageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Brand Model Images',
);

$this->menu=array(
	array('label'=>'Create BrandModelImage', 'url'=>array('create')),
	array('label'=>'Manage BrandModelImage', 'url'=>array('admin')),
);
?>

<h1>Brand Model Images</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
