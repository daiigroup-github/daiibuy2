<?php
/* @var $this UserToSupplierController */
/* @var $model UserToSupplier */

$this->breadcrumbs=array(
	'User To Suppliers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserToSupplier', 'url'=>array('index')),
	array('label'=>'Manage UserToSupplier', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create UserToSupplier</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>