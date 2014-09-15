<?php
/* @var $this OrderDetailTemplateController */
/* @var $model OrderDetailTemplate */

$this->breadcrumbs=array(
	'Order Detail Templates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OrderDetailTemplate', 'url'=>array('admin')),
	array('label'=>'Manage OrderDetailTemplate', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Create OrderDetailTemplate</h3>
	</div>
	<div class="module-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>