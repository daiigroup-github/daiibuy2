<?php
/* @var $this OrderDetailController */
/* @var $model OrderDetail */

$this->breadcrumbs=array(
	'Order Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OrderDetail', 'url'=>array('admin')),
	array('label'=>'Manage OrderDetail', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Create OrderDetail</h3>
	</div>
	<div class="module-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>