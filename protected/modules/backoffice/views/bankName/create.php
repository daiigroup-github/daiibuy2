<?php
/* @var $this BankNameController */
/* @var $model BankName */

$this->breadcrumbs = array(
	'Bank Names'=>array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label'=>'List BankName',
		'url'=>array(
			'admin')),
	array(
		'label'=>'Manage BankName',
		'url'=>array(
			'index')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">Create Bank Name</div>
	<div class="panel-body">
<?php $this->renderPartial('_form', array(
	'model'=>$model)); ?>
	</div>
</div>
