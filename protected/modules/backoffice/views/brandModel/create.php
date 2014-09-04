<?php
/* @var $this BrandModelController */
/* @var $model BrandModel */

$this->breadcrumbs=array(
	'Brand Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BrandModel', 'url'=>array('index')),
	array('label'=>'Manage BrandModel', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create BrandModel</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>