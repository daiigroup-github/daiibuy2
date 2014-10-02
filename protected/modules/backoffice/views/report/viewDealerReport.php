<?php
/* @var $this UserController */
/* @var $model User */
$this->pageHeader = "รายงานการเงินค้างชำระผู้กระจายสินค้า";


$this->breadcrumbs = array(
	'Report',
);

function formatMoney($number, $fractional = false)
{
	if($fractional)
	{
		$number = sprintf('%.2f', $number);
	}
	while(true)
	{
		$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
		if($replaced != $number)
		{
			$number = $replaced;
		}
		else
		{
			break;
		}
	}
	return $number;
}

$countSup = 0;

foreach($model as $groupOrder)
{
	if(isset($groupOrder->dealer))
	{
		$countSup = $countSup + 1;
		$OrderDp = Order::model()->findOrderByDealerId($groupOrder->dealerId);
		if($OrderDp->itemCount > 0)
		{
			echo "<div class='form-actions'>";
			echo "<a class='btn btn-large btn-primary pull-right' href=" . Yii::app()->baseUrl . "/index.php/admin/report/clearDealerPayment/dealerId/" . $groupOrder->dealerId . "><i class='icon-ok-sign icon-white'></i> ชำระเงิน</a>";
			echo isset($groupOrder->dealer->businessAddress->company) ? "<h3>" . $groupOrder->dealer->businessAddress->company . "</h3>" : "<h3>" . $groupOrder->dealer->firstname . " " . $groupOrder->dealer->lastname . "</h3>";

			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'price-group-grid',
				'dataProvider'=>$OrderDp,
				'summaryText'=>'',
				'selectableRows'=>2,
				//'filter'=>$order,
				'itemsCssClass'=>'table table-striped table-bordered table-condensed table-hover',
				'columns'=>array(
					array(
						'name'=>'selectedItems',
						'class'=>'CCheckBoxColumn',),
					'invoiceNo',
					'orderNo',
					'paymentFirstname',
					'paymentLastname',
					array(
						'name'=>'orderStatusid',
						'type'=>'text',
						'htmlOptions'=>array(
							'style'=>'text-align:center;width:10%'),
						'value'=>'$data->showOrderStatus($data->orderStatusid)',
					),
					array(
						'name'=>'totalIncVAT',
						//'footer'=>'$data->total',
						'type'=>'text',
						'htmlOptions'=>array(
							'style'=>'text-align:center;width:10%'),
						'value'=>'$data->formatMoney($data->total+$data->pointToBaht,true)',
					),
					array(
						'name'=>'marginToDaii',
						//'footer'=>'$data->total',
						'type'=>'text',
						'header'=>'ค่า Magin สำหรับ Daii',
						'htmlOptions'=>array(
							'style'=>'text-align:center;width:10%'),
						'value'=>'$data->formatMoney($data->marginToDaii,true)',
					),
					array(
						'name'=>'marginToDealer',
						//'footer'=>'$data->total',
						'type'=>'text',
						'header'=>'ค่า Magin สำหรับ Distributor',
						'htmlOptions'=>array(
							'style'=>'text-align:center;width:10%'),
						'value'=>'$data->formatMoney($data->marginToDealer,true)',
					),
//					array(
//						'class' => 'CButtonColumn',
//					),
				),
			));
			$totalMargin = Order::model()->getSumMarginDealer($groupOrder->dealerId);
			//$totals = Order::model()->getSumOrderBySupplier($groupOrder->supplierId);
			$intTotalMarginTemp = floatval($totalMargin['sumMarginDealer']);
			$intTotalMargin = $intTotalMarginTemp - ($intTotalMarginTemp * 0.03);
//		$intTotalMargin = intval($totals['totals']) - intval($totalMargin['totalMargin']);
			echo "<div align='Right'>";
			//echo "<p>รวมยอดขาย : " . formatMoney($intTotals, true) . " บาท</p>";
			//echo "<p>รวม Margin ที่ได้รับ : " . formatMoney(intval($totalMargin['totalMargin']), true) . " บาท</p>";
			echo "<p>รวม Margin Distributor : " . formatMoney($intTotalMarginTemp, true) . " บาท</p>";
			echo "<p>หักภาษี ณ ที่จ่าย 3 % : " . formatMoney($intTotalMarginTemp * 0.03, true) . " บาท</p>";
			echo "<p><b>รวมยอดที่ต้องชำระ Distributor : " . formatMoney($intTotalMargin, true) . " บาท</b></p>";
			echo "</div>";
			echo "</div>";
		}
	}
}

if($countSup < 1)
{
	echo "<div class='form-actions'>";
	echo "<h4>ไม่มีรายการค้างชำระ. </h4>";
	echo "</div>";
}
?>
