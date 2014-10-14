<?php
/* @var $this BankController */
/* @var $model Bank */

$this->breadcrumbs = array(
	'Banks'=>array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label'=>'List Bank',
		'url'=>array(
			'index')),
	array(
		'label'=>'Manage Bank',
		'url'=>array(
			'admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create Bank</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array(
			'model'=>$model)); ?>
	</div>
</div>