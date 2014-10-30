<?php
/* @var $this SupplierContentController */
/* @var $model SupplierContent */

$this->breadcrumbs=array(
	'Supplier Contents'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SupplierContent', 'url'=>array('index')),
	array('label'=>'Manage SupplierContent', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create SupplierContent</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>