<?php
/* @var $this SupplierSpacialProjectController */
/* @var $model SupplierSpacialProject */

$this->breadcrumbs = array(
	'Supplier Spacial Projects'=>array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label'=>'List SupplierSpacialProject',
		'url'=>array(
			'index')),
	array(
		'label'=>'Manage SupplierSpacialProject',
		'url'=>array(
			'admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create SupplierSpacialProject</div>
	<div class="panel-body">
<?php $this->renderPartial('_form', array(
	'model'=>$model,
	'supplier'=>$supplier));
?>
	</div>
</div>