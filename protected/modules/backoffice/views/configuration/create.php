<?php
/* @var $this ConfigurationController */
/* @var $model Configuration */

$this->breadcrumbs = array(
	'Configurations'=>array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label'=>'List Configuration',
		'url'=>array(
			'index')),
	array(
		'label'=>'Manage Configuration',
		'url'=>array(
			'admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">Create Configuration</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array(
			'model'=>$model)); ?>
	</div>
</div>