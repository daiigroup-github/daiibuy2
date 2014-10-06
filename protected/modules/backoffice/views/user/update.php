<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
	'Users'=>array(
		'index'),
	$model->userId=>array(
		'view',
		'id'=>$model->userId),
	'Update',
);

$this->menu = array(
	array(
		'label'=>'List User',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create User',
		'url'=>array(
			'create')),
	array(
		'label'=>'View User',
		'url'=>array(
			'view',
			'id'=>$model->userId)),
	array(
		'label'=>'Manage User',
		'url'=>array(
			'admin')),
);
?>

<h1>Update User <?php echo $model->userId; ?></h1>

<?php
$this->renderPartial('_form', array(
	'model'=>$model,
	'address'=>$address,
	'shippingAddressModel'=>$shippingAddressModel,
//	'supplierDiscountRangeModel'=>$supplierDiscountRangeModel,
	'supplierId'=>$model->userId,
	), FALSE, true);
?>