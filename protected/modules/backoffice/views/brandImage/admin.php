<?php
/* @var $this BrandImageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Brand Images',
);

$this->menu=array(
	array('label'=>'Create BrandImage', 'url'=>array('create')),
	array('label'=>'Manage BrandImage', 'url'=>array('admin')),
);
?>

<h1>Brand Images</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
