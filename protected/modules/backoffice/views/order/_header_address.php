<div class="form-group" >
	<div class="col-md-8 table-bordered table-condensed" style="border-left: 1px; border-left-style: solid; border-left-color: #dddddd;height: 90px;">
		<?php
		if(isset($user))
		{
			if(($model->status != 2 && ($user->type != 4 && $user->type != 3 && $user->type != 2 )) || ($model->status >= 2 && ($user->type != 4 && $user->type != 3 )))
			{
				?>
				<div class="col-md-3 table-condensed"  ><h6 style='margin-left: 8px;'>ได้รับเงินจาก :
					</h6></div>
				<?php
			}
			else
			{
				if(($model->status == 3 && $user->type == 3) || $model->status == 0 && $user->type == 4)
				{
					?>
					<div class="col-md-3 table-condensed" ><h6 style='margin-left: 8px; text-align: Right'>ผู้ซื้อ : &nbsp;</h6></div>
					<?php
				}
				else
				{
					?>
					<div class="col-md-3 table-condensed" ><h6 style='margin-left: 8px;'>ผู้ผลิตสินค้า :
						</h6></div>
					<?php
				}
			}
		}
		else
		{
			?>
			<div class="col-md-3 table-condensed" ><h6 style='margin-left: 8px;'>ได้รับเงินจาก :
				</h6></div>
		<?php }
		?>
		<div class="col-md-9 table-condensed" style="margin-left: -25px;text-align: left; height: 90px;margin-top: 10px" >
			<?php
			if(isset(Yii::app()->user->id))
			{
				$comName = User::model()->showUserCompany($model->userId);
				$user = User::model()->findByPk(Yii::app()->user->id);
				$userType = $user->type;
				$shippingAddress = Address::model()->find('userId = ' . $model->userId . ' and type = 2');
				$billingAddress = Address::model()->find('userId = ' . $model->userId . ' and type = 1');
//					(Yii::app()->controller->action->id == "viewOrder" && $userType <> 1 && $userType <> 5)
				if(($model->status == 2 && ($userType <> 1 && $userType <> 2 && $userType <> 5)) || (Yii::app()->controller->action->id == "view" && ($userType <> 5 && $userType <> 1 )) || (Yii::app()->controller->action->id == "print" && $userType <> 5 && $userType <> 1))
				{
					if(($model->status == 3 && $user->type == 3) || $model->status == 0 && $user->type == 4)
					{
						echo getOrderShippingAddress($model);
					}
					else
					{
						echo getOrderSupplierBillingAddress($model, TRUE);
					}
				}
				else
				{
					echo getOrderPaymentAddress($model);
				}
			}
			else
			{
				echo getOrderPaymentAddress($model);
			}
			?>
		</div>
	</div>
	<div class="col-md-4 table-condensed" >
		<?php
		if(isset($user))
		{
			$thisDate = $model->createDateTime;
			$time = strtotime($thisDate);
//						$time = strtotime("+3 days");
//						$date = date('Y-m-d', $time);
//						$dateFinal = new DateTime($date);
//						$interval = new DateInterval('P3D');
//						$dateToPay = strtotime("+3 day", $time);
			$deadLinePaymentDay = Configuration::model()->getPaymentDay();
			$dateToPay = date("Y-m-d hh:mm:ss", strtotime("+" . $deadLinePaymentDay->value . " day", $time));
			$deadlinePayment = $this->dateThai($dateToPay, 1);
//						$deadlinePayment = $this->dateThai($dateToPay->format("Y-m-d hh:mm:ss"), 1);
			if($model->status < 2 && ($user->type != 4 || $user->type != 5 ) && Yii::app()->controller->action->id != "viewOrder")
			{
				if(($model->status > 2 && ($user->type == 2 || $user->type == 3 )))
				{
					?>
					<div class="table-condensed table-bordered" style="height: 31px;text-align: center; border-left: 1px; border-left-style: solid; border-left-color: #dddddd;"><p style="margin-top: 3px"><?php echo $model->orderNo ?></p></div>
					<div class="table-condensed table-bordered" style="height: 40px;text-align: center; border-left: 1px; border-left-style: solid; border-left-color: #dddddd;"><p style="margin-top: 11px"><?php echo $model->invoiceNo == null ? $model->orderNo : $model->invoiceNo; ?></p></div>
					<div class="table-condensed table-bordered" style="height: 40px;text-align: center; border-left: 1px; border-left-style: solid; border-left-color: #dddddd;"><p style="margin-top: 11px; color: red;"><?php echo $model->paymentDateTime == null ? "กำหนดชำระเงิน : " . $deadlinePayment : "วันที่ : " . $this->dateThai($model->paymentDateTime, 1); ?></p></div>
					<?php
				}
				else
				{
					?>
					<div class="table-condensed table-bordered" style="height: 40px;text-align: center; border-left: 1px; border-left-style: solid; border-left-color: #dddddd;"><p style="margin-top: 11px"><?php echo ($user->type == 1 || $user->type == 5 || $userType == 4) ? "วันที่สั่งซื้อ : " . $this->dateThai($model->createDateTime, 1) : (($model->invoiceNo == null) ? $model->orderNo : $model->invoiceNo); ?></p></div>
					<div class="table-condensed table-bordered" style="height: 40px;text-align: center; border-left: 1px; border-left-style: solid; border-left-color: #dddddd;"><p style="margin-top: 11px"><?php echo $model->paymentDateTime == null ? "กำหนดชำระเงิน : " . $deadlinePayment : "วันที่ : " . $this->dateThai($model->paymentDateTime, 1)
					?></p></div>
					<?php
				}
			}
			else
			{
				if(($model->status == 2 && $user->type == 3) || (($user->type == 5 || $user->type == 4) && $model->status >= 2))
				{
					?>
					<div class="table-condensed table-bordered" style="height: 31px;text-align: center; border-left: 1px; border-left-style: solid; border-left-color: #dddddd;"><p style="margin-top: 3px"><?php echo $model->orderNo ?></p></div>
					<div class="table-condensed table-bordered" style="height: 40px;text-align: center; border-left: 1px; border-left-style: solid; border-left-color: #dddddd;"><p style="margin-top: 11px"><?php echo $model->invoiceNo == null ? $model->orderNo : $model->invoiceNo; ?></p></div>
					<div class="table-condensed table-bordered" style="height: 40px;text-align: center; border-left: 1px; border-left-style: solid; border-left-color: #dddddd;"><p style="margin-top: 11px; color: red;"><?php echo $model->paymentDateTime == null ? "กำหนดชำระเงิน : " . $deadlinePayment : "วันที่ : " . $this->dateThai($model->paymentDateTime, 1); ?></p></div>
					<?php
				}
				else
				{
					?>
			<!--<div class="table-condensed table-bordered" style="height: 31px;text-align: center; border-left: 1px; border-left-style: solid; border-left-color: #dddddd;"><p style="margin-top: 3px"><?php // echo $model->orderNo                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ?></p></div>-->
					<div class="table-condensed table-bordered" style="height: 31px;text-align: center; border-left: 1px; border-left-style: solid; border-left-color: #dddddd;"><p style="margin-top: 3px"><?php echo $model->invoiceNo ?></p></div>
					<div class="table-condensed table-bordered" style="height: 31px;text-align: center; border-left: 1px; border-left-style: solid; border-left-color: #dddddd;"><p style="margin-top: 3px"><?php echo isset($model->paymentDateTime) ? "วันที่ : " . $this->dateThai($model->paymentDateTime, 1) : ""; ?></p></div>
			<!--							<div class="table-condensed table-bordered" style="height: 31px;text-align: center; border-left: 1px; border-left-style: solid; border-left-color: #dddddd;"><p style="margin-top: 3px"><?php // echo "ระยะเวลาชำระเงิน";                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     ?></p></div>-->
					<?php
				}
			}
		}
		else
		{
			?>
	<!--<div class="table-condensed table-bordered" style="height: 31px;text-align: center; border-left: 1px; border-left-style: solid; border-left-color: #dddddd;"><p style="margin-top: 3px"><?php // echo $model->orderNo                                                                                                                                                                                                                                                                                                                                                                                                                                                                       ?></p></div>-->
			<div class="table-condensed table-bordered" style="height: 40px;text-align: center; border-left: 1px; border-left-style: solid; border-left-color: #dddddd;"><p style="margin-top: 11px"><?php echo $model->invoiceNo; ?></p></div>
			<div class="table-condensed table-bordered" style="height: 40px;text-align: center; border-left: 1px; border-left-style: solid; border-left-color: #dddddd;"><p style="margin-top: 11px"><?php echo isset($model->paymentDateTime) ? $this->dateThai($model->paymentDateTime, 1) : ""; ?></p></div>
		<?php } ?>
	</div>
