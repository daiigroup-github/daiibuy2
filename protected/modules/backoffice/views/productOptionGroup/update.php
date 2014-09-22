<?php
/* @var $this ProductOptionGroupController */
/* @var $model ProductOptionGroup */

$this->breadcrumbs=array(
	'Product Option Groups'=>array('index'),
	$model->title=>array('view','id'=>$model->productOptionGroupId),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductOptionGroup', 'url'=>array('index')),
	array('label'=>'Create ProductOptionGroup', 'url'=>array('create')),
	array('label'=>'View ProductOptionGroup', 'url'=>array('view', 'id'=>$model->productOptionGroupId)),
	array('label'=>'Manage ProductOptionGroup', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update ProductOptionGroup <?php echo $model->productOptionGroupId; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>