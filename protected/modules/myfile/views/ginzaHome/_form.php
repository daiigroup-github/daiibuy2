<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
$this->breadcrumbs = array(
	$this->module->id,
);
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'Order-form',
	// Please note: When you enable ajax validation, make sure the corresponding
// controller action is handling ajax validation correctly.
// There is a call to performAjaxValidation() commented in generated controller code.
// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'enctype'=>'multipart/form-data',
	),
	));
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
			<div class="row sidebar-box blue ">
				<div class="col-md-12" style="border:1px black solid" id="item-table">
					<div class="form-group">
						<div class="control-label col-md-2">
							เลขที่ใบสั่งซื้อสินค้า
						</div>
						<div class="col-md-10">
							<?php ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12 text-center">
							<?php ?>
						</div>
					</div>
				</div>
				<div class="col-md-12" style="border:1px black solid" id="item-table">
					<h3>GINZA HOME</h3>
					<h4><?php echo $model->orderItems[0]->product->name; ?></h4>
				</div>
			</div>
			<div class="row <?php echo ($this->action->id == "create") ? " hide" : "" ?>" id="action-button">
				<div class="col-md-12 wizard-control">
					<!--<a class="btn btn-warning btn-lg col-lg-offset-3" onclick="updatePrice()"><i class="glyphicon glyphicon-refresh"></i> อัพเดทราคา</a>-->
					<button id="nextToStep4" class="btn btn-primary btn-lg pull-right"><i class="glyphicon glyphicon-chevron-right"></i> ต่อไป</button>
				</div>
			</div>
		</div>
	</div>
	<div class="row setup-content" id="step-4">
		<div class="col-xs-12">
			<div class="col-md-12 well">
				<div class="row sidebar-box" id="confirm_content">
					<div class="col-xs-12">
						<div class="sidebar-box-heading">
							<i class="fa fa-list"></i>
							<h4>ยืนยันรายการสินค้า <?php echo $model->title; ?></h4>
						</div>
						<div class="row sidebox-content ">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<table class="table table-bordered table-hover">
											<thead>
												<tr>
													<?php if($model->isTheme): ?>
														<th>ลำดับ</th>
														<th>รายละเอียดรายการที่ชอบ</th>
														<th style="width: 10%;text-align: center">พื้นที่จาก การประเมิณ</th>
														<th>หน่วย</th>
														<th>รหัส</th>
														<th>รายละเอียดสินค้า</th>
														<th>หน่วย</th>
														<th>จำนวน/หน่วย</th>
														<th style="width: 10%;text-align: center">ปริมาณจาก การประเมิณพื้นที่</th>
														<th>ปริมาณแก้ไข</th>
														<th>ราคารวม</th>
													<?php else: ?>
														<th>Product Image</th>
														<th>Code</th>
														<th>Title/Category</th>
														<th>Price</th>
														<th>Action</th>
													<?php endif; ?>
												</tr>
											</thead>
											<tbody>
												<?php
												$i = 1;
												foreach($model->orderItems as $item):
													?>
													<?php if($model->isTheme): ?>
														<tr id="orderItem<?php echo strtolower($item->groupName); ?>">
															<td><?php echo $i; ?></td>
															<td style="text-align:center"><?php echo $item->groupName ?></td>
															<td style="text-align: center"><?php echo $item->area; ?><?php echo CHtml::hiddenField("supplierArea" . strtolower($item->groupName), $item->area); ?></td>
															<td>ตร.เมตร</td>
															<td id="productCode<?php echo strtolower($item->groupName) ?>" class="text-info" id="productCode"><?php echo $item->product->code; ?></td>
															<td id="productName<?php echo strtolower($item->groupName) ?>"><?php echo $item->product->name; ?></td>
															<td id="productUnits<?php echo strtolower($item->groupName) ?>"><?php echo $item->product->productUnits; ?></td>
															<?php
															$productArea = ($item->product->width * $item->product->height) / 10000;
															$estimateQuantity = $productArea * $item->area;
															?>

															<td  style="text-align: center" id="productArea<?php echo strtolower($item->groupName) ?>">
																<?php echo $productArea; ?>
															</td>
															<td style="text-align: center" id="estimateAreaQuantity<?php echo strtolower($item->groupName) ?>"><?php echo $estimateQuantity ?></td>
															<td id="quantity<?php echo strtolower($item->groupName) ?>"><?php
																echo $item->quantity;
																?></td>
															<td id="price<?php echo strtolower($item->groupName) ?>"><?php echo number_format($item->quantity * $item->product->price) ?></td>
														</tr>
													<?php else: ?>
														<tr>
															<td><?php echo (isset($item->product->productImagesSort) && count($item->product->productImagesSort)) ? CHtml::image(Yii::app()->baseUrl . $item->product->productImagesSort[0]->image) : ""; ?></td>
															<td><?php echo $item->product->code; ?></td>
															<td><?php echo $item->product->name; ?></td>
															<td style="color:red"><?php echo number_format($item->product->price, 2); ?>
																<?php // echo CHtml::hiddenField("Order[createMyfileType]", 3) ?>
																<?php echo CHtml::hiddenField("OrderItems[$item->orderItemsId][productId]", $item->productId) ?>
																<?php echo CHtml::hiddenField("OrderItems[$item->orderItemsId][price]", $item->product->price) ?>
															</td>
															<td style="width: 20%">
																<div class="row"><div class="col-md-12"><?php echo number_format($item->quantity, 2); ?></div></div>
															</td>
														</tr>
													<?php endif; ?>
													<?php
													$i++;
												endforeach;
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row wizard-control">
					<div class="pull-right">
						<a id="backToStep3" class="btn btn-primary btn-lg" href="<?php echo Yii::app()->createUrl("/myfile/madrid/backTo3/id/$model->orderId") ?>"><i class="glyphicon glyphicon-chevron-left"></i> ย้อนกลับ</a>
						<a id="finishAtech" class="btn btn-success btn-lg" href="<?php echo Yii::app()->createUrl("/myfile/madrid/finish/id/$model->orderId") ?>"><i class="glyphicon glyphicon-ok"></i> เสร็จสิ้น</a>
						<a class="btn btn-warning btn-lg" href="<?php echo Yii::app()->createUrl("/myfile/madrid/addToCart/id/$model->orderId") ?>"><i class="glyphicon glyphicon-shopping-cart"></i> ใส่ตระกร้า</a>
						<?php if(!$model->isRequestSpacialProject): ?>
							<a id="requestSpecial" class="btn btn-info btn-lg" href="<?php echo Yii::app()->createUrl("/myfile/madrid/requestSpacialProject/id/$model->orderId") ?>"><i class="glyphicon glyphicon-share"></i> Request Special Project</a>
						<?php else: ?>
							<span class="btn btn-danger btn-xs">Sending Request Spacial Project</span>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>


<?php $this->endWidget(); ?>
