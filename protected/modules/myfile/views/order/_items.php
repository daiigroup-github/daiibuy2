<div class="form-group" style="margin-top: 5px">
	<table class="table table-striped table-bordered table-condensed">
		<thead style="font-size:small">
			<tr>
				<?php
				if(isset($user))
				{
					if($model->status < 3 && ($user->type != 4 || $user->type != 3 || $user->type != 5 ))
					{
						?>
						<td style="width:30%;text-align: center"><b style="font-size:small">เลขทื่ใบสั่งซื้อสินค้า</b></td>
						<!--<td style="width:70%;text-align: center"><b style="font-size:small">ตัวแทนกระจายสินค้า</b></td>-->
						<?php
					}
					else
					{
						if($user->type == 1)
						{
							?>
																								<!--							<td style="width:30%;text-align: center"><b style="font-size:small">เลขที่ใบสั่งซื้อสินค้า</b></td>
																													<td style="width:70%;text-align: center"><b style="font-size:small">ตัวแทนกระจายสินค้า</b></td>-->
							<?php
						}
						else
						{
							if($model->status == 3 && $user->type == 3)
							{
								?>
								<td style="width:50%;text-align: center"><b style="font-size:small">ผู้ซื้อ</b></td>
								<!--<td style="width:50%;text-align: center"><b style="font-size:small">ตัวแทนกระจายสินค้า</b></td>-->
								<?php
							}
							else
							{
								?>
								<td style="width:30%;text-align: center"><b style="font-size:small">สถานที่วางบิล</b></td>
								<!--<td style="width:70%;text-align: center"><b style="font-size:small">ตัวแทนกระจายสินค้า</b></td>-->
								<?php
							}
						}
					}
				}
				else
				{
					?>
					<td style="width:30%;text-align: center;font-size:small"><b>เลขที่ใบสั่งซื้อสินค้า</b></td>
					<!--<td style="width:70%;text-align: center;font-size:small"><b>ตัวแทนกระจายสินค้า</b></td>-->
					<?php
				}
				?>
			</tr>
		</thead>
		<tbody style="font-size:small">
			<tr>
				<td style="text-align: center"><?php
					if(isset($user))
					{
						if($model->status >= 3 && ($user->type == 4 || $user->type == 3 || $user->type == 5))
						{
							if($model->status >= 3 && $user->type == 3)
							{
								echo "<p style='margin-left: 20px'>" . ( isset($model->paymentCompany) ? $model->paymentCompany : $model->paymentFirstname . " " . $model->paymentLastname) . "</p>"
								. "<p style='margin-left: 20px;font-weight:bold;'>สถานที่จัดส่ง : "
								. (isset($model->shippingAddress1) ? $model->shippingAddress1 : "") . " " . (isset($model->shippingAddress2) ? $model->shippingAddress2 : "") . " " . $model->shippingDistrict->districtName . " " . $model->shippingAmphur->amphurName . " " . $model->shippingProvince->provinceName . " " . $model->paymentPostcode . " โทรศัพท์ :  " . $model->telephone . "</p>";
							}
							else
							{
								echo "บริษัทไดอิ กรุ๊ป จำกัด มหาชน.";
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
					<!--<td>-->
				<?php
//						echo getOrderShippingAddress($model);
//					echo isset($dealerAddr) ? "<p style='margin-left: 20px'>" . $dealerAddr->company . ", " . $dealerAddr->address_1 . " " . $dealerAddr->district->districtName . " " . $dealerAddr->amphur->amphurName . " " . $dealerAddr->province->provinceName . " " . $dealerAddr->postcode . "</p>" . "<p style='margin-left: 20px'> ผู้ติดต่อ : " . $dealerAddr->firstname . " " . $dealerAddr->lastname . " โทรศัพท์ : " . $dealer->telephone . "</p><p style='margin-left: 20px'> Email : " . $dealer->email . " </p>" : "-";
				?>
				<!--</td>-->
			</tr>
		</tbody>
	</table>
</div>
<div class="form-group">
	<table class="table table-striped table-bordered table-condensed" style="font-size:11px">
		<thead>
			<tr>

				<?php
				if(isset(Yii::app()->user->id))
				{
					if(!($user->type == 2))
					{
						if((($user->type == 1 || $user->type == 2 ) && $model->status == 1) || ($user->type == 4 && $model->status == 1) || ((Yii::app()->controller->action->id == "print") && !($user->type == 3)) || (($user->type == 3) && ($model->status == 3 || $model->status == 4) && !(Yii::app()->controller->action->id == "print")) || (($user->type == 5 || $user->type == 4) && $model->status >= 3))
						{
							?>
							<td style="width:7%;text-align: center;font-size:11px">ลำดับ</td>
							<td style="width:16%;text-align: center;font-size:11px">รหัสสินค้า</td>
							<td style="width:50%;text-align: center;font-size:11px">รายการ</td>
							<td style="text-align: center;font-size:11px">จำนวน</td>
							<td style="text-align: center;font-size:11px">หน่วย</td>
							<td style="text-align: center;font-size:11px">ราคา/หน่วย(บาท)</td>
							<td style="text-align: center;font-size:11px">มูลค่าสินค้ารวมภาษี(บาท)</td>

							<?php
						}
						else
						{
							?>
							<td style="width:7%;text-align: center;font-size:11px">ลำดับ</td>
							<td style="width:16%;text-align: center;font-size:11px">รหัสสินค้า</td>
							<td style="width:80%;text-align: center;font-size:11px">รายการ</td>
							<td style="text-align: center;font-size:11px">จำนวน</td>
							<td style="text-align: center;font-size:11px">หน่วย</td>
							<?php
						}
					}
					else
					{
						?>
						<td style="width:7%;text-align: center;font-size:11px">ลำดับ</td>
						<td style="width:16%;text-align: center;font-size:11px">รหัสสินค้า</td>
						<td style="width:50%;text-align: center;font-size:11px">รายการ</td>
						<td style="text-align: center;font-size:11px">จำนวน</td>
						<td style="text-align: center;font-size:11px">หน่วย</td>
						<td style="text-align: center;font-size:11px">ราคา/หน่วย(บาท)</td>
						<td style="text-align: center;font-size:11px">มูลค่าสินค้ารวมภาษี(บาท)</td>
						<?php // if ($user->type <> 2) {                               ?>
		<!--										<td style="text-align: center">ราคา/หน่วย(บาท)</td>
						<td style="text-align: center">มูลค่าสินค้ารวมภาษี(บาท)</td>-->
						<?php
//									}
					}
				}
				else
				{
					?>
					<td style="width:7%;text-align: center;font-size:11px">ลำดับ</td>
					<td style="width:16%;text-align: center;font-size:11px">รหัสสินค้า</td>
					<td style="width:50%;text-align: center;font-size:11px">รายการ</td>
					<td style="text-align: center;font-size:11px">จำนวน</td>
					<td style="text-align: center;font-size:11px">หน่วย</td>
				<?php }
				?>
			</tr>
		</thead>
		<tbody style="font-size:11px">
			<?php
			if(count($model->orders) > 0)
			{
				$i = 1;
				$priceTotalTemp = 0.00;
				$priceTotalDouble = 0.00;
				if(isset(Yii::app()->user->id))
				{
					$userType = Yii::app()->user->userType;
				}
				if((!isset(Yii::app()->user->id)) || ((($userType == 0 || $userType == 1 || $userType == 5) && $model->status > 2) && !(Yii::app()->controller->action->id == "printProductList")))
				{
					?>
					<tr>
						<td style="text-align: center;font-size:11px"><?php echo $i; ?></td>
						<td style="text-align: center;font-size:11px"><?php echo "-"; ?></td>
						<td><?php echo $model->supplierId == 4 ? "ค่างานก่อสร้างเรียกเก็บตามสัญญา" : "เงินรับล่วงหน้าค่าสินค้า"; ?></td>
						<td style="text-align: center;font-size:11px"><?php echo 1; ?></td>
						<td style="text-align: center;font-size:11px"><?php echo "-"; ?></td>
						<td style="text-align: right;font-size:11px"><?php echo number_format($model->totalIncVAT, 2, ".", ","); ?></td>
						<td style="text-align: right;font-size:11px"><?php echo number_format($model->totalIncVAT, 2, ".", ","); ?></td>
					</tr>
					<?php
				}
				else
				{
					foreach($model->orders as $order)
					{
						?>
						<?php if(isset($order->title) && !empty($order->title)): ?><tr><td colspan="7"><b><?php echo "ชื่อรายการสินค้า : " . $order->title; ?></b></td></tr><?php endif; ?>
						<?php
						foreach($order->orderItems as $item)
						{
							?>
							<tr>
								<td style="text-align: center;font-size:11px"><?php echo $i; ?></td>
								<td style="text-align: center;font-size:10px"><?php echo isset($item->product) ? $item->product->code : ""; ?></td>
								<td style="font-size:10px"><?php echo isset($item->product) ? $item->product->name : $item->title; ?></td>
								<?php
								$priceTotal = number_format($priceTotalTemp, 2, ".", ",");
//                                                                        $priceTotalDouble = floor($priceTotalDouble);
								if(isset(Yii::app()->user->id))
								{
									if(($model->status == 99) || ($model->status == 1) || (!($user->type == 2) && !(Yii::app()->controller->action->id == "print") && !($user->type == 3)) || (($model->status == 3 || $model->status == 4) && $user->type == 3 && !(Yii::app()->controller->action->id == "print")) || (($user->type == 5 || $user->type == 4) && $model->status >= 3))
									{
										if(($model->status == 99) || ($model->status == 1) || ($user->type == 4 && $model->status == 1) || ((!(($user->type == 5) && $model->status > 3))) || (($user->type == 5 || $user->type == 4) && $model->status >= 3) || (($model->status == 3 || $model->status == 4) && $user->type == 3 && !(Yii::app()->controller->action->id == "print")))
										{
											?>
											<td style="text-align: center;font-size:11px"><?php echo $item->quantity; ?></td>
											<td style="text-align: center;font-size:11px"><?php echo isset($item->product->productUnits) ? $item->product->productUnits : ""; ?></td>
											<td style="text-align: right;font-size:11px"><?php echo number_format($item->price, 2, ".", ","); ?></td>
											<td style="text-align: right;font-size:11px"><?php echo number_format($item->total, 2, ".", ","); ?></td>
											<?php
										}
										else
										{
											?>
											<td style="text-align: center;font-size:11px"><?php echo number_format($item->quantity, 0, ".", ","); ?></td>
											<td style="text-align: center;font-size:11px"><?php echo isset($item->product->productUnits) ? $item->product->productUnits : ""; ?></td>
											<td style="text-align: right;font-size:11px"><?php echo number_format($item->price * (100 + $margin['daiiMargin']) / 100, 2, ".", ","); ?></td>
											<td style="text-align: right;font-size:11px"><?php echo number_format($item->total * (100 + $margin['daiiMargin']) / 100, 2, ".", ","); ?></td>
											<?php
										}
									}
									else if($user->type == 3)
									{
										?>
										<td style="text-align: center;font-size:11px"><?php echo number_format($item->quantity, 0, ".", ","); ?></td>
										<td style="text-align: center;font-size:11px"><?php echo isset($item->product->productUnits) ? $item->product->productUnits : ""; ?></td>
										<?php
									}
									else
									{
										?>
										<td style="text-align: center;font-size:11px"><?php echo $item->quantity; ?></td>
										<td style="text-align: center;font-size:11px"><?php echo isset($item->product->productUnits) ? $item->product->productUnits : ""; ?></td>
										<td style="text-align: right;font-size:11px"><?php echo number_format($item->price, 2, ".", ","); ?></td>
										<td style="text-align: right;font-size:11px"><?php echo number_format($item->total, 2, ".", ","); ?></td>
										<?php
									}
								}
								else
								{
									?>
									<td style="text-align: center;font-size:11px"><?php echo $item->quantity; ?></td>
									<td style="text-align: center;font-size:11px"><?php echo isset($item->product->productUnits) ? $item->product->productUnits : ""; ?></td>
									<td style="text-align: right;font-size:11px"><?php echo number_format($item->price, 2, ".", ","); ?></td>
									<td style="text-align: right;font-size:11px"><?php echo number_format($item->total, 2, ".", ","); ?></td>
									<?php
								}
								?>
							</tr>
							<?php
							$i++;
							$priceTotalDouble = $priceTotalDouble + $item->total;
						}
					}
				}
			}
			?>
		</tbody>
		<tfoot style="font-size:11px">
			<?php
			if(isset(Yii::app()->user->id))
			{
				if((!(Yii::app()->controller->action->id == "print") && ($user->type == 3)) || !($user->type == 3 && $model->status >= 3))
				{
					?>

					<!--</tr>-->
					<tr>
						<td colspan="6" style="text-align: right;font-weight: bold;">ราคาสินค้ารวมภาษีมูลค่าเพิ่ม/Sub Total Included VAT</td>
						<td style="text-align: right;;font-weight: bold;border-bottom-style: double;border-bottom-width: 2px" ><?php echo number_format($model->totalIncVAT, 2, ".", ","); ?></td>
					</tr>

					<?php
					if($model->discountValue > 0)
					{
						?>

						<tr>
							<td colspan="6" style="text-align: right;color: cornflowerblue;font-weight: bold;">ส่วนลด/Discount(<?php echo $model->discountPercent; ?>%)</td>
							<td style="text-align: right;color: cornflowerblue;font-weight: bold;border-bottom-style: double;border-bottom-width: 2px" ><?php echo number_format($model->discountValue, 2, ".", ","); ?></td>
						</tr>
						<?php
					}
					if($model->distributorDiscount > 0)
					{
						?>
						<tr>
							<td colspan="6" style="text-align: right;color: cornflowerblue;font-weight: bold;">ส่วนลดตัวแทนกระจายสินค้า/Distributor Discount(<?php echo $model->distributorDiscountPercent; ?>%)</td>
							<td style="text-align: right;color: cornflowerblue;font-weight: bold;border-bottom-style: double;border-bottom-width: 2px" ><?php echo number_format($model->distributorDiscount, 2, ".", ","); ?></td>
						</tr>
						<?php
					}
					if($model->extraDiscount > 0)
					{
//                                                            throw new Exception(print_r(Yii::app()->user->id, true));
                                                            if (isset($model->orderGroupToOrders[0])) {
                                                                $userSpecialProjModel = UserSpacialProject::model()->find('orderId = ' . $model->orderGroupToOrders[0]->orderId . ' and userId = ' . $model->userId);
                                                                if (isset($userSpecialProjModel->spacialPercent))
                                                                    $specialPercent = $userSpecialProjModel->spacialPercent;
                                                            }
                                                            ?>
                        						<tr>
                                                                            <td colspan="6" style="text-align: right;color: cornflowerblue;font-weight: bold;">ส่วนลดพิเศษ/Extra Discount(<?php echo isset($specialPercent) ? $specialPercent : "10"; ?>%)</td>
                                                                            <td style="text-align: right;color: cornflowerblue;font-weight: bold;border-bottom-style: double;border-bottom-width: 2px" ><?php echo number_format($model->extraDiscount, 2, ".", ","); ?></td>
						</tr>
					<?php }
					?>
					<tr>
						<td colspan="6" style="text-align: right">ภาษีมูลค่าเพิ่ม/VAT 7%</td>
						<td style="text-align: right"><?php echo number_format((($model->summary * 100) / 107) * 0.07, 2, ".", ","); ?></td>
					</tr>
					<tr>
						<td colspan="6" style="text-align: right">ราคาสินค้าไม่รวมภาษี/Sub Total excluded VAT</td>
						<td style="text-align: right"><?php echo number_format(($model->summary * 100) / 107, 2, ".", ","); ?></td>
					</tr>
					<tr>
						<td colspan="6" style="text-align: right;color:red;font-weight: bold;">ราคาสินค้าที่ต้องชำระรวมภาษีมูลค่าเพิ่ม/Total Included VAT</td>
						<td style="text-align: right;color: red;font-weight: bold;border-bottom-style: double;border-bottom-width: 2px" ><?php echo number_format($model->summary, 2, ".", ","); ?></td>
					</tr>
					<?php
//									}
				}
				else if(!($user->type == 3))
				{
					?>

					<tr>
						<td colspan="6" style="text-align: right;font-weight: bold;">ราคาสินค้ารวมภาษีมูลค่าเพิ่ม/Sub Total Included VAT</td>
						<td style="text-align: right;;font-weight: bold;border-bottom-style: double;border-bottom-width: 2px" ><?php echo number_format($model->totalIncVAT, 2, ".", ","); ?></td>
					</tr>

					<?php
					if($model->discountValue > 0)
					{
						?>

						<tr>
							<td colspan="6" style="text-align: right;color: cornflowerblue;font-weight: bold;">ส่วนลด/Discount(<?php echo $model->discountPercent; ?>%)</td>
							<td style="text-align: right;color: cornflowerblue;font-weight: bold;border-bottom-style: double;border-bottom-width: 2px" ><?php echo number_format($model->discountValue, 2, ".", ","); ?></td>
						</tr>
						<?php
					}
					if($model->distributorDiscount > 0)
					{
						?>
						<tr>
							<td colspan="6" style="text-align: right;color: cornflowerblue;font-weight: bold;">ส่วนลดตัวแทนกระจายสินค้า/Distributor Discount(<?php echo $model->distributorDiscountPercent; ?>%)</td>
							<td style="text-align: right;color: cornflowerblue;font-weight: bold;border-bottom-style: double;border-bottom-width: 2px" ><?php echo number_format($model->distributorDiscount, 2, ".", ","); ?></td>
						</tr>
						<?php
					}
					if($model->extraDiscount > 0)
					{
            if (isset($model->orderGroupToOrders[0])) {
                $userSpecialProjModel = UserSpacialProject::model()->find('orderId = ' . $model->orderGroupToOrders[0]->orderId . ' and userId = ' . $model->userId);
                if (isset($userSpecialProjModel->spacialPercent))
                    $specialPercent = $userSpecialProjModel->spacialPercent;
            }
            ?>
                        						<tr>
                                                                            <td colspan="6" style="text-align: right;color: cornflowerblue;font-weight: bold;">ส่วนลดพิเศษ/Extra Discount(<?php echo isset($specialPercent) ? $specialPercent : "10"; ?>%)</td>
                                                                            <td style="text-align: right;color: cornflowerblue;font-weight: bold;border-bottom-style: double;border-bottom-width: 2px" ><?php echo number_format($model->extraDiscount, 2, ".", ","); ?></td>
						</tr>
					<?php }
					?>

					<tr>
						<td colspan="6" style="text-align: right">ภาษีมูลค่าเพิ่ม/VAT 7%</td>
						<td style="text-align: right"><?php echo number_format((($model->summary * 100) / 107) * 0.07, 2, ".", ","); ?></td>
					</tr>
					<tr>
						<td colspan="6" style="text-align: right">ราคาสินค้าไม่รวมภาษี/Sub Total excluded VAT</td>
						<td style="text-align: right"><?php echo number_format(($model->summary * 100) / 107, 2, ".", ","); ?></td>
					</tr>
					<tr>
						<td colspan="6" style="text-align: right;color:red;font-weight: bold;">ราคาสินค้าที่ต้องชำระรวมภาษีมูลค่าเพิ่ม/Total Included VAT</td>
						<td style="text-align: right;color: red;font-weight: bold;border-bottom-style: double;border-bottom-width: 2px" ><?php echo number_format($model->summary, 2, ".", ","); ?></td>
					</tr>
					<?php
				}
			}
			else
			{
				?>

				<tr>
					<td colspan="6" style="text-align: right">ภาษีมูลค่าเพิ่ม/VAT 7%</td>
					<td style="text-align: right"><?php echo number_format($model->totalIncVAT - $model->total, 2, ".", ","); ?></td>
				</tr>
				<tr>
					<td colspan="6" style="text-align: right">ราคาสินค้าไม่รวมภาษี/Total excluded VAT</td>
					<td style="text-align: right"><?php echo number_format($model->total, 2, ".", ",");
				?></td>
				</tr>
				<tr>
					<td colspan="6" style="text-align: right;color:red;font-weight: bold;">ราคาสินค้าที่ต้องชำระรวมภาษีมูลค่าเพิ่ม/Total Included VAT</td>
					<td style="text-align: right;color: red;font-weight: bold;border-bottom-style: double;border-bottom-width: 2px" ><?php echo number_format($model->totalIncVAT, 2, ".", ","); ?></td>
				</tr>
				<?php
			}
			if (!($model->status == 1 || $model->status == 2 || $model->status == 3 || $model->status == 99 ) || ($model->status == 3 && Yii::app()->user->userType == 3 && Yii::app()->controller->action->id == "print") || ($model->status > 1 && Yii::app()->controller->action->id == "print" && ($user->type == 1 || $user->type == 4 || $user->type == 5) )) {
				if(isset(Yii::app()->user->id))
				{
					if($user->type == 2 || $user->type == 3)
					{
						?>
						<tr><td colspan = '6'>&nbsp;
							</td></tr>
						<tr>
							<td colspan = '8'>
								<table width = '100%'>
									<tr>
										<td style = 'text-align: center'>__________________________</td>
										<td style = 'text-align: center'>__________________________</td>
										<td style = 'text-align: center'>__________________________</td>
									</tr>
									<tr>
										<td style = 'text-align: center'>(__________________________)</td>
										<td style = 'text-align: center'>(__________________________)</td>
										<td style = 'text-align: center'>(__________________________)</td>
									</tr>
									<tr>
										<td style = 'text-align: center'>วันที่ ____/____/____</td>
										<td style = 'text-align: center'>วันที่ ____/____/____</td>
										<td style = 'text-align: center'>วันที่ ____/____/____</td>
										<td></td>
									</tr>
									<tr>
										<td style = 'text-align: center'>ผู้ผลิตสินค้า</td>
										<td style = 'text-align: center'>ตัวแทนกระจายสินค้า</td>
										<td style = 'text-align: center'>ผู้สั่งซื้อ / ผู้รับสินค้า</td>
									</tr>
									<tr>
										<td style = 'text-align: center'>
											<?php
											if(isset($supplierAddr))
											{
												echo $supplierAddr->company;
											}
											?>
										</td>
										<td  style='text-align: center'>
											<?php
											if(isset($dealerAddr))
											{
												echo $dealerAddr->company;
											}
											?>
										</td>
										<td  style='text-align: center'>
											<?php
											$userAddr = Address::model()->find("userId = :userId", array(
												":userId"=>$model->userId));
											if(isset($userAddr))
											{
												echo $userAddr->company != "---" ? $userAddr->company : $model->paymentCompany;
											}
											?>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<?php
					} elseif ($user->type == 1 || $user->type == 4 || $user->type == 5) {
                                                            ?>
                        <!--                                                <tr><td colspan = '8'>&nbsp;
                                                                            </td></tr>-->
                                                            <tr><td colspan = '8' style="text-align: center"><b>
                                                                        ในนามบริษัท ไดอิ กรุ๊ป จำกัด (มหาชน)<br>
                                                                                                For Daii Group Public Company Limited.
                                                                                            </b>
                                                                                        </td></tr>
                                                                                    <tr>
                                                                <td colspan = '8'>
                                                                    <table width = '100%'>
                                                                                    <tr>
                                                                                        <td style = 'text-align: center'><?php echo CHtml::image(Yii::app()->baseUrl . '/images/signed/mks-signature.png', '', array('style' => 'width:100px;')); ?></td>
                                                                                                    <td style = 'text-align: center'>วันที่ <?php echo $this->dateThai(date("Y-m-d", strtotime($model->paymentDateTime)), 3); ?></td>
                                                                                                                            <td style = 'text-align: center'><?php echo CHtml::image(Yii::app()->baseUrl . '/images/signed/taweeporn.png', '', array('style' => 'width:100px;')); ?></td>
                                                                                                                <td style = 'text-align: center'>วันที่ <?php echo $this->dateThai(date("Y-m-d", strtotime($model->paymentDateTime)), 3); ?></td>
                                                                                    </tr>
            <!--                                                                                                <tr>
                                <td style = 'text-align: center'>__________________________</td>
                                                                                                    <td style = 'text-align: center'>__________________________</td>
                                                                                                                            <td style = 'text-align: center'>__________________________</td>
                </tr>-->
                                                                                                            <tr>
                                                                                                                <td style = 'text-align: center'>__________________________</td>
                                                                                                                            <td style = 'text-align: center'>__________________________</td>

                                                                            <td style = 'text-align: center'>__________________________</td>
                                                                                        <td style = 'text-align: center'>__________________________</td>

                                                                                                                        </tr>
                        <!--                                                                        <tr>
                                                                                        <td style = 'text-align: center'>(__________________________)</td>
                                                                            <td style = 'text-align: center'>(__________________________)</td>
                                                                            <td style = 'text-align: center'>(__________________________)</td>
                                                                                                </tr>-->
                                    <!--                                                                                    <tr>
                                                                                                                                                                
                                                                                                                                        <td style = 'text-align: center'>วันที่ ____/____/____</td>
                                                                                                                <td style = 'text-align: center'>วันที่ <?php // echo $model->paymentDateTime;  ?></td>
                                                                                                                                        <td></td>
                                                                                                            </tr>-->
                                                                                    <tr>
                                                                                                    <td style = 'text-align: center'>Authorized Signature</td>
                                                                                                    <td style = 'text-align: center'>Date</td>
                                                                                                                <td style = 'text-align: center'>Received By</td>
                                                                                                                <td style = 'text-align: center'>Date</td>
                                                                                                </tr>
                                                                                    <tr>
                                                                                        <td style = 'text-align: center'>ผู้อนุมัติ</td>
                                                                                                                <td style = 'text-align: center'>วันที่</td>
                                                                                                    <td style = 'text-align: center'>ผู้รับเงิน</td>
                                                                                                    <td style = 'text-align: center'>วันที่</td>
                                                                                                </tr>
                                                                                    <tr>
                                                                            <td style = 'text-align: center'>
                                                                                <?php
                                                //                                                                                if (isset($supplierAddr)) {
//                                                                                    echo $supplierAddr->company;
//                                                                                }
            ?>
                                                                            </td>
                                                                            <td  style='text-align: center'>
                                                                                <?php
                                                                    //                                                                                if (isset($dealerAddr)) {
//                                                                                    echo $dealerAddr->company;
//                                                                                }
            ?>
                                                                            </td>
                                                                            <td  style='text-align: center'>
            <?php
//            $userAddr = Address::model()->find("userId = :userId", array(
//                ":userId" => $model->userId));
//            if (isset($userAddr)) {
//                echo $userAddr->company != "---" ? $userAddr->company : $model->paymentCompany;
//            }
            ?>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
            <?php
                                                        }
                                                    }
			}
			if(isset($user))
			{
				if(!($model->status == 1 || $model->status == 2 || $model->status == 98 || $model->status == 99 || $model->status == 0))
				{
					echo "
									<tr>
							<td colspan = '7' style = 'text-align: right'>
					<span style = 'color:red'>**</span>สั่งซื้อและชำระเงินผ่านทาง daiiBuy.com ณ วันที่ " . $this->dateThai($model->paymentDateTime, 1) . " เรียบร้อยแล้ว
					</td>
					</tr>";
				}
			}
			else if($model->status > 2 && $model->status < 99)
			{
				echo "<tr><td colspan = '6'>&nbsp;</td></tr>
						<tr>
							<td colspan = '6' style = 'text-align: right'>
					<span style = 'color:red'>**</span>สั่งซื้อและชำระเงินผ่านทาง daiiBuy.com ณ วันที่ " . $this->dateThai($model->paymentDateTime, 1) . " เรียบร้อยแล้ว
					</td>
					</tr>";
			}
			?>
		</tfoot>
	</table>
	<?php
	if($model->isSentToCustomer == 1 && ($user->type == 3) && $model->status != 3)
	{
		?>
		<div class="row-fluid" style="margin-top: 10px">
			<table class="table table-striped table-bordered table-condensed">

				<thead>
					<tr>
						<td style="text-align: center"><b>ผู้รับสินค้าแทน</b></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php
						$customerReserve = @unserialize(urldecode($model->customerReserve));
						$i = 1;
						if(isset($customerReserve))
							foreach($customerReserve as $person):
								?>
								<td colspan = '2' style = 'text-align: center;width:33%' >
									ผู้รับแทนคนที่ <?php echo ($i) . " : " . $person; ?>
								</td>
								<?php
								$i++;
								if($i == 4)
									break;
							endforeach;
						?>

					</tr>
				</tbody>
				<tfoot>
					<tr><td colspan = '6'>&nbsp;</td></tr>
					<tr>
						<td colspan = '6' style = 'text-align: right'>
							<b>เลขประจำตัวประชาชนผู้รับสินค้า ___-____________-_______________-______-___</b>
						</td>
					</tr>
					<tr>
						<td colspan = '6' style = 'text-align: right'>
							<span style = 'color:red'><b>**</b></span> กรุณากรอกเลขที่บัตรประจำตัวประชาชน 13 หลักของผู้รับสินค้าก่อนส่งมอบสินค้า
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
		<?php
	}
	?>

</div>