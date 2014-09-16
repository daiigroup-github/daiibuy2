<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs = array(
	'Products'=>array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label'=>'Manage Product',
		'url'=>array(
			'index')),
);

$this->pageHeader = 'เพิ่มสินค้า';
?>

<div class="panel panel-default">
	<div class="panel-heading">Create Brand</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array(
			'model'=>$model));
		?>
	</div>
</div>