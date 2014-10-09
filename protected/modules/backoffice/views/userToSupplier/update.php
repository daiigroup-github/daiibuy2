<?php
/* @var $this UserToSupplierController */
/* @var $model UserToSupplier */

$this->breadcrumbs=array(
	'User To Suppliers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserToSupplier', 'url'=>array('index')),
	array('label'=>'Create UserToSupplier', 'url'=>array('create')),
	array('label'=>'View UserToSupplier', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserToSupplier', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update UserToSupplier <?php echo $model->id; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>