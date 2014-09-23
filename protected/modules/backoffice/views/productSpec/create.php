<?php
/* @var $this ProductSpecController */
/* @var $model ProductSpec */

$this->breadcrumbs=array(
	'Product Specs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductSpec', 'url'=>array('index')),
	array('label'=>'Manage ProductSpec', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create ProductSpec</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>