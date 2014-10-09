<?php
include("HOP.php");
$map;
?>
<script>
	function checkMinimum(subTotal)
	{
		subTotal = subTotal.replace(",", "");
		var minimun = <?php echo number_format($supplierModel->minimumOrder, 2, ".", ""); ?>;
		lblMinError = document.getElementById("lblMinimumError<?php echo $supplierModel->userId; ?>");
		btnCheckout = document.getElementById("btnCheckout<?php echo $supplierModel->userId; ?>");
		if(subTotal >= minimun)
		{
			lblMinError.style.display = "none";
			btnCheckout.style.display = "inline-table";
		}
		else
		{
			lblMinError.style.display = "inline-table";
			btnCheckout.style.display = "none";
		}
		location.reload();
	}
</script>
<h1>ยืนยันการชำระเงิน</h1>
<?php
if($model->paymentMethod == 2)
	echo CHtml::link('<i class="icon-print icon-white"></i> พิมพ์', Yii::app()->createUrl("order/printPayForm", array(
			"id"=>$model->orderId)), array(
		'class'=>'btn btn-warning',
		'target'=>'_blank',));
?>
<form class="form" action="<?php echo ($model->paymentMethod == 1) ? 'https://orderpagetest.ic3.com/hop/orderform.jsp' : ''; ?>"  method="post">
	<?php
	$map['amount'] = $model->total * 1.07;
	$map['currency'] = "THB";
	$map['orderPage_transactionType'] = "sale";
	$map['orderNumber'] = $model->orderNo;

	$map['billTo_firstName'] = $model->paymentFirstname;
	$map['billTo_lastName'] = $model->paymentLastname;
	$map['billTo_street1'] = "$model->paymentAddress1";
	$map['billTo_city'] = $model->province->provinceName;
	$map['billTo_country'] = "Thailand";

	InsertMapSignature($map);
	echo CHtml::hiddenField("paymentMethod", $model->paymentMethod);
	?>
	<?php
	$daiibuy = new DaiiBuy();
	$daiibuy->loadCookie();
	$this->renderPartial('sumCartAndVAT', array(
		'model'=>$model,
		'pageText'=>$this->selectPageTitle($model),
		'daiibuy'=>$daiibuy
	));
//	$this->renderPartial('_viewcart', array(
//		'products' => $products,
//		'supplierModel' => $supplierModel,
//		'amphurId' => $amphurId,
//		'isViewCart' => false));
	?>

	<?php
	if($model->paymentMethod == 2)
	{
		$this->renderPartial("transfer_form");
	}
	?>
	<?php
	echo CHtml::link('แก้ไข', Yii::app()->createUrl("order/viewCart/" . $model->supplierId), array(
		'class'=>'btn btn-danger btn-small',));
	echo CHtml::submitButton('ยืนยัน', array(
		'class'=>'btn btn-success btn-small',
		'value'=>'confirm',));
	?>
</form>