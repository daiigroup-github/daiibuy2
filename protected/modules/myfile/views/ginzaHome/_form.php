<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
$this->breadcrumbs = array(
	$this->module->id,
);
?>

<?php
$this->renderPartial("_navbar", array(
	'model'=>$model));
?>
<!-- WIZARD -->
<div class="myfile-main">
	<?php
	$this->renderPartial("_wizard_step", array(
		'model'=>$model));
	?>
	<div class="row setup-content" id="step-3">
		<div class="col-xs-12">
			<div class="row sidebar-box blue " style="background-color: white">
				<div class="col-md-12" style="border:1px black solid" id="item-table">
					<?php if(isset($errorMessage)): ?>
						<h1 class="text-center alert alert-danger" style="font-weight: bold">
							<?php
							echo $errorMessage;
							?>
						</h1>
					<?php endif;
					?>
					<div class="form-group">
						<div class="control-label col-md-2">
							เลขที่ใบสั่งซื้อสินค้า
						</div>
						<div class="col-md-10">
							<h4><?php echo $model->orderNo; ?></h4>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12 text-center">
							<?php
							echo CHtml::image(Yii::app()->baseUrl . $model->orders[0]->orderItems[0]->product->productImagesSort[0]->image, "", array(
								'style'=>'width:500px'))
							?>
						</div>
					</div>
				</div>
				<div class="col-md-12" style="border:1px black solid" id="item-table">
					<h2>GINZA HOME</h2>
					<h4>ตารางแสดงรายละเอียดสินค้า</h4>
					<br>
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<table class="table table-bordered">
								<tr>
									<td>House</td>
									<td><?php echo $cat2ToProduct->category->title; ?></td>
								</tr>
								<tr>
									<td>Price</td>
									<td><?php echo number_format($price, 0) ?></td>
								</tr>
								<tr>
									<td>Spec</td>
									<td><?php echo $cat2ToProduct->category2->title; ?></td>
								</tr>
								<tr>
									<td>Colour</td>
									<td>Silver</td>
								</tr>
