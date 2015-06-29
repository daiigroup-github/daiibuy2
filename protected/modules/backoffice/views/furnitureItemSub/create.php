<?php
/* @var $this FurnitureItemSubController */
/* @var $model FurnitureItemSub */

$this->breadcrumbs=array(
	'Furniture Item Subs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FurnitureItemSub', 'url'=>array('index')),
	array('label'=>'Manage FurnitureItemSub', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create FurnitureItemSub</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>