<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs = array(
	'Products'=>array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label'=>'Manage Product',
		'url'=>array(
			'index')),
);

$this->pageHeader = 'เพิ่มสินค้า';
?>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model,
//	'productAttributeModel'=>$productAttributeModel,
//	'productAttributeValueModel'=>$productAttributeValueModel,
//	'productPromotion'=>$productPromotion
));
?>