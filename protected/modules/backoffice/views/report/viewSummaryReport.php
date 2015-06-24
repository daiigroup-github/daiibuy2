<h2>สรุปยอดขาย</h2>
<script>
	function calTotalSummary(formName)
	{
		$.ajax({
			url: '<?php echo Yii::app()->createUrl("backoffice/report/calTotalSummary"); ?>',
			type: "GET",
			dataType: "json",
			data: $("#"+formName).serialize(),
			success: function (res) {
				if (res.status)
				{
					$('#totalSummary').html(res.totalSummary);
				}
				else
				{
					$('#totalSummary').html(res.totalSummary);
				}
			}
		});


	}
</script>
<?php
Yii::app()->clientScript->registerScript('search', "

$('#search-form').submit(function(){
	$('#order-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	calTotalSummary('search-form');
	return false;
});

$('#search-form2').submit(function(){
	$('#order-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	calTotalSummary('search-form2');
	return false;
});
");
?>
<div class="panel panel-default">
	<div class="panel-heading">
		Manage Categories
		<div class="pull-right">
			<?php
			if(isset(yii::app()->user->id))
			//if(User::model()->findByPk(Yii::app()->user->id)->type == 6)
			//{
			//        echo CHtml::link('<i class="icon-plus-sign icon-white"></i> เพิ่ม Distributor', array(
			//                'user/create'), array(
			//                'class'=>'btn btn-primary'));
			//}
			//else
				if(1 == 1)
				//if(User::model()->findByPk(Yii::app()->user->id)->type != 6)
				{
//					echo CHtml::link('<i class="icon-plus-sign icon-white"></i> เพิ่ม User', array(
//						'create'), array(
//						'class'=>'btn btn-primary btn-mini btn-xs'));
				}
			?>
		</div>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-lg-12">
				<?php
				$this->renderPartial('_search_summary', array(
					'model'=>$model,
				));
				?>

			</div>
		</div>
	</div>
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'order-grid',
		'dataProvider'=>$model->findAllSummaryReport(),
		'itemsCssClass'=>'table table-striped table-bordered table-condensed',
		'htmlOptions'=>array(
			'class'=>'span12'),
		//'filter'=>$model,
		'columns'=>array(
			'orderNo',
			'invoiceNo',
			//'invoicePrefix',
			//'userId',
			array(
				'header'=>'วันที่สั่งซื้อสินค้า',
				'name'=>'createDateTime',
				//'footer'=>'$data->total',
				'type'=>'text',
				'htmlOptions'=>array(
					'style'=>'text-align:center;width:15%'),
//			'value' => 'date("d-m-Y", $data->createDateTime)',
				'value'=>'MasterBackofficeController::dateThai(date("Y-m-d",strtotime($data->createDateTime)),1)',
			),
			array(
				'header'=>'ชื่อ',
				'name'=>'firstname',
			),
			array(
				'header'=>'นามสกุล',
				'name'=>'lastname',
			),
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
				'header'=>'Order Status',
				'name'=>'status',
				'type'=>'raw',
				'htmlOptions'=>array(
					'style'=>'text-align:left;width:20%'),
				'value'=>'$data->showOrderStatus($data->status)',
			),
			array(
				'header'=>'',
				'class'=>'CButtonColumn',
				'template'=>'{view} ',
				'buttons'=>array(
					'view' => array(
					'url'=>'Yii::app()->createUrl("/backoffice/order/view/id/$data->orderGroupId")',
					),
				),
			),
		),
	));
	?>
	<div class="row">
		<div class="col-sm-12" style="text-align: center">
			<h2 id="">รวมเป็นเงินทั้งสิ้น : <span id="totalSummary"><?php echo number_format($totalSummary, 2); ?></span>&nbsp;บาท</h2>
		</div>
	</div>
</div>