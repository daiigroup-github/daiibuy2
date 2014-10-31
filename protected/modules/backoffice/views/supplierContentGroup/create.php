<?php
/* @var $this SupplierContentGroupController */
/* @var $model SupplierContentGroup */

$this->breadcrumbs=array(
	'Supplier Content Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SupplierContentGroup', 'url'=>array('index')),
	array('label'=>'Manage SupplierContentGroup', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create SupplierContentGroup</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>