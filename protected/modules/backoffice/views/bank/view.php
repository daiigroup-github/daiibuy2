<?php
/* @var $this BankController */
/* @var $model Bank */

$this->breadcrumbs = array(
	'Banks'=>array(
		'index'),
	$model->bankName,
);

$this->menu = array(
	array(
		'label'=>'List Bank',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create Bank',
		'url'=>array(
			'create')),
	array(
		'label'=>'Update Bank',
		'url'=>array(
			'update',
			'id'=>$model->id)),
	array(
		'label'=>'Delete Bank',
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array(
				'delete',
				'id'=>$model->id),
			'confirm'=>'Are you sure you want to delete this item?')),
	array(
		'label'=>'Manage Bank',
		'url'=>array(
			'admin')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>View บัญชี #<?php echo $model->id; ?></h3>
	</div>
	<div class="module-option clearfix">
		<div class="btn-group pull-right">
			<?php
			echo CHtml::link('<i class="icon-plus-sign"></i>', $this->createUrl('create'), array(
				'class'=>'btn btn-small btn-primary'));
			?>
			<?php
			echo CHtml::link('<i class="icon-edit"></i>', $this->createUrl('update', array(
					'id'=>$model->id)), array(
				'class'=>'btn btn-small btn-warning'));
			?>
		</div>
	</div>
	<div class="module-body">
		<?php
		$bankNameModel = BankName::model()->findByPk($model->bankNameId);
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'htmlOptions'=>array(
				'class'=>'table table-striped table-border table-hover',
				'style'=>'margin-top:20px;'),
			'attributes'=>array(
				'$bankNameId',
//				$bankNameModel->logo,
				'branch',
				'accNo',
				'accName',
				'accType',
				'supplierId',
				'comcode',
				'status',
				'createDateTime',),
			)
		);
		?>
	</div>
</div>
