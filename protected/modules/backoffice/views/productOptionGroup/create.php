<?php
/* @var $this ProductOptionGroupController */
/* @var $model ProductOptionGroup */

$this->breadcrumbs=array(
	'Product Option Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductOptionGroup', 'url'=>array('index')),
	array('label'=>'Manage ProductOptionGroup', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create ProductOptionGroup</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>