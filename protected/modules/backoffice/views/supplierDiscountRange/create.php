<?php
/* @var $this SupplierDiscountRangeController */
/* @var $model SupplierDiscountRange */

$this->breadcrumbs=array(
	'Supplier Discount Ranges'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SupplierDiscountRange', 'url'=>array('index')),
	array('label'=>'Manage SupplierDiscountRange', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create SupplierDiscountRange</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>