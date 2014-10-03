<?php
/* @var $this BankNameController */
/* @var $model BankName */

$this->breadcrumbs=array(
	'Bank Names'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List BankName', 'url'=>array('admin')),
	array('label'=>'Create BankName', 'url'=>array('create')),
	array('label'=>'Update BankName', 'url'=>array('update', 'id'=>$model->bankNameId)),
	array('label'=>'Delete BankName', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->bankNameId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BankName', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>View BankName #<?php echo $model->bankNameId; ?></h3>
	</div>
	<div class="module-option clearfix">
		<div class="btn-group pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i>', $this->createUrl('create'), array('class'=>'btn btn-small btn-primary'));?>
			<?php echo CHtml::link('<i class="icon-edit"></i>', $this->createUrl('update', array('id'=>$model->bankNameId)), array('class'=>'btn btn-small btn-warning'));?>
		</div>
	</div>
	<div class="module-body">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'htmlOptions'=>array('class'=>'table table-striped table-border table-hover', 'style'=>'margin-top:20px;'),
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
		)); ?>
	</div>
</div>
