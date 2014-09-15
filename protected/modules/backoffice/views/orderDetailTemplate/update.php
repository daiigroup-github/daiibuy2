<?php
/* @var $this OrderDetailTemplateController */
/* @var $model OrderDetailTemplate */

$this->breadcrumbs=array(
	'Order Detail Templates'=>array('index'),
	$model->title=>array('view','id'=>$model->orderDetailTemplateId),
	'Update',
);

$this->menu=array(
	array('label'=>'List OrderDetailTemplate', 'url'=>array('admin')),
	array('label'=>'Create OrderDetailTemplate', 'url'=>array('create')),
	array('label'=>'View OrderDetailTemplate', 'url'=>array('view', 'id'=>$model->orderDetailTemplateId)),
	array('label'=>'Manage OrderDetailTemplate', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Update OrderDetailTemplate <?php echo $model->orderDetailTemplateId; ?></h3>
	</div>
	<div class="module-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>