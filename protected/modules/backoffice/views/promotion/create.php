<?php
/* @var $this PromotionController */
/* @var $model Promotion */

$this->breadcrumbs=array(
	'Promotions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Promotion', 'url'=>array('admin')),
	array('label'=>'Manage Promotion', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Create Promotion</h3>
	</div>
	<div class="module-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>