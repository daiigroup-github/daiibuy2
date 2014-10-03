<?php
/* @var $this UserController */
/* @var $model User */
$this->pageHeader = "รายงานการเงิน";


$this->breadcrumbs = array(
	'Report',
);
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
	'method'=>'get',
	'htmlOptions'=>array(
		'class'=>'form-search well'
	),
	));
?>
<div class="input-append">
	<div class="control-group">
		<a class="btn btn-small" href="<?php echo Yii::app()->baseUrl . "/index.php/admin/report/viewSupplierReport" ?>"><i class="icon-file-alt"></i> รายงานยอดค้างชำระผู้ผลิตสินค้า (Supplier Report)</a>
	</div>
	<div class="control-group">
		<a class="btn btn-small" href="<?php echo Yii::app()->baseUrl . "/index.php/admin/report/viewDealerReport" ?>"><i class="icon-file-alt"></i> รายงานยอดค้างชำระผู้กระจายสินค้า (Distributor Report)</a>
	</div>
	<!--	echo CHtml::button('รายงานการค้างชำระผู้ผลิตสินค้า');
		echo CHtml::button('รายงานการค้างชำระผู้กระจายสินค้า');-->
</div>

<?php $this->endWidget(); ?>

<!--//foreach ($model as $groupOrder) {
//	if (isset($groupOrder->supplier)) {
//		echo "<h3>" . $groupOrder->supplier->firstname . " " . $groupOrder->supplier->lastname . "</h3>";
//
//		$this->widget('zii.widgets.grid.CGridView', array(
//			'id' => 'price-group-grid',
//			'dataProvider' => Order::model()->findOrderBySupplierId($groupOrder->supplierId),
//			//'filter'=>$order,
//			'itemsCssClass' => 'table table-striped table-bordered table-condensed table-hover',
//			'columns' => array(
//				'invoiceNo',
//				'paymentFirstname',
//				'paymentLastname',
//				array(
//					'name' => 'total',
//					//'footer'=>'$data->total',
//					'type' => 'text',
//					'htmlOptions' => array(
//						'style' => 'text-align:center;width:10%'),
//				),
//				array(
//					'name' => 'orderStatusid',
//					'type' => 'text',
//					'htmlOptions' => array(
//						'style' => 'text-align:center;width:10%'),
//				),
//				array(
//					'class' => 'CButtonColumn',
//				),
//			),
//		));
//		$totalMargin = Order::model()->getSumMargin($groupOrder->supplierId);
//		$totals = Order::model()->getSumOrderBySupplier($groupOrder->supplierId);
//		$intTotals = intval($totals['totals']);
//		$intTotalMargin = intval($totals['totals']) - intval($totalMargin['totalMargin']);
//		echo "<div align='Right'>";
//		echo "<p>รวมยอดขาย : " . formatMoney($intTotals, true) . " บาท</p>";
//		echo "<p>รวม Margin : " . formatMoney(intval($totalMargin['totalMargin']), true) . " บาท</p>";
//		echo "<p>รวมยอดต้องชำระ Supplier : " . formatMoney($intTotalMargin, true) . " บาท</p>";
//		echo "</div>";
//	} else {
//		//echo "<h4>NONE supplierId = " . $groupOrder->supplierId . "</h4>";
//	}
//}
//
//function formatMoney($number, $fractional = false) {
//	if ($fractional) {
//		$number = sprintf('%.2f', $number);
//	}
//	while (true) {
//		$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
//		if ($replaced != $number) {
//			$number = $replaced;
//		} else {
//			break;
//		}
//	}
//	return $number;
//}-->
