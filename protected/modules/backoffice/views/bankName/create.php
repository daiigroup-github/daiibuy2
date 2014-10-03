<?php
/* @var $this BankNameController */
/* @var $model BankName */

$this->breadcrumbs=array(
	'Bank Names'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BankName', 'url'=>array('admin')),
	array('label'=>'Manage BankName', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Create BankName</h3>
	</div>
	<div class="module-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>
