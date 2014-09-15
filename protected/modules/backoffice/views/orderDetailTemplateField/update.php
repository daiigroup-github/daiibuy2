<?php
/* @var $this OrderDetailTemplateFieldController */
/* @var $model OrderDetailTemplateField */

$this->breadcrumbs=array(
	'Order Detail Template Fields'=>array('index'),
	$model->title=>array('view','id'=>$model->orderDetailTemplateFieldId),
	'Update',
);

$this->menu=array(
	array('label'=>'List OrderDetailTemplateField', 'url'=>array('admin')),
	array('label'=>'Create OrderDetailTemplateField', 'url'=>array('create')),
	array('label'=>'View OrderDetailTemplateField', 'url'=>array('view', 'id'=>$model->orderDetailTemplateFieldId)),
	array('label'=>'Manage OrderDetailTemplateField', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Update OrderDetailTemplateField <?php echo $model->orderDetailTemplateFieldId; ?></h3>
	</div>
	<div class="module-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>