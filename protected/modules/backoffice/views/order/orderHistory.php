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
		Manage Orders
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
			'orderNo',
			'invoiceNo',
			//'invoicePrefix',
			//'userId',
			'firstname',
			'lastname',
			array(
				'header'=>'ช่องทางการชำระ',
				'name'=>'paymentMethod',
				//'footer'=>'$data->total',
				'type'=>'text',
				'htmlOptions'=>array(
					'style'=>'text-align:center;width:8%'),
//			'value' => 'date("d-m-Y", $data->createDateTime)',
				'value'=>'$data->paymentMethod==1? "บัตรเครดิต": "บัญชีธนาคาร";',
			),
			//'totalIncVAT',
			array(
				'header'=>'ราคารวมภาษี(บาท)',
				'name'=>'summary',
				//'footer'=>'$data->total',
				'type'=>'text',
				'htmlOptions'=>array(
					'style'=>'text-align:center;width:10%'),
				'value'=>'number_format($data->summary, 2, ".", ",")',
			),
			//'orderStatusid',
			array(
				'name'=>'status',
				'type'=>'raw',
				'htmlOptions'=>array(
					'style'=>'text-align:left;width:20%'),
				'value'=>'$data->showOrderStatus($data->status)',
			),
			array(
				'header'=>'วันที่สั่งซื้อสินค้า',
				'name' => 'paymentDateTime',
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
				'template'=>'{view} ',
				'buttons'=>array(
//				'view' => array(
//					'url'=>'isset($data->documentType->customView) ? Yii::app()->createUrl("document/".$data->documentType->customView, array("id"=>$data->documentId)): Yii::app()->createUrl("document/$data->documentId")',
//				),
				),
			),
		),
	));
	?>

</div>


