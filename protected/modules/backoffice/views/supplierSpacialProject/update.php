<?php
/* @var $this SupplierSpacialProjectController */
/* @var $model SupplierSpacialProject */

$this->breadcrumbs = array(
	'Supplier Spacial Projects'=>array(
		'index'),
	$model->title=>array(
		'view',
		'id'=>$model->supplierSpacialProjectId),
	'Update',
);

$this->menu = array(
	array(
		'label'=>'List SupplierSpacialProject',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create SupplierSpacialProject',
		'url'=>array(
			'create')),
	array(
		'label'=>'View SupplierSpacialProject',
		'url'=>array(
			'view',
			'id'=>$model->supplierSpacialProjectId)),
	array(
		'label'=>'Manage SupplierSpacialProject',
		'url'=>array(
			'admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update SupplierSpacialProject <?php echo $model->supplierSpacialProjectId; ?>	</div>
	<div class="panel-body">
<?php $this->renderPartial('_form', array(
	'model'=>$model,
	'supplier'=>$supplier));
?>
	</div>
</div>