<!--								<tr>
									<td>Function</td>
									<td></td>
								</tr>-->
							</table>
							<?php
							if(isset($model->fur[0])):
								$furnitureGroup = FurnitureGroup::model()->findByPk($model->fur[0]->furnitureGroupId);
								$furniture = Furniture::model()->findByPk($model->fur[0]->furnitureId);
								?>
								<h2 style="color:red">คุณทำการสั่งซื้อ Furniture Set</h2>
								<table class="table table-bordered table-hover" style="width:100%">
									<thead>
										<tr>
											<th>Furniture Set</th>
											<th>Price</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center">
												<?php
												echo CHtml::image(Yii::app()->baseUrl . $furnitureGroup->image, "", array(
													'style'=>'width:50%'));
												?><br>
												<?php echo "Set : " . $furnitureGroup->title . " Color :" . $furniture->title; ?>
											</td>
											<td>
												<?php echo number_format($furnitureGroup->price); ?>
												<br>
												<?php if($model->fur[0]->status < 3) : ?>
													<a href="<?php echo Yii::app()->request->baseUrl . "/index.php/myfile/ginzaHome/furniture/id/" . $_GET["id"]; ?>" class="btn btn-primary">แก้ไข</a>
												<?php endif; ?>
											</td>
										</tr>
									</tbody>
								</table>
							<?php endif; ?>
						</div>
					</div>
				</div>
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover" style="width:100%">
						<thead>
							<tr>
								<th style="text-align:center">งวดที่</th>
								<th style="text-align:center">รายละเอียดงาน ชำระก่อนดำเนินงาน</th>
								<th style="text-align:center">มูลค่าการสั่งซื้อ</th>
								<th style="text-align:center">สถานะ</th>
								<th style='text-align: center'>ตรวจรับงาน <p>เพื่อชำระงวดงานถัดไป</p></th>
						</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;
							$child1 = null;
							$child2 = null;
							$child3 = null;
							$child4 = null;
							$parentId = $model->orderGroupId;
							$isShowPayButton = true;
							foreach($model->orders as $item):
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $item->orderItems[0]->product->name; ?><br><?php echo $this->getOrderPeriodText($i) ?></td>
									<td><?php echo number_format($item->totalIncVAT); ?></td>
									<td style="color:green;text-align: center">ชำระ
									</td>
									<td style="width: 15%;text-align: center">
										<span class="label label-success">อนุมัติ</span>
									</td>
								</tr>
								<?php
								$i++;
							endforeach;
							$child1 = $model->child;
							if(isset($child1)):
								$parentId = $child1->orderGroupId;
								if($child1->status < 3)
								{
									$isShowPayButton = FALSE;
								}
								foreach($child1->orders as $item):
									?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $item->orderItems[0]->product->name; ?><br><?php echo $this->getOrderPeriodText($i) ?></td>
										<td>
											<?php
											echo "ยอดชำระ " . number_format($item->totalIncVAT);
											$sumSup2 = 0;
											$sumSupNotPay2 = 0;
											if(count($child1->supPay) > 0):
												?>
												<p style='color:green'>ชำระแล้ว</p>
												<?php
												foreach($child1->supPay as $sup)
												{
													$sumSup2 +=$sup->totalIncVAT;
													echo "<p style='color:green'>" . number_format($sup->totalIncVAT, 2) . "</p>";
												}
											endif;
											if(count($child1->supNotPays) > 0):
												?>
												<p style='color:red'>รอยืนยันชำระ</p>
												<?php
												foreach($child1->supNotPays as $subNotPay)
												{
													$sumSupNotPay2 +=$subNotPay->totalIncVAT;
													echo "<p style='color:red'>" . number_format($subNotPay->totalIncVAT, 2) . " ";
													if($subNotPay->status != 2)
													{
														echo CHtml::link("ยืนยัน", Yii::app()->createUrl("/myfile/order/view/id/" . $subNotPay->orderGroupId), array(
															'class'=>'btn btn-success',
															'target'=>'_blank'));
													}
													else
													{
														echo " <span class='badge badge-warning'>รอตรวจสอบการชำระเงิน</span>";
													}
													echo "</p>";
												}
											endif;
											?>
										</td>
										<td style="color:green;text-align: center"> <?php echo ($sumSup2 == $child1->totalIncVAT) ? "การสั่งซื้อสินค้าสมบูรณ์(รอการจัดส่ง)" : OrderGroup::model()->showOrderStatus($child1->status); ?>
										</td>
										<td style="width: 15%;text-align: center">
											<?php if($child1->totalIncVAT == $sumSup2 || $child1->status >= 3): ?>
												<span class="label label-success">อนุมัติ</span>
												<?php
											else:
												if((($model->status >= 3 && $child1->status == 0) || ($child1->status != 0 && $sumSup2 < $child1->totalIncVAT)) && $child1->status < 1):
													?>
													<span class="label label-danger">รอการชำระเงิน</span>
													<?php
													if($sumSupNotPay2 == 0):
														echo CHtml::link("ชำระเงิน", "", array(
															'class'=>'button blue btn-xs',
															'onclick'=>"payClick(2)"));
//														$this->renderPartial("_condition", array(
//															'period'=>2));
													endif;
													?>
												<?php else: ?>
													<span class="label label-danger">รอการอนุมัติ</span>
												<?php endif; ?>
											<?php endif; ?>
										</td>
									</tr>
									<?php
									$i++;
								endforeach;
							endif;
							if(isset($child1)):
								$child2 = $child1->child;
								if(isset($child2)):
									$parentId = $child2->orderGroupId;
									if($child2->status < 3)
									{
										$isShowPayButton = FALSE;
									}
									foreach($child2->orders as $item):
										?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $item->orderItems[0]->product->name; ?><br><?php echo $this->getOrderPeriodText($i) ?></td>
											<td><?php
												echo "ยอดชำระ " . number_format($item->totalIncVAT);
												$sumSup3 = 0;
												$sumSupNotPay3 = 0;
												if(count($child2->supPay) > 0):
													?>
													<p style='color:green'>ชำระแล้ว</p>
													<?php
													foreach($child2->supPay as $sup)
													{
														$sumSup3 +=$sup->totalIncVAT;
														echo "<p style='color:green'>" . number_format($sup->totalIncVAT, 2) . "</p>";
													}
												endif;
												if(count($child2->supNotPays) > 0):
													?>
													<p style='color:red'>รอยืนยันชำระ</p>
													<?php
													foreach($child2->supNotPays as $subNotPay)
													{
														$sumSupNotPay3 +=$subNotPay->totalIncVAT;
														echo "<p style='color:red'>" . number_format($subNotPay->totalIncVAT, 2) . " ";
														if($subNotPay->status != 2)
														{
															echo CHtml::link("ยืนยัน", Yii::app()->createUrl("/myfile/order/view/id/" . $subNotPay->orderGroupId), array(
																'class'=>'btn btn-success',
																'target'=>'_blank'));
														}
														else
														{
															echo " <span class='badge badge-warning'>รอตรวจสอบการชำระเงิน</span>";
														}
														echo "</p>";
													}
												endif;
												?></td>
											<td style="color:green;text-align: center"><?php echo ($sumSup3 == $child2->totalIncVAT) ? "การสั่งซื้อสินค้าสมบูรณ์(รอการจัดส่ง)" : OrderGroup::model()->showOrderStatus($child2->status); ?>
											</td>
											<td style="width: 15%;text-align: center">
												<?php if(($child1->totalIncVAT == $sumSup2 || $child1->status >= 3) && ($sumSup3 == $child2->totalIncVAT || $child2->status >= 3)): ?>
													<span class="label label-success">อนุมัติ</span>
													<?php
												else:
													if((($child1->status >= 3 || $child1->totalIncVAT == $sumSup2) && ($child2->status == 0 || ($child2->status != 0 && $sumSup3 < $child2->totalIncVAT)) && $child2->status < 1)):
														?>
														<span class="label label-danger">รอการชำระเงิน</span>
														<?php
														if($sumSupNotPay3 == 0):
															echo CHtml::link("ชำระเงิน", "", array(
																'class'=>'button blue btn-xs',
																'onclick'=>"payClick(3)"));
