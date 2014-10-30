<?php
/* @var $this SupplierContentGroupController */
/* @var $model SupplierContentGroup */

$this->breadcrumbs=array(
	'Supplier Content Groups'=>array('index'),
	$model->title=>array('view','id'=>$model->supplierContentGroupId),
	'Update',
);

$this->menu=array(
	array('label'=>'List SupplierContentGroup', 'url'=>array('index')),
	array('label'=>'Create SupplierContentGroup', 'url'=>array('create')),
	array('label'=>'View SupplierContentGroup', 'url'=>array('view', 'id'=>$model->supplierContentGroupId)),
	array('label'=>'Manage SupplierContentGroup', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update SupplierContentGroup <?php echo $model->supplierContentGroupId; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>