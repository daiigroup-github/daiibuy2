<?php
/* @var $this BrandImageController */
/* @var $model BrandImage */

$this->breadcrumbs=array(
	'Brand Images'=>array('index'),
	$model->title=>array('view','id'=>$model->brandImageId),
	'Update',
);

$this->menu=array(
	array('label'=>'List BrandImage', 'url'=>array('index')),
	array('label'=>'Create BrandImage', 'url'=>array('create')),
	array('label'=>'View BrandImage', 'url'=>array('view', 'id'=>$model->brandImageId)),
	array('label'=>'Manage BrandImage', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update BrandImage <?php echo $model->brandImageId; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>