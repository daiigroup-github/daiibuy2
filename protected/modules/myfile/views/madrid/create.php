<?php
/* @var $this MadridController */
/* @var $model Order */

$this->breadcrumbs = array(
	'Orders'=>array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label'=>'List Order',
		'url'=>array(
			'index')),
	array(
		'label'=>'Manage Order',
		'url'=>array(
			'admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create Order</div>
	<div class="panel-body">
		<?php
		$this->renderPartial('_form', array(
			'categoryItems'=>$categoryItems,
			'model'=>$model,
			'orderDetailTemplateField'=>$orderDetailTemplateField,));
		?>
	</div>
</div>