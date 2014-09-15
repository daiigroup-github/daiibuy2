<?php
/* @var $this OrderController */
/* @var $model Order */

$this->breadcrumbs=array(
	'Orders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Order', 'url'=>array('admin')),
	array('label'=>'Manage Order', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Create Order</h3>
	</div>
	<div class="module-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>