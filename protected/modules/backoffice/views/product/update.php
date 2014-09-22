<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs = array(
	'Products'=>array(
		'index'),
	$model->productId=>array(
		'view',
		'id'=>$model->productId),
	'Update',
);

$this->menu = array(
	array(
		'label'=>'Manage Product',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create Product',
		'url'=>array(
			'create')),
	array(
		'label'=>'View Product',
		'url'=>array(
			'view',
			'id'=>$model->productId)),
);

$this->pageHeader = 'Update Product ' . $model->productId;
?>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'productPromotion'=>$productPromotion,
	'productOption'=>$productOption,
	'productOptionGroup'=>$productOptionGroup
));
?>