<?php
/* @var $this SupplierContentController */
/* @var $model SupplierContent */

$this->breadcrumbs=array(
	'Supplier Contents'=>array('index'),
	$model->title=>array('view','id'=>$model->supplierContentId),
	'Update',
);

$this->menu=array(
	array('label'=>'List SupplierContent', 'url'=>array('index')),
	array('label'=>'Create SupplierContent', 'url'=>array('create')),
	array('label'=>'View SupplierContent', 'url'=>array('view', 'id'=>$model->supplierContentId)),
	array('label'=>'Manage SupplierContent', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update SupplierContent <?php echo $model->supplierContentId; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>