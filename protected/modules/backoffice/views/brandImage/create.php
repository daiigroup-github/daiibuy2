<?php
/* @var $this BrandImageController */
/* @var $model BrandImage */

$this->breadcrumbs=array(
	'Brand Images'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BrandImage', 'url'=>array('index')),
	array('label'=>'Manage BrandImage', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create BrandImage</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>