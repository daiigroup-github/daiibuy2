<?php
/* @var $this UserController */
/* @var $model User */
$this->pageHeader = "รายงานการเงินค้างชำระผู้ผลิต";


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
	if(isset($groupOrder->supplier))
	{
		$countSup = $countSup + 1;
		$OrderDp = Order::model()->findOrderBySupplierId($groupOrder->supplierId);
		if($OrderDp->itemCount > 0)
		{
			echo "<div class='form-actions'>";
			echo "<a class='btn btn-large btn-primary pull-right' href=" . Yii::app()->baseUrl . "/index.php/admin/report/clearSupplierPayment/supplierId/" . $groupOrder->supplierId . " ><i class='icon-ok-sign icon-white'></i> ชำระเงิน</a>";
			//echo "<button type='submit' class='btn btn-primary pull-right' >ชำระเงิน</button>";
			echo isset($groupOrder->supplier->businessAddress->company) ? "<h3>" . $groupOrder->supplier->businessAddress->company . "</h3>" : "<h3>" . $groupOrder->supplier->firstname . " " . $groupOrder->supplier->lastname . "</h3>";

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
						'name'=>'total',
						//'footer'=>'$data->total',
						'type'=>'text',
						'htmlOptions'=>array(
							'style'=>'text-align:center;width:10%'),
						'value'=>'$data->formatMoney($data->total+$data->pointToBaht,true)',
					),
					array(
						'name'=>'orderStatusid',
						'type'=>'text',
						'htmlOptions'=>array(
							'style'=>'text-align:center;width:10%'),
						'value'=>'$data->showOrderStatus($data->orderStatusid)',
					),
//					array(
//						'class' => 'CButtonColumn',
//					),
				),
			));
			$totalMargin = Order::model()->getSumMargin($groupOrder->supplierId);
			$totals = Order::model()->getSumOrderBySupplier($groupOrder->supplierId);
			$intTotals = intval($totals['totals']);
			$intTotalMargin = intval($totals['totals']) - intval($totalMargin['totalMargin']);
			echo "<div align='Right'>";
			echo "<p>รวมยอดขาย : " . formatMoney($intTotals, true) . " บาท</p>";
			echo "<p>รวม Margin : " . formatMoney(intval($totalMargin['totalMargin']), true) . " บาท</p>";
			echo "<p><b>รวมยอดต้องชำระ Supplier : " . formatMoney($intTotalMargin, true) . "</b> บาท</p>";
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
