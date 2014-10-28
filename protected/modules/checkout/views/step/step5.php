<?php // include("HOP.php");   ?>

<!--<h3>Sample PHP Receipt Page</h3>-->

<!--<table border="1">
<tr><td><b>Field Name</b></td><td><b>Field Value</b></td></tr>-->

<?php
//print_r($_REQUEST);
//while(list($key, $val) = each($result))
//{
//   echo '<tr><td>' . $key . '</td><td>' . $val . "</td></tr>";
//}
//
//echo '<tr><td>VerifyTransactionSignature()</td><td>' . VerifyTransactionSignature($_POST) . '</td></tr>';
?>

<!--</table>-->

<div class="well ">
	<h2 class="text-center">ผลการชำระเงิน ออนไลน์ www.daiibuy.com</h2>

	<p>

		<?php
		if($flag)
		{
			?>
		<div class="text-success text-center"><h3 >การชำระเงินออนไลน์ของ รายการสั่งซื้อสินค้าเลขที่ <?php echo isset($_REQUEST["req_reference_number"]) ? $_REQUEST["req_reference_number"] : ""; ?> เสร็จสมบูรณ์</h3></div>
		<?php
	}
	else
	{
		?>
		<div class="text-error text-center"><h3 >ไม่สามารถดำเนินการชำระเงินออนไลน์ของ รายการสั่งซื้อสินค้าเลขที่ <?php
				echo isset($_REQUEST["req_reference_number"]) ? $_REQUEST["req_reference_number"] : "";
				?> ได้</h3></div>
		<?php
	}
	?>

</p>
<p>
<div class="text-info text-center"><h2>ขอบคุณที่ใช้บริการ</h2></div>
</p>
<p>
	<?php
	if($flag)
	{
		?>
	<div class="control-group text-center">
		<div class="controls">
			<?php
			echo CHtml::link('<i class="icon-print icon-white"></i> พิมพ์ใบส่งสินค้า', Yii::app()->createUrl("order/print", array(
					"id"=>$model->orderId)), array(
				'class'=>'btn btn-warning',
				'target'=>'_blank',));
			?>
			<?php
			echo CHtml::link('<i class="icon-search icon-white"></i> ดูใบสั่งซื้อสินค้า', Yii::app()->createUrl("order/view", array(
					"id"=>$model->orderId)), array(
				'class'=>'btn btn-primary',
				'target'=>'_blank',));
			?>
			<?php
			echo CHtml::link('<i class="icon-folder-close icon-white"></i> การจัดการสั่งซื้อสินค้า', Yii::app()->createUrl("order"), array(
				'class'=>'btn btn-success',));
			?>
		</div>
	</div>
	<?php
}
else
{
	?>
	<div class="control-group text-center">
		<div class="controls">
			<?php
			echo CHtml::link('<i class="icon-folder-close icon-white"></i> การจัดการสั่งซื้อสินค้า', Yii::app()->createUrl("order"), array(
				'class'=>'btn btn-info',));
			?>
			<?php
			echo CHtml::link('<i class="icon-home icon-white"></i> กลับสู่หน้าหลัก', Yii::app()->homeUrl, array(
				'class'=>'btn btn-primary',));
			?>
		<?php } ?>
	</div>
</div>
</p>
</div>