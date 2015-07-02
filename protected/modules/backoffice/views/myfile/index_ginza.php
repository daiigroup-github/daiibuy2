<?php
/* @var $this OrderController */
/* @var $model Order */

$this->breadcrumbs = array(
	'Orders'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List Order',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create Order',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#order-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Myfile
		<div class="pull-right">
			<?php
//			echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array(
//				'class'=>'btn btn-xs btn-primary'));
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
		'id'=>'order-grid',
		'dataProvider'=>$searchFn,
		'itemsCssClass'=>'table table-striped table-bordered table-condensed',
		'htmlOptions'=>array(
			'class'=>'span12'),
		//'filter'=>$model,
		'columns'=>array(
			array(
				'class'=>'IndexColumn'
			),
//			'orderNo',
//			'invoiceNo',
			//'invoicePrefix',
			//'userId',
			array(
				'name'=>'userId',
				'value'=>'isset($data->user)?$data->user->firstname." ".$data->user->lastname:"-"'
			),
			'orderNo',
			'invoiceNo',
//			'firstname',
//			'lastname',
//			array(
//				'header'=>'ช่องทางการชำระ',
//				'name'=>'paymentMethod',
//				'type'=>'text',
//				'htmlOptions'=>array(
//					'style'=>'text-align:center;width:8%'),
//				'value'=>'$data->paymentMethod==1? "บัตรเครดิต": "บัญชีธนาคาร";',
//			),
			//'totalIncVAT',
			array(
				'header'=>'ราคารวมภาษี(บาท)',
				'name'=>'total',
				//'footer'=>'$data->total',
				'type'=>'text',
				'htmlOptions'=>array(
					'style'=>'text-align:center;width:10%'),
				'value'=>'number_format($data->total, 2, ".", ",")',
			),
			//'orderStatusid',
			array(
				'name'=>'status',
				'type'=>'raw',
				'htmlOptions'=>array(
					'style'=>'text-align:left;width:20%'),
				'value'=>'$data->showOrderStatus($data->status)',
			),
//			array(
//				'name'=>'type',
//				'type'=>'raw',
//				'htmlOptions'=>array(
//					'style'=>'text-align:left;width:20%'),
//				'value'=>'$data->showOrderType($data->type)',
//			),
			array(
				'header'=>'วันที่สร้าง',
				'name'=>'createDateTime',
				//'footer'=>'$data->total',
				'type'=>'text',
				'htmlOptions'=>array(
					'style'=>'text-align:center;width:15%'),
//			'value' => 'date("d-m-Y", $data->createDateTime)',
				'value'=>'$this->grid->controller->dateThai(date("Y-m-d",strtotime($data->createDateTime)),1)',
			),
			/*
			  'email',
			  'telephone',
			  'fax',
			  'paymentFirstname',
			  'paymentLastname',
			  'paymentCompany',
			  'paymentAddress1',
			  'paymentAddress2',
			  'shippingProvince',
			  'paymentPostcode',
			  'paymentAddressFormat',
			  'paymentMethod',
			  'paymentCode',
			  'shippingFirstname',
			  'shippingLastname',
			  'shippingCompany',
			  'shippingAddress1',
			  'shippingAddress2',
			  'shippingCity',
			  'shippingPostcode',
			  'shippingAddressFormat',
			  'shippingMethod',
			  'shippingCode',
			  'comment',


			  'dealerId',
			  'commission',
			  'ip',
			  'forwardedIp',
			  'userAgent',
			  'createDateTime',
			  'updateDateTime',
			 */
			array(
				'header'=>'',
				'class'=>'CButtonColumn',
				'template'=>'{send}',
				'buttons'=>array(
					'send'=>array(
						'label'=>'<u>ส่งงาน</u>',
						'url'=>'Yii::app()->createUrl("/backoffice/myfile/sendWork/id/".$data->orderGroupId)',
					),
				),
				'htmlOptions'=>array(
					'class'=>"text-center")
			),
		),
	));
	?>

</div>


