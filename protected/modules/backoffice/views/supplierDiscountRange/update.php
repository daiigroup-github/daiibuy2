<?php
/* @var $this SupplierDiscountRangeController */
/* @var $model SupplierDiscountRange */

$this->breadcrumbs=array(
	'Supplier Discount Ranges'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SupplierDiscountRange', 'url'=>array('index')),
	array('label'=>'Create SupplierDiscountRange', 'url'=>array('create')),
	array('label'=>'View SupplierDiscountRange', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SupplierDiscountRange', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update SupplierDiscountRange <?php echo $model->id; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>