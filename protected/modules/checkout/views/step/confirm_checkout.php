<?php // include 'e_payment/security.php'                                                ?>
<script>
//	function checkMinimum(subTotal)
//	{
//		subTotal = subTotal.replace(",", "");
//		var minimun = <?php // echo number_format($model->supplier->minimumOrder, 2, ".", "");   ?>;
//		lblMinError = document.getElementById("lblMinimumError<?php // echo $model->supplier->supplierId;   ?>");
//		btnCheckout = document.getElementById("btnCheckout<?php // echo $model->supplier->supplierId;   ?>");
//		if (subTotal >= minimun)
//		{
//			lblMinError.style.display = "none";
//			btnCheckout.style.display = "inline-table";
//		}
//		else
//		{
//			lblMinError.style.display = "inline-table";
//			btnCheckout.style.display = "none";
//		}
//		location.reload();
//	}
</script>
<h1>ยืนยันการชำระเงิน</h1>
<?php
//if($model->paymentMethod == 2)
//	echo CHtml::link('<i class="icon-print icon-white"></i> พิมพ์', Yii::app()->createUrl("order/printPayForm", array(
//			"id"=>$model->orderId)), array(
//		'class'=>'btn btn-warning',
//		'target'=>'_blank',));
$ePayment = Supplier::model()->findEpaymentByConfig($model->supplierId);
?>
<form class="form" <?php echo ($model->paymentMethod == 1) ? 'action="' . Yii::app()->createUrl("checkout/step/confirmation/id/" . $model->orderGroupId) . '"' : ""; ?>  method="post">
	<?php
	echo CHtml::hiddenField("paymentMethod", $model->paymentMethod);
	if(($model->paymentMethod == 1))
	{
		$this->renderPartial("e_payment/_parameter_form", array(
			'model'=>$model,
			'ePayment'=>$ePayment));
	}
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
//	echo CHtml::link('แก้ไข', Yii::app()->createUrl("order/viewCart/" . $model->supplierId), array(
//		'class'=>'btn btn-danger btn-small',));
	echo CHtml::submitButton('ยืนยัน', array(
		'class'=>'btn btn-success btn-small',
		'value'=>'ยืนยันการสั่งซื้อ',
		'id'=>'submit',
		'name'=>'submit'));
	?>
</form>