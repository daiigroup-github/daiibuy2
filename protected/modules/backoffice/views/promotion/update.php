<?php
/* @var $this PromotionController */
/* @var $model Promotion */

$this->breadcrumbs=array(
	'Promotions'=>array('index'),
	$model->title=>array('view','id'=>$model->promotionId),
	'Update',
);

$this->menu=array(
	array('label'=>'List Promotion', 'url'=>array('admin')),
	array('label'=>'Create Promotion', 'url'=>array('create')),
	array('label'=>'View Promotion', 'url'=>array('view', 'id'=>$model->promotionId)),
	array('label'=>'Manage Promotion', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Update Promotion <?php echo $model->promotionId; ?></h3>
	</div>
	<div class="module-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>