<?php
/* @var $this SupplierEpaymentController */
/* @var $model SupplierEpayment */

$this->breadcrumbs = array(
	'Supplier Epayments'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List SupplierEpayment',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create SupplierEpayment',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#supplier-epayment-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Supplier Epayments
		<div class="pull-right">
			<?php
			echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create?supplierId=' . $_GET["supplierId"]), array(
				'class'=>'btn btn-xs btn-primary'));
			?>
		</div>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-lg-12">
				<?php
				$this->renderPartial('_search', array(
					'model'=>$model,
				));
				?>
			</div>
		</div>
	</div>
	<h3><?php echo isset($model->supplier) ? $model->supplier->name : "-" ?></h3>
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'supplier-epayment-grid',
		'dataProvider'=>$model->search(),
//			'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered table-hover',
		'columns'=>array(
			array(
				'class'=>'IndexColumn'),
//				'id',
//			'supplierId',
			'enableEPayment',
			'ePaymentTel',
			'ePaymentMerchantId',
			'ePaymentProfileId',
//			'ePaymentOrgId',
			array(
				'name'=>'type',
				'value'=>'$data->getEpaymentTypeText($data->type)'
			),
			/*
			  'ePaymentUrl',
			  'ePaymentAccessKey',

			  'ePaymentSecretKey',
			  'type',
			  'status',
			  'createDateTime',
			  'updateDateTime',
			 */
			array(
				'class'=>'CButtonColumn',
			),
		),
	));
	?>

</div>


