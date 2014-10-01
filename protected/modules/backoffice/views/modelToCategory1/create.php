<?php
/* @var $this ModelToCategory1Controller */
/* @var $model ModelToCategory1 */

$this->breadcrumbs=array(
	'Model To Category1s'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ModelToCategory1', 'url'=>array('index')),
	array('label'=>'Manage ModelToCategory1', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create ModelToCategory1</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>