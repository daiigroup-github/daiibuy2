<?php
/* @var $this OrderGroupController */
/* @var $model OrderGroup */

$this->breadcrumbs=array(
	'Order Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OrderGroup', 'url'=>array('index')),
	array('label'=>'Manage OrderGroup', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create OrderGroup</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>