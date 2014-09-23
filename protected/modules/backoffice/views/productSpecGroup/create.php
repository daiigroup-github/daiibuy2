<?php
/* @var $this ProductSpecGroupController */
/* @var $model ProductSpecGroup */

$this->breadcrumbs=array(
	'Product Spec Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductSpecGroup', 'url'=>array('index')),
	array('label'=>'Manage ProductSpecGroup', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create ProductSpecGroup</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>