<?php // include 'e_payment/security.php'                                    ?>
<script>
	function checkMinimum(subTotal)
	{
		subTotal = subTotal.replace(",", "");
		var minimun = <?php echo number_format($supplierModel->minimumOrder, 2, ".", ""); ?>;
		lblMinError = document.getElementById("lblMinimumError<?php echo $supplierModel->userId; ?>");
		btnCheckout = document.getElementById("btnCheckout<?php echo $supplierModel->userId; ?>");
		if (subTotal >= minimun)
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
$daiibuy = new DaiiBuy();
$daiibuy->loadCookie();
$bankNameModel = new BankName();
$supplierArray = array_keys($daiibuy->cart);
$supplierId = $supplierArray[0] ? $supplierArray[0] : null;
//if($model->paymentMethod == 2)
//	echo CHtml::link('<i class="icon-print icon-white"></i> พิมพ์', Yii::app()->createUrl("order/printPayForm", array(
//			"id"=>$model->orderId)), array(
//		'class'=>'btn btn-warning',
//		'target'=>'_blank',));
?>
<form class="form" <?php echo ($model->paymentMethod == 1) ? 'action="' . Yii::app()->createUrl("order/confirmation") . '"' : ""; ?>  method="post">
	<?php
	echo CHtml::hiddenField("paymentMethod", $model->paymentMethod);
	if(($model->paymentMethod == 1))
	{
		$this->renderPartial("e_payment/_parameter_form", array(
			'model'=>$model));
	}
	?>
	<?php
//		  $this->renderPartial("e_payment/_parameter_form_2", array('model' => $model));
	?>

	<?php
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
		if(isset($supplierModel->userId))
			$this->renderPartial("transfer_form_print1", array(
				'supplierId'=>$supplierModel->userId));
	}
	?>
	<?php
	echo CHtml::link('แก้ไข', Yii::app()->createUrl("order/viewCart/" . $model->supplierId), array(
		'class'=>'btn btn-danger btn-small',));
	echo CHtml::submitButton('ยืนยัน', array(
		'class'=>'btn btn-success btn-small',
		'value'=>'ยืนยันการสั่งซื้อ',
		'id'=>'submit',
		'name'=>'submit'));
	?>
</form>