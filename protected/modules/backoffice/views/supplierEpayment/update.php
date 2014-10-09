<?php
/* @var $this SupplierEpaymentController */
/* @var $model SupplierEpayment */

$this->breadcrumbs=array(
	'Supplier Epayments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SupplierEpayment', 'url'=>array('index')),
	array('label'=>'Create SupplierEpayment', 'url'=>array('create')),
	array('label'=>'View SupplierEpayment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SupplierEpayment', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update SupplierEpayment <?php echo $model->id; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>