<?php // include 'e_payment/security.php'                                                             ?>
<script>
//	function checkMinimum(subTotal)
//	{
//		subTotal = subTotal.replace(",", "");
//		var minimun = <?php // echo number_format($model->supplier->minimumOrder, 2, ".", "");                ?>;
//		lblMinError = document.getElementById("lblMinimumError<?php // echo $model->supplier->supplierId;                ?>");
//		btnCheckout = document.getElementById("btnCheckout<?php // echo $model->supplier->supplierId;                ?>");
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

<?php
//if($model->paymentMethod == 2)
//	echo CHtml::link('<i class="icon-print icon-white"></i> พิมพ์', Yii::app()->createUrl("order/printPayForm", array(
//			"id"=>$model->orderId)), array(
//		'class'=>'btn btn-warning',
//		'target'=>'_blank',));
$ePayment = Supplier::model()->findEpaymentByConfig($model->supplierId);
?>
<form class="form" <?php echo ($model->paymentMethod == 1) ? 'action="' . Yii::app()->createUrl("checkout/step/confirmation/id/" . $model->orderGroupId) . '"' : ""; ?>  method="post">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1>ยืนยันการชำระเงิน</h1>
				</div>
			</div>
			<div class="form-group">
				<div class="control-label col-md-3">
					เลขที่ใบเสนอราคา.
				</div>
				<div class="col-md-9">
					<?php echo $model->orderNo; ?>
				</div>
			</div>
			<div class="form-group">
				<div class="control-label col-md-3">
					ยอดชำระ
				</div>
				<div class="col-md-9">
					<?php echo $model->summary; ?>
				</div>
			</div>
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
				'class'=>'btn btn-success btn-xs col-md-offset-3',
				'value'=>'ยืนยันการสั่งซื้อ',
				'id'=>'submit',
				'name'=>'submit'));
			?>
		</div>
	</div>
</form>