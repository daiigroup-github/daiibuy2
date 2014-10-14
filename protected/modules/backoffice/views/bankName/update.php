<?php
/* @var $this BankNameController */
/* @var $model BankName */

$this->breadcrumbs = array(
	'Bank Names'=>array(
		'index'),
	$model->title=>array(
		'view',
		'id'=>$model->bankNameId),
	'Update',
);

$this->menu = array(
	array(
		'label'=>'List BankName',
		'url'=>array(
			'admin')),
	array(
		'label'=>'Create BankName',
		'url'=>array(
			'create')),
	array(
		'label'=>'View BankName',
		'url'=>array(
			'view',
			'id'=>$model->bankNameId)),
	array(
		'label'=>'Manage BankName',
		'url'=>array(
			'index')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">Update Bank Name</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array(
			'model'=>$model));
		?>
	</div>
</div>
