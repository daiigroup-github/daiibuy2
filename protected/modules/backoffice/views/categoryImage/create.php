<?php
/* @var $this CategoryImageController */
/* @var $model CategoryImage */

$this->breadcrumbs=array(
	'Category Images'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CategoryImage', 'url'=>array('index')),
	array('label'=>'Manage CategoryImage', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create CategoryImage</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>