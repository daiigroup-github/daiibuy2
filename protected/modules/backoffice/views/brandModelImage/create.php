<?php
/* @var $this BrandModelImageController */
/* @var $model BrandModelImage */

$this->breadcrumbs=array(
	'Brand Model Images'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BrandModelImage', 'url'=>array('index')),
	array('label'=>'Manage BrandModelImage', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create BrandModelImage</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>