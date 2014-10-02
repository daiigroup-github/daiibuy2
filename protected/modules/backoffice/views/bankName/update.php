<?php
/* @var $this BankNameController */
/* @var $model BankName */

$this->breadcrumbs=array(
	'Bank Names'=>array('index'),
	$model->title=>array('view','id'=>$model->bankNameId),
	'Update',
);

$this->menu=array(
	array('label'=>'List BankName', 'url'=>array('admin')),
	array('label'=>'Create BankName', 'url'=>array('create')),
	array('label'=>'View BankName', 'url'=>array('view', 'id'=>$model->bankNameId)),
	array('label'=>'Manage BankName', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Update BankName <?php echo $model->bankNameId; ?></h3>
	</div>
	<div class="module-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>
