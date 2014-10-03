<?php
/* @var $this Category2ToProductController */
/* @var $model Category2ToProduct */

$this->breadcrumbs=array(
	'Category2 To Products'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Category2ToProduct', 'url'=>array('index')),
	array('label'=>'Manage Category2ToProduct', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create Category2ToProduct</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>