//															$this->renderPartial("_condition", array(
//																'period'=>3));
														endif;
														?>
													<?php else:
														?>
														<span class="label label-danger">รอการอนุมัติ</span>
													<?php endif; ?>
												<?php endif; ?>
											</td>
										</tr>
										<?php
										$i++;
									endforeach;
								endif;
							endif;
							if(isset($child2)):
								$child3 = $child2->child;
								if(isset($child3)):
									$parentId = $child3->orderGroupId;
									if($child3->status < 3)
									{
										$isShowPayButton = FALSE;
									}
									foreach($child3->orders as $item):
										?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $item->orderItems[0]->product->name; ?><br><?php echo $this->getOrderPeriodText($i) ?></td>
											<td><?php
												echo "ยอดชำระ " . number_format($item->totalIncVAT);
												$sumSup4 = 0;
												$sumSupNotPay4 = 0;
												if(count($child3->supPay) > 0):
													?>
													<p style='color:green'>ชำระแล้ว</p>
													<?php
													foreach($child3->supPay as $sup)
													{
														$sumSup4 +=$sup->totalIncVAT;
														echo "<p style='color:green'>" . number_format($sup->totalIncVAT, 2) . "</p>";
													}
												endif;
												if(count($child3->supNotPays) > 0):
													?>
													<p style='color:red'>รอยืนยันชำระ</p>
													<?php
													foreach($child3->supNotPays as $subNotPay)
													{
														$sumSupNotPay4 +=$subNotPay->totalIncVAT;
														echo "<p style='color:red'>" . number_format($subNotPay->totalIncVAT, 2) . " ";
														if($subNotPay->status != 2)
														{
															echo CHtml::link("ยืนยัน", Yii::app()->createUrl("/myfile/order/view/id/" . $subNotPay->orderGroupId), array(
																'class'=>'btn btn-success',
																'target'=>'_blank'));
														}
														else
														{
															echo " <span class='badge badge-warning'>รอตรวจสอบการชำระเงิน</span>";
														}
														echo "</p>";
													}
												endif;
												?></td>
											<td style="color:green;text-align: center"><?php echo ($sumSup4 == $child3->totalIncVAT) ? "การสั่งซื้อสินค้าสมบูรณ์(รอการจัดส่ง)" : OrderGroup::model()->showOrderStatus($child3->status); ?>
											</td>
											<td style="width: 15%;text-align: center">
												<?php if(($child2->totalIncVAT == $sumSup3 || $child2->status >= 3) && ($sumSup4 == $child3->totalIncVAT || $child3->status >= 3)): ?>
													<span class="label label-success">อนุมัติ</span>
													<?php
												else:
													if(($child2->status >= 3 || $child2->totalIncVAT == $sumSup3) && (($child3->status == 0 || ($child3->status != 0 && $sumSup4 < $child3->totalIncVAT)) && $child3->status < 1)):
														?>
														<span class="label label-danger">รอการชำระเงิน</span>

														<?php
														if($sumSupNotPay4 == 0):
															echo CHtml::link("ชำระเงิน", "", array(
																'class'=>'button blue btn-xs',
																'onclick'=>"payClick(4)"));