</div>
<div class="form-group" style="margin-top: 5px">
	<table class="table table-striped table-bordered table-condensed">
		<thead style="font-size:small">
			<tr>
				<?php
				if(isset($user))
				{
					if($model->status < 2 && ($user->type != 4 || $user->type != 3 || $user->type != 5 ))
					{
						?>
						<td style="width:30%;text-align: center"><b style="font-size:small">เลขทื่ใบสั่งซื้อสินค้า</b></td>
						<?php
						if($model->isSentToCustomer == 0)
						{
							?>
							<td style="width:70%;text-align: center"><b style="font-size:small">ตัวแทนกระจายสินค้า</b></td>
							<?php
						}
						else
						{
							?>
							<td style="width:70%;text-align: center"><b style="font-size:small">ตัวแทนกระจายสินค้า</b></td>
							<?php
						}
					}
					else
					{
						if($user->type == 1)
						{
							?>
							<td style="width:30%;text-align: center"><b style="font-size:small">เลขที่ใบสั่งซื้อสินค้า</b></td>
							<?php
						}
						else
						{
							if($model->status == 2 && $user->type == 3)
							{
								?>
								<td style="width:50%;text-align: center"><b style="font-size:small">ผู้ซื้อ</b></td>
								<?php
							}
							else
							{
								?>
								<td style="width:30%;text-align: center"><b style="font-size:small">สถานที่วางบิล</b></td>
								<?php
							}
						}
						if($model->isSentToCustomer == 0)
						{
							if($model->status == 2 && $user->type == 3)
							{
								?>
								<td style="width:50%;text-align: center"><b style="font-size:small">ตัวแทนกระจายสินค้า</b></td>
								<?php
							}
							else
							{
								?>
								<td style="width:70%;text-align: center"><b style="font-size:small">ตัวแทนกระจายสินค้า</b></td>
								<?php
							}
						}
						else
						{
							?>
							<td style="width:70%;text-align: center"><b style="font-size:small">ตัวแทนกระจายสินค้า</b></td>
							<?php
						}
					}
				}
				else
				{
					?>
					<td style="width:30%;text-align: center;font-size:small"><b>เลขที่ใบสั่งซื้อสินค้า</b></td>
					<?php
					if($model->isSentToCustomer == 0)
					{
						?>
						<td style="width:70%;text-align: center;font-size:small"><b>ตัวแทนกระจายสินค้า</b></td>
						<?php
					}
					else
					{
						?>
						<td style="width:70%;text-align: center;font-size:small"><b>ตัวแทนกระจายสินค้า</b></td>
						<?php
					}
				}
				?>
			</tr>
		</thead>
		<tbody style="font-size:small">
			<tr>
				<td style="text-align: center"><?php
					if(isset($user))
					{
						if($model->status >= 2 && ($user->type == 4 || $user->type == 3 || $user->type == 5))
						{
							if($model->status >= 2 && $user->type == 3)
							{
								echo "<p style='margin-left: 20px'>" . ( isset($model->paymentCompany) ? "บริษัท " . $model->paymentCompany : $model->paymentFirstname . " " . $model->paymentLastname) . "</p><p style='margin-left: 20px'>สถานที่จัดส่ง : "
								. (isset($model->shippingAddress1) ? $model->shippingAddress1 : "") . " " . (isset($model->shippingAddress2) ? $model->shippingAddress2 : "") . " " . $model->shippingDistrict->districtName . " " . $model->shippingAmphur->amphurName . " " . $model->shippingProvince->provinceName . " " . $model->paymentPostcode . " โทรศัพท์ :  " . $model->telephone . "</p>";
							}
							else
							{
								echo "บริษัท Daii Group จำกัด มหาชน.";
							}
						}
						else
						{
							echo $model->orderNo;
						}
					}
					else
					{
						echo $model->orderNo;
					}
					?></td>
				<td><?php
					echo isset($dealerAddr) ? "<p style='margin-left: 20px'>" . $dealerAddr->company . ", " . $dealerAddr->address_1 . " " . $dealerAddr->district->districtName . " " . $dealerAddr->amphur->amphurName . " " . $dealerAddr->province->provinceName . " " . $dealerAddr->postcode . "</p>" . "<p style='margin-left: 20px'> ผู้ติดต่อ : " . $dealerAddr->firstname . " " . $dealerAddr->lastname . " โทรศัพท์ : " . $dealer->telephone . "</p><p style='margin-left: 20px'> Email : " . $dealer->email . " </p>" : "-";
					?></td>
			</tr>
		</tbody>
	</table>
</div>