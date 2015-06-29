<?php
/* @var $this FurnitureItemSubController */
/* @var $model FurnitureItemSub */

$this->breadcrumbs=array(
	'Furniture Item Subs'=>array('index'),
	$model->furnitureItemSubId=>array('view','id'=>$model->furnitureItemSubId),
	'Update',
);

$this->menu=array(
	array('label'=>'List FurnitureItemSub', 'url'=>array('index')),
	array('label'=>'Create FurnitureItemSub', 'url'=>array('create')),
	array('label'=>'View FurnitureItemSub', 'url'=>array('view', 'id'=>$model->furnitureItemSubId)),
	array('label'=>'Manage FurnitureItemSub', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update FurnitureItemSub <?php echo $model->furnitureItemSubId; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>