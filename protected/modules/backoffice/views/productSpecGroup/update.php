<?php
/* @var $this ProductSpecGroupController */
/* @var $model ProductSpecGroup */

$this->breadcrumbs=array(
	'Product Spec Groups'=>array('index'),
	$model->title=>array('view','id'=>$model->productSpecGroupId),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductSpecGroup', 'url'=>array('index')),
	array('label'=>'Create ProductSpecGroup', 'url'=>array('create')),
	array('label'=>'View ProductSpecGroup', 'url'=>array('view', 'id'=>$model->productSpecGroupId)),
	array('label'=>'Manage ProductSpecGroup', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update ProductSpecGroup <?php echo $model->productSpecGroupId; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>