//															$this->renderPartial("_condition", array(
//																'period'=>4));
														endif;
														?>
													<?php else: ?>
														<span class="label label-danger">รอการอนุมัติ</span>
													<?php endif; ?>
												<?php endif; ?>
											</td>
										</tr>
										<?php
										$i++;
									endforeach;
								endif;
							endif;
//							if(isset($child3)):
//								$child4 = $child3->child;
//								if(isset($child4)):
//									$parentId = $child4->orderGroupId;
//									if($child4->status < 3)
//									{
//										$isShowPayButton = FALSE;
//									}
//									foreach($child4->orders as $item):
//										
                                                                                ?>
<!--										<tr>
                                                                                    <td>//<?php // echo $i;  ?></td>
                                                                                    <td>//<?php // echo $item->orderItems[0]->product->name;  ?><br><?php // echo $this->getOrderPeriodText($i)  ?></td>
                                                                                    <td>//<?php // echo number_format($item->orderItems[0]->product->price);  ?></td>
                                                                                    <td style="color:green;text-align: center">//<?php // echo OrderGroup::model()->showOrderStatus($child4->status);  ?>
                                                                                    </td>
											<td style="width: 15%;text-align: center">
                                                                                            //<?php // if ($child4->status >= 3):  ?>
                                                                                                <span class="label label-success">อนุมัติ</span>
                                                                                                        //<?php // else:  ?>
                                                                                                            <span class="label label-danger">รอการอนุมัติ</span>
                                                                                                        //<?php
//                                                                    //													echo $payButton;
//                
                                                                                                            ?>
                                                                                                            //<?php // endif;  ?>
                                                                                        </td>
                                                                                </tr>-->
                                                                                <?php
