<?php
/* @var $this OrderController */
/* @var $model Order */

$this->breadcrumbs=array(
	'Orders'=>array('index'),
	$model->title=>array('view','id'=>$model->orderId),
	'Update',
);

$this->menu=array(
	array('label'=>'List Order', 'url'=>array('admin')),
	array('label'=>'Create Order', 'url'=>array('create')),
	array('label'=>'View Order', 'url'=>array('view', 'id'=>$model->orderId)),
	array('label'=>'Manage Order', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Update Order <?php echo $model->orderId; ?></h3>
	</div>
	<div class="module-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>