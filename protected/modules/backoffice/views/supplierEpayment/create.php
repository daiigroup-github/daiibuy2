<?php
/* @var $this SupplierEpaymentController */
/* @var $model SupplierEpayment */

$this->breadcrumbs=array(
	'Supplier Epayments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SupplierEpayment', 'url'=>array('index')),
	array('label'=>'Manage SupplierEpayment', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create SupplierEpayment</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>