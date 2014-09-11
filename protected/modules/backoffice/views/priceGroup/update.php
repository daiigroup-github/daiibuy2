<?php
/* @var $this PriceGroupController */
/* @var $model PriceGroup */

$this->breadcrumbs = array(
	'Price Groups'=>array(
		'index'),
	$model->priceGroupId=>array(
		'view',
		'id'=>$model->priceGroupId),
	'Update',
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
	array(
		'label'=>'Create PriceGroup',
		'url'=>array(
			'create')),
	array(
		'label'=>'View PriceGroup',
		'url'=>array(
			'view',
			'id'=>$model->priceGroupId)),
);

$this->pageHeader = 'Update PriceGroup ' . $model->priceGroupId;
?>

<?php
foreach($provinceModel->provinceDealerAddress as $province)
	echo $province->provinceName . '<br />';
?>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'priceModel'=>$priceModel
));
?>