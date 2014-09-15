<?php
/* @var $this OrderDetailController */
/* @var $model OrderDetail */

$this->breadcrumbs=array(
	'Order Details'=>array('index'),
	$model->orderDetailId=>array('view','id'=>$model->orderDetailId),
	'Update',
);

$this->menu=array(
	array('label'=>'List OrderDetail', 'url'=>array('admin')),
	array('label'=>'Create OrderDetail', 'url'=>array('create')),
	array('label'=>'View OrderDetail', 'url'=>array('view', 'id'=>$model->orderDetailId)),
	array('label'=>'Manage OrderDetail', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Update OrderDetail <?php echo $model->orderDetailId; ?></h3>
	</div>
	<div class="module-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>