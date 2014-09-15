<?php
/* @var $this OrderDetailTemplateFieldController */
/* @var $model OrderDetailTemplateField */

$this->breadcrumbs=array(
	'Order Detail Template Fields'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OrderDetailTemplateField', 'url'=>array('admin')),
	array('label'=>'Manage OrderDetailTemplateField', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Create OrderDetailTemplateField</h3>
	</div>
	<div class="module-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>