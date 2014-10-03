<h2>สรุปยอดขาย</h2>
<script>
	function calTotalSummary()
	{
		$.ajax({
			url: '<?php echo Yii::app()->createUrl("admin/report/calTotalSummary"); ?>',
			type: "GET",
			dataType: "json",
			data: $("#search-form").serialize(),
			success: function(res) {
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
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('#search-form').submit(function(){
	$('#order-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	calTotalSummary();
	return false;
});
");
?>
<div class="row-fluid">
	<div class="span12 text-center">
		<?php
		$this->renderPartial("_search_summary", array(
			"model"=>$model,));
		?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
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
					'value'=>'MasterAdminController::dateThai(date("Y-m-d",strtotime($data->createDateTime)),1)',
				),
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
					'name'=>'totalIncVAT',
					//'footer'=>'$data->total',
					'type'=>'text',
					'htmlOptions'=>array(
						'style'=>'text-align:center;width:10%'),
					'value'=>'number_format($data->totalIncVAT, 2, ".", ",")',
				),
				//'orderStatusid',
				array(
					'name'=>'orderStatusid',
					'type'=>'raw',
					'htmlOptions'=>array(
						'style'=>'text-align:left;width:20%'),
					'value'=>'$data->showOrderStatus($data->orderStatusid)',
				),
//		array(
//			'header'=>'',
//			'class'=>'CButtonColumn',
//			'template'=>'{view} ',
//			'buttons'=>array(
////				'view' => array(
////					'url'=>'isset($data->documentType->customView) ? Yii::app()->createUrl("document/".$data->documentType->customView, array("id"=>$data->documentId)): Yii::app()->createUrl("document/$data->documentId")',
////				),
//			),
//		),
			),
		));
		?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12" style="text-align: center">
		<h2 id="">รวมเป็นเงินทั้งสิน : <span id="totalSummary"><?php echo number_format($totalSummary, 2); ?></span>&nbsp;บาท</h2>
	</div>
</div>