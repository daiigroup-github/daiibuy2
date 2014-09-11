<?php
/* @var $this PriceGroupController */
/* @var $model PriceGroup */

$this->breadcrumbs = array(
	'Price Groups'=>array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label'=>'List PriceGroup',
		'url'=>array(
			'index')),
	array(
		'label'=>'Manage PriceGroup',
		'url'=>array(
			'admin')),
);

$this->pageHeader = 'สร้างกลุ่มราคา';
?>

<?php
foreach($provinceModel->provinceDealerAddress as $province)
	echo $province->provinceName . '<br />';
?>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'priceModel'=>$priceModel));
?>