<?php // include("HOP.php");                   ?>

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
<div class="row sidebar-box blue">

	<div class="col-lg-12 col-md-12 col-sm-12">

		<div class="sidebar-box-heading">
			<i class="icons icon-box-2"></i>
			<h4>ผลการชำระเงิน ออนไลน์ www.daiibuy.com</h4>
		</div>

		<div class="sidebar-box-content sidebar-padding-box">
			<div class="row">
				<div class="col-md-12">
					<?php
					if($flag)
					{
						?>
						<h3 >การชำระเงินออนไลน์ของ รายการสั่งซื้อสินค้าเลขที่ <?php echo isset($_REQUEST["req_reference_number"]) ? $_REQUEST["req_reference_number"] : ""; ?> เสร็จสมบูรณ์</h3>
						<?php
					}
					else
					{
						?>
						<h3 >ไม่สามารถดำเนินการชำระเงินออนไลน์ของ รายการสั่งซื้อสินค้าเลขที่ <?php
							echo isset($_REQUEST["req_reference_number"]) ? $_REQUEST["req_reference_number"] : "";
							?> ได้</h3>
						<?php
					}
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<h2>ขอบคุณที่ใช้บริการ</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php
					if($flag)
					{
						?>
						<div class="row">
							<div class="col-md-12">
								<?php
								echo CHtml::link('<i class="icon-print icon-white"></i> พิมพ์ใบส่งสินค้า', Yii::app()->createUrl("myfile/order/print", array(
										"id"=>$model->orderGroupId)), array(
									'class'=>'btn btn-warning',
									'target'=>'_blank',));
								?>
								<?php
								echo CHtml::link('<i class="icon-search icon-white"></i> ดูใบสั่งซื้อสินค้า', Yii::app()->createUrl("myfile/order/view/id/" . $model->orderGroupId), array(
									'class'=>'btn btn-primary',
									'target'=>'_blank',));
								?>
								<?php
								echo CHtml::link('<i class="icon-folder-close icon-white"></i> การจัดการสั่งซื้อสินค้า', Yii::app()->createUrl("myfile/order"), array(
									'class'=>'btn btn-success',));
								?>
							</div>
						</div>
						<?php
					}
					else
					{
						?>
						<div class="row">
							<div class="col-md-12">
								<?php
								echo CHtml::link('<i class="icon-folder-close icon-white"></i> การจัดการสั่งซื้อสินค้า', Yii::app()->createUrl("order"), array(
									'class'=>'btn btn-info',));
								?>
								<?php
								echo CHtml::link('<i class="icon-home icon-white"></i> กลับสู่หน้าหลัก', Yii::app()->homeUrl, array(
									'class'=>'btn btn-primary',));
								?>

							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>

</div>

