<?php
/* @var $this BankNameController */
/* @var $model BankName */

$this->breadcrumbs = array(
	'Bank Names'=>array(
		'index'),
	$model->title,
);

$this->menu = array(
	array(
		'label'=>'List BankName',
		'url'=>array(
			'admin')),
	array(
		'label'=>'Create BankName',
		'url'=>array(
			'create')),
	array(
		'label'=>'Update BankName',
		'url'=>array(
			'update',
			'id'=>$model->bankNameId)),
	array(
		'label'=>'Delete BankName',
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array(
				'delete',
				'id'=>$model->bankNameId),
			'confirm'=>'Are you sure you want to delete this item?')),
	array(
		'label'=>'Manage BankName',
		'url'=>array(
			'index')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		View BankName #<?php echo $model->bankNameId; ?><div class="pull-right">
			<?php
			echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array(
				'class'=>'btn btn-xs btn-primary'));
			?></div>
	</div>
</div>
<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions'=>array(
		'class'=>'table table-striped table-border table-hover',
		'style'=>''),
	'attributes'=>array(
		'title',
		'description:html',
		'logo',
		array(
			'name'=>'status',
			'type'=>'raw',
			'value'=>$model->getStatusText($model->status),
		),
		'createDateTime',
		'updateDateTime',
	),
));
?>
</div>
