<?php
/* @var $this SupplierController */
/* @var $model Supplier */

$this->breadcrumbs = array(
	'Suppliers'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List Supplier',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create Supplier',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#supplier-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Suppliers
		<div class="pull-right">
			<?php
			if(Yii::app()->user->userType == 4):
				echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array(
					'class'=>'btn btn-xs btn-primary'));
			endif;
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

	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'supplier-grid',
		'dataProvider'=>$model->search(),
		'itemsCssClass'=>'table table-striped table-bordered table-hover',
		'columns'=>array(
			array(
				'class'=>'IndexColumn'),
			'name',
			array(
				'name'=>'description',
				'value'=>'$data->description',
				'htmlOptions'=>array(
					'class'=>'col-md-4')
			),
			'address1',
			'address2',
			'tel',
			/*
			  'fax',
			  'logo',
			  'url',
			  'status',
			  'createDateTime',
			  'updateDateTime',
			 */
			array(
				'class'=>'CButtonColumn',
				'template'=>'{view} {update} {delete} {user} {ePayment} {discount} {content}',
				'buttons'=>array(
					'delete'=>array(
						'visible'=>'Yii::app()->user->userType == 4'
					),
					'user'=>array(
						'label'=>'<br><u>User</u>',
						'url'=>'Yii::app()->createUrl("/backoffice/userToSupplier/index?supplierId=".$data->supplierId)'
					),
					'ePayment'=>array(
						'label'=>'<br><u>e-Payment</u>',
						'url'=>'Yii::app()->createUrl("/backoffice/supplierEpayment/index?supplierId=".$data->supplierId)',
						'visible'=>'Yii::app()->user->userType == 4'
					),
					'discount'=>array(
						'label'=>'<br><u>Discount</u>',
						'url'=>'Yii::app()->createUrl("/backoffice/supplierDiscountRange/index?supplierId=".$data->supplierId)'
					),
					'content'=>array(
						'label'=>'<br><u>Content</u>',
						'url'=>'Yii::app()->createUrl("/backoffice/supplierContentGroup/index?supplierId=".$data->supplierId)'
					)
				),
				'htmlOptions'=>array(
					'class'=>'text-center',
					'style'=>'max-width:90px;min-width:70px'
				)
			),
		),
	));
	?>

</div>


