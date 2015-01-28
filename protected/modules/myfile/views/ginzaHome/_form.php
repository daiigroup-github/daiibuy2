<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
$this->breadcrumbs = array(
	$this->module->id,
);
?>


<?php $this->renderPartial("_navbar"); ?>
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
										<td><?php echo number_format($item->totalIncVAT); ?></td>
										<td style="color:green;text-align: center"><?php echo OrderGroup::model()->showOrderStatus($child1->status); ?>
										</td>
										<td style="width: 15%;text-align: center">
											<?php if($child1->status >= 3): ?>
												<span class="label label-success">อนุมัติ</span>
												<?php
											else:
												if($model->status >= 3 && $child1->status == 1):
													?>
													<span class="label label-danger">รอการชำระเงิน</span>
													<form id="payForm2"  method="POST" class='form-horizontal' action="<?php echo Yii::app()->createUrl("/checkout/step/myfileGinzaStep?orderGroupId=" . $child1->orderGroupId); ?>">
														<?php
														echo CHtml::link("ชำระเงิน", "", array(
															'class'=>'button blue btn-xs',
															'onclick'=>"payClick(2)"));
														$this->renderPartial("_condition", array(
															'period'=>2));
														?>
													</form>
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
											<td><?php echo number_format($item->totalIncVAT); ?></td>
											<td style="color:green;text-align: center"><?php echo OrderGroup::model()->showOrderStatus($child2->status); ?>
											</td>
											<td style="width: 15%;text-align: center">
												<?php if($child2->status >= 3): ?>
													<span class="label label-success">อนุมัติ</span>
													<?php
												else:
													if($child1->status >= 3 && $child2->status == 1):
														?>
														<span class="label label-danger">รอการชำระเงิน</span>
														<form id="payForm3"  method="POST" class='form-horizontal' action="<?php echo Yii::app()->createUrl("/checkout/step/myfileGinzaStep?orderGroupId=" . $child2->orderGroupId); ?>">
															<?php
															echo CHtml::link("ชำระเงิน", "", array(
																'class'=>'button blue btn-xs',
																'onclick'=>"payClick(3)"));
															$this->renderPartial("_condition", array(
																'period'=>3));
															?>
														</form>
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
											<td><?php echo number_format($item->totalIncVAT); ?></td>
											<td style="color:green;text-align: center"><?php echo OrderGroup::model()->showOrderStatus($child3->status); ?>
											</td>
											<td style="width: 15%;text-align: center">
												<?php if($child3->status >= 3): ?>
													<span class="label label-success">อนุมัติ</span>
													<?php
												else:
													if($child2->status >= 3 && $child3->status == 1):
														?>
														<span class="label label-danger">รอการชำระเงิน</span>
														<form id="payForm4"  method="POST" class='form-horizontal' action="<?php echo Yii::app()->createUrl("/checkout/step/myfileGinzaStep?orderGroupId=" . $child3->orderGroupId); ?>">
															<?php
															echo CHtml::link("ชำระเงิน", "", array(
																'class'=>'button blue btn-xs',
																'onclick'=>"payClick(4)"));
															$this->renderPartial("_condition", array(
																'period'=>4));
															?>
														</form>
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
							if(isset($child3)):
								$child4 = $child3->child;
								if(isset($child4)):
									$parentId = $child4->orderGroupId;
									if($child4->status < 3)
									{
										$isShowPayButton = FALSE;
									}
									foreach($child4->orders as $item):
										?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $item->orderItems[0]->product->name; ?><br><?php echo $this->getOrderPeriodText($i) ?></td>
											<td><?php echo number_format($item->orderItems[0]->product->price); ?></td>
											<td style="color:green;text-align: center"><?php echo OrderGroup::model()->showOrderStatus($child4->status); ?>
											</td>
											<td style="width: 15%;text-align: center">
												<?php if($child4->status >= 3): ?>
													<span class="label label-success">อนุมัติ</span>
												<?php else: ?>
													<span class="label label-danger">รอการอนุมัติ</span>
													<?php
													echo $payButton;
													?>
												<?php endif; ?>
											</td>
										</tr>
										<?php
										$i++;
									endforeach;
								endif;
							endif;
							$flag = true;
							foreach($productWithOutPay as $item2):
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $item2->product->name; ?><br><?php echo $this->getOrderPeriodText($i) ?></td>
									<td><?php echo number_format($item2->product->price); ?></td>
									<td style="color:red;text-align: center">ยังไม่ชำระ
									</td>
									<td style="width: 20%;text-align: center">

										<?php
										if($flag):
											?>

											<?php
											$flag = FALSE;
											?>
											<form id="payForm<?php echo $i; ?>"  method="POST" class='form-horizontal' action="<?php echo Yii::app()->createUrl("/checkout/step/4"); ?>">

												<?php
												echo CHtml::hiddenField("orderGroupId", $parentId);
												echo CHtml::hiddenField("productId", $item2->productId);
												echo CHtml::hiddenField("paymentMethod", 1);
												if($isShowPayButton)
												{
													?>
													<span class="label label-danger">รอการชำระเงิน</span>
													<?php
													echo CHtml::link("ชำระเงิน", "", array(
														'class'=>'button blue btn-xs',
														'onclick'=>"payClick($i)"));
													$this->renderPartial("_condition", array(
														'period'=>$i));
												}
												else
												{
													?>
													<span class="label label-default">รอการอนุมัติ</span>
													<?php
												}
												?>
											</form>
											<?php
										else:
											?>
											<span class="label label-default">รอการอนุมัติ</span>
										<?php
										endif;
										?>
									</td>
								</tr>
								<?php
								$i++;
							endforeach;
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


