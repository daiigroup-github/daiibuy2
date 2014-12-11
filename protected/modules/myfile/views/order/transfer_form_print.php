<?php
$supplierModel = Supplier::model()->findByPk($model->supplierId);
$tax = isset($supplierModel->taxNumber) ? $supplierModel->taxNumber : "";
$bank = Bank::model()->find('supplierId = ' . $model->supplierId . ' AND status = 1');
$supplier = Supplier::model()->find("supplierId = :supplierId", array(
	":supplierId"=>$supplierId));
?>
<div class="form img img-polaroid" style="border:1px solid;margin-top: <?php echo $title == 'ส่วนที่ 2 สำหรับลูกค้า' ? "0.5cm" : "0px" ?>;margin-left:15px;margin-right:15px">
	<div class="row">
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-12" style="margin-left:2px">
					<span class="badge badge-success" >แบบฟอร์มสำหรับชำระเงิน (Bill Payment / Pay-in Slip)</span>
				</div>
			</div>
			<div class="row" style="font-size:12px;">
				<div class="col-md-12" style="margin-left:5px">
					<b> เพื่อนำเข้าบัญชี  <?php echo $bank->accName; ?>  / เลขประจำตัวผู้เสียภาษี <?php echo $supplier->taxNumber; ?> </b>
				</div>
			</div>
			<div class="row" style="font-size:x-small;">
				<div class="col-md-12" style="margin-top: -5px;margin-left:5px">
					<?php
					echo $supplier->address1 . " " . $supplier->address2 . " " . $supplier->postcode . " โทร." . $supplier->tel;
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<hr style="margin: -1px 0px 10px 0px;height: 2px">
					<?php
					$i = 1;
					foreach(Bank::model()->findAllBankModelBySupplier($supplierId) as $data)
					{
						if($i == 1)
						{
							$marginTop = "-13px";
						}
						else
						{
							$marginTop = "-9px";
						}
						?>
						<div class="row" style="font-size:11px;">
							<div class="col-md-12" style="margin-left:2px;margin-top:<?php echo $marginTop; ?>">

								<?php
								$bankNameModel = BankName::model()->find("bankNameId = " . $data->bankNameId);
								?>
								<input type='checkbox' /> <image src = "<?php echo Yii::app()->request->baseUrl . $bankNameModel->logo; ?>" style = "width: 18px" />
								<?php // throw new Exception(print_r($data,true)); ?>
								<?php echo $bankNameModel->title . " (" . (isset($data->compCode)&& $data->compCode != "" ? "CompCode : " . $data->compCode : "เลขที่บัญชี : " . $data->accNo) . "  ชื่อบัญชี " . $data->accName . ")"; ?>
							</div>
						</div>
						<?php
						$i++;
					}
					?>

				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12 text-right" style="font-size:small;margin-right: 2px">
					<?php echo isset($title) ? $title : "" ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
                    <div style="border:1px solid;margin-right: 3px">
						<div class="row">
							<div class="col-md-12" style="font-size:small;">
								สาขา_____________วันที่____________
							</div>
						</div>
						<div class="row">
							<div class="col-md-12" style="font-size:small;">
								ชื่อลูกค้า :
								<b><?php
									$comName = User::model()->showUserCompany($model->userId);
									if((($comName != "---") && ($comName != "") && isset($comName)) || isset($model->paymentCompany))
									{
										echo "บริษัท " . ((($comName != "---") && ($comName != "") && isset($comName)) ? $comName : $model->paymentCompany);
									}
									else
									{
										if(isset($model))
										{
											echo $model->firstname . " " . $model->lastname;
										}
									}
									?></b>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12" style="font-size:small;">
								เลขที่ใบสั่งซื้อ(Ref.1)
								<b><?php echo "01" . str_replace("-", "", substr($model->orderNo, 2)); ?></b>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12" style="font-size:small;">
								เบอร์โทรศัพท(Ref.2)
								<b><?php echo str_replace("-", "", $model->telephone); ?></b>
							</div>
						</div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12" >
			<div class="row">
				<div class="col-md-12" style="font-size:x-small;margin-left: 10px">
					<input type="checkbox" /> <span>เช็คหมายเลข ____________________________ธนาคาร_________________________สาขา___________________ลงวันที่_________________</span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table style="width:98%">
						<tbody class="table table-bordered">
							<tr>
								<td style="text-align: center">เงินสด</td>
								<td style="text-align: center"><b><?php echo $this->ThaiBahtConversion(floatval($model->summary)); ?></b>
									<br><span style="border-top:1px dotted;">จำนวนเงินเป็นตัวอักษร</span>
								</td>
								<td style="text-align: center"><b><?php echo number_format($model->summary, 2); ?></b>
									<br><span style="border-top:1px dotted;">จำนวนเงิน (บาท)</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row" style="margin-bottom: 5px;font-size:x-small;margin-top: 10px">
				<div class="col-md-12 text-right">
					ชื่อผู้นำฝาก/Deposit by________________________โทรศัพท์/Tel_________________ เจ้าหน้าที่ธนาคาร___________________
				</div>
			</div>
		</div>
	</div>
	<div class="row" >
		<div class="col-md-3 text-center">
			<?php
			echo CHtml::image(Yii::app()->baseUrl . "/images/daii_logo.png", "", array(
				'style'=>'width:150px'))
			?>
		</div>
		<div class="col-md-9 text-center"  style="text-align:right">
			<?php
			$ref1 = "01" . str_replace("-", "", substr($model->orderNo, 2));
			$ref2 = str_replace("-", "", $model->telephone);
			$taxId = str_replace("-", "", $tax) . "00";
			$amount = str_replace(",", "", str_replace(".", "", number_format($model->summary, 2)));
			$data = "|" . $taxId . " " . $ref1 . " " . $ref2 . " " . $amount;
			$dataName = $ref1 . rand(0000, 9999);
			$folderName = "barcode";
			$location = Yii::app()->basePath . "/../images/$folderName/";
			$url = Yii::app()->baseUrl . "/images/$folderName/";
			$barcode = new Code128();
//$barcode->phpCode128('mikeleigh.com', 150, 'c:\windows\fonts\verdana.ttf', 18);
			$barcode->phpCode128($data, 90, Yii::app()->basePath . '/extensions/php_barcode128/verdana.ttf', 7);
			$barcode->setAutoAdjustFontSize(FALSE);
			$barcode->setEanStyle(FALSE);
			$barcode->setBorderWidth(0);
			$barcode->saveBarcode($location . $dataName . '.png');
			echo CHtml::image($url . $dataName . ".png", "", array(
				'style'=>'margin-top:-5px;margin-right:10px'));
			?>
		</div>
	</div>
</div>