//										$i++;
//									endforeach;
//								endif;
//							endif;
                                                                                ?>
						</tbody>
					</table>


				</div>
			</div>
			<div class="row <?php echo ($this->action->id == "create") ? " hide" : "" ?>" id="action-button">
				<div class="col-md-12 wizard-control">
					<!--<a class="btn btn-warning btn-lg col-lg-offset-3" onclick="updatePrice()"><i class="glyphicon glyphicon-refresh"></i> อัพเดทราคา</a>-->
					<!--<button id="nextToStep4" class="btn btn-primary btn-lg pull-right"><i class="glyphicon glyphicon-chevron-right"></i> ต่อไป</button>-->
				</div>
			</div>
		</div>
	</div>
	<div class="row setup-content" id="step-3-1">
		<div class="row sidebar-box blue " style="background-color: white">
			<div class="row">
				<div class="col-lg-12" id="conditionDiv">
					<?php
					$this->renderPartial("_condition", array(
						'model'=>$model,
						'period'=>2,
						'brandModels'=>$brandModels,
						'child1'=>$child1));
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="row setup-content" id="step-3-2">

		<?php if(isset($order)): ?>

		<?php endif; ?>
		<div class="row sidebar-box blue " style="background-color: white">
			<div class="col-md-12" style="text-align: right">

			</div>
			<div class="col-md-12" style="border:1px black solid" id="item-table">
				<div class="control-label col-md-2">
					เลขที่ใบสั่งซื้อสินค้า
				</div>
				<div class="col-md-10">
					<h4><?php echo $model->orderNo; ?></h4>
				</div>
			</div>
			<div class="col-md-12 text-center">
				<?php
				echo CHtml::image(Yii::app()->baseUrl . $model->orders[0]->orderItems[0]->product->productImagesSort[0]->image, "", array(
					'style'=>'width:500px'))
				?>
			</div>
			<div class="col-md-12" style="border:1px black solid" id="item-table">
				<h2>GINZA HOME</h2>
				<h4>ตารางแสดงรายละเอียดสินค้า</h4>
				<br>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<table class="table table-bordered">
							<tr>
								<td>House</td>
								<td><?php echo $cat2ToProduct->category->title; ?></td>
							</tr>
							<tr>
								<td>Price</td>
								<td><?php echo number_format($price, 0) ?></td>
							</tr>
							<tr>
								<td>Spec</td>
								<td><?php echo $cat2ToProduct->category2->title; ?></td>
							</tr>
							<tr>
								<td>Colour</td>
								<td>Silver</td>
							</tr>
	<!--								<tr>
								<td>Function</td>
								<td></td>
							</tr>-->
						</table>
					</div>
				</div>
				<form id="payForm3"  method="POST" class='form-horizontal' action="<?php echo Yii::app()->createUrl("/checkout/step/myfileGinzaStep?orderGroupId=" . $child2->orderGroupId); ?>">
					<table class="row hide table table-bordered" id="period3" >
						<thead>
							<tr style="background-color: blue">
								<th>งวด</th>
								<th>รายการ</th>
								<th>ราคา</th>
								<th>ยอดชำระ</th>
							</tr>
						</thead>
						<tbody>
							<?php
							echo CHtml::hiddenField("orderGroupId", $model->orderGroupId);
							echo CHtml::hiddenField("period", 3);
							foreach($child2->orders as $item):
								?>
								<tr style="color:black">
									<td  style="font-size:24px"><span style="margin-top:50px">งวดที่ 3</span></td>
									<td>
										<?php
										echo "<span style='font-size:24px'> " . $item->orderItems[0]->product->name . "</span> <br>" . $this->getOrderPeriodText(3);
										?>
									</td>
									<td style="font-size:24px">
										<p style="color:red;text-decoration:line-through"><?php echo number_format($item->orderItems[0]->product->price); ?></p>
										<?php
										echo number_format($child2->totalIncVAT);
										$sumSup = 0;
										foreach($child2->sup as $sup)
										{
											$sumSup +=$sup->totalIncVAT;
											echo "<p style='color:green'>" . number_format($sup->totalIncVAT, 2) . "</p>";
										}
										?>
									</td>
									<td>
										<?php
										echo CHtml::textField("payValue", $child2->totalIncVAT - $sumSup, array(
											'class'=>'input-large text-right',
											'style'=>'border:2px solid black;color:blue;font-size:24px'))
										?>
										<a onclick="backToStep3()" class="btn btn-success">Back</a>
										<?php
										echo CHtml::link("ชำระเงิน", "", array(
											'class'=>'btn btn-primary',
											'onclick'=>"pay(3)"));
										?>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</form>
				<form id="payForm4"  method="POST" class='form-horizontal' action="<?php echo Yii::app()->createUrl("/checkout/step/myfileGinzaStep?orderGroupId=" . $child3->orderGroupId); ?>">
					<table class="row hide table table-bordered" id="period4" >
						<thead>
							<tr style="background-color: blue">
								<th>งวด</th>
								<th>รายการ</th>
								<th>ราคา</th>
								<th>ยอดชำระ</th>
							</tr>
						</thead>
						<tbody>
							<?php
							echo CHtml::hiddenField("orderGroupId", $model->orderGroupId);
							echo CHtml::hiddenField("period", 4);
							foreach($child3->orders as $item):
								?>
								<tr style="color:black">
									<td  style="font-size:24px"><span style="margin-top:50px">งวดที่ 4</span></td>
									<td>
										<?php
										echo "<span style='font-size:24px'> " . $item->orderItems[0]->product->name . "</span> <br>" . $this->getOrderPeriodText(3);
										?>
									</td>
									<td style="font-size:24px">
										<?php
										echo number_format($child3->totalIncVAT);
										$sumSup = 0;
										foreach($child3->sup as $sup)
										{
											$sumSup +=$sup->totalIncVAT;
											echo "<p style='color:green'>" . number_format($sup->totalIncVAT, 2) . "</p>";
										}
										?>
									</td>
									<td>
										<?php
										echo CHtml::textField("payValue", $child3->totalIncVAT - $sumSup, array(
											'class'=>'input-large text-right',
											'style'=>'border:2px solid black;color:blue;font-size:24px'))
										?>
										<a onclick="backToStep3()" class="btn btn-success">Back</a>
										<?php
										echo CHtml::link("ชำระเงิน", "", array(
											'class'=>'btn btn-primary',
											'onclick'=>"pay(4)"));
										?>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</form>
			</div>
		</div>
	</div>
	<div class="row setup-content" id="step-4">
		<div class="col-xs-12">
			<div class="col-md-12 well">

				<div class="row wizard-control">
					<div class="pull-right">
						<a id="backToStep3" class="btn btn-primary btn-lg" href="<?php echo Yii::app()->createUrl("/myfile/madrid/backTo3/id/$model->orderGroupId") ?>"><i class="glyphicon glyphicon-chevron-left"></i> ย้อนกลับ</a>
						<a id="finishAtech" class="btn btn-success btn-lg" href="<?php echo Yii::app()->createUrl("/myfile/madrid/finish/id/$model->orderGroupId") ?>"><i class="glyphicon glyphicon-ok"></i> เสร็จสิ้น</a>
						<a class="btn btn-warning btn-lg" href="<?php echo Yii::app()->createUrl("/myfile/madrid/addToCart/id/$model->orderGroupId") ?>"><i class="glyphicon glyphicon-shopping-cart"></i> ใส่ตระกร้า</a>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>


