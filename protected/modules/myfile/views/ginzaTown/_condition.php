<h2 class="blue text-center" id="myModalLabel">ข้อตกลงและเงื่อนไข ตรวจรับงานงวดที่ <?php echo $period ?></h2>
<div class="col-md-12">
	<!--						<div class="sidebar-box-heading">
								<i class="fa fa-tdst"></i>
								<h4>ข้อตกลงและเงื่อนไข <?php // echo $model->title;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               ?></h4>
							</div>-->
	<div class="row sidebox-content ">
		<?php
		if(isset($conditionOrder)):
			?>
			<div class="col-md-12" >
				<div class="form-group">
					<div class="control-label col-md-2">
						เลขที่ใบสั่งซื้อสินค้า
					</div>
					<div class="col-md-10">
						<h4><?php echo $conditionOrder->orderNo; ?></h4>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12 text-center">
						<?php
						echo CHtml::image(Yii::app()->baseUrl . $conditionOrder->orders[0]->orderItems[0]->product->productImagesSort[0]->image, "", array(
							'style'=>'width:500px'))
						?>
					</div>
				</div>
			</div>
			<hr>
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-11">
						เนื่องจากบางบริษัทได้เข้าดำเนินการสำรวจผังตามใบสั่งซื้อของลูกค้าไปแล้วนั้น ทางบริษัทเห็นว่า สามารถเข้าดำเนินการก่อสร้างขั้นตอไปได้<br>
						ผู้สั่งซื้อกรุณาตรวจสอบรายละเอียด และแบบและสัญญาให้ครบถ้วน ตามรายการด้านล่าง

						<table class="table table-bordered table-condensed ">
							<?php
							$sendWorks = OrderGroupSendWork::model()->findAll("orderGroupId = $conditionOrder->orderGroupId ORDER BY seq ASC");
							foreach($sendWorks as $sendWork):
								?>
								<tr>
									<td style="width:50%"><?php echo $sendWork->title; ?> </td><td><a href="<?php echo Yii::app()->baseUrl . $sendWork->image; ?>" class="fancybox"><span class="label label-primary">View Attech File</span></a></td>
								</tr>
							<?php endforeach; ?>
	<!--						<tr>
	<td style="width:50%">Layout Approve </td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
	</tr>
	<tr>
	<td>ผลสำรวจ</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
	</tr>
	<tr>
	<td>ใบรับงานสำรวจ</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
	</tr>-->
						</table>

					</div>
				</div>
			<?php endif; ?>
			<!--			<div class="row">
							<div class="col-md-11">
								2. ก่อนสังซื้องวดต่อไป ผู้สั่งซื้อต้องอ่านแล้วทำความเข้าใจ รายละเอียดแบบและสัญญาให้ครบถ้วนตามรายการด้านล่างดังนี้
								<table class="table table-bordered table-condensed ">
									<tr>
										<td style="width:50%">แบบผังพื้น</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
									</tr>
									<tr>
										<td>แบบรูปด้าน</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
									</tr>
									<tr>
										<td>แบบรูปตัด</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
									</tr><tr>
										<td>แบบงานระบบไฟฟ้า</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
									</tr><tr>
										<td>แบบงานระบบสุขาภิบาล</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
									</tr><tr>
										<td>สัญญาซื้อขาย</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
									</tr>
								</table>
							</div>
						</div>-->
			<div class="row hide"  id="changHouseDetail">
				<div class="col-md-12" >
					<div class="row">
						<div class="col-md-12">
							ก่อนสั่งซื้องวดต่อไป ลูกค้าสามารถปรับเปลี่ยนรายละเอียดบ้านได้โดย
						</div>
					</div>
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td> </td>
								<td>สามารถปรับเปลี่ยน Series ของบ้านจาก Light / C / E / SL ได้ โดยคิดมูลค่าตามจริงของบ้านหลังนั้นๆ</td>
							</tr>
							<tr>
								<td></td>
								<td>สามารถปรับเปลี่ยนสีของบ้าน Silver / Oak Brown / Earth Tone ได้โดยไม่เสียค่าใช้จ่ายเพิ่ม</td>
							</tr>
							<tr>
								<td></td>
								<td>สามารถปรับเปลี่ยน Size ของบ้านได้ โดยคิดมูลค่าตามจริงของบ้านหลังนั้นๆ</td>
							</tr>
							<tr>
								<td colspan="2" style="color:red">ซึ่งหลังจากนี้แล้วทางบริษัทฯจะเข้าดำเนินการก่อสร้างตามรายละเอียดที่ลูกค้ายืนยัน ลูกค้าจะไม่สามารถปรับเปลี่ยนใดๆ ได้อีก</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row hide" id="changHouseDetail2">
				<div class="col-md-12">
					<form id="payForm2"  method="POST" class='form-horizontal' action="<?php echo Yii::app()->createUrl("/checkout/step/myfileGinzaStep?orderGroupId=" . $child1->orderGroupId); ?>">
						รายละเอียดบ้านตามที่ลูกค้าเลือกปัจจุบัน
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td>ชนิดบ้าน</td>
									<td><?php
										echo CHtml::hiddenField("orderGroupId", $model->orderGroupId);
										echo CHtml::hiddenField("period", 2);
										$category2ToProduct = Category2ToProduct::model()->find("productId = " . $model->orders[0]->orderItems[0]->productId);
										echo CHtml::dropDownList("brandModelId", $category2ToProduct->brandModelId, $brandModels, array(
											'prompt'=>'-- เลือกแบบบ้าน --',
											'id'=>'brandModelId',
											'ajax'=>array(
												'type'=>'POST',
												'data'=>array(
													'brandModelId'=>'js:this.value'),
												'url'=>$this->createUrl('/myfile/ginzaTown/findHouseModel'),
												'success'=>'js:function(data){

										//$("#sameAddress").prop("disabled", true);
										$("#category1Id").html(data);
										//$("#billingAmphur").prop("disabled", false);
										//$("#billingDistrict").html("");
										//$("#billingDistrict").prop("disabled", true);
										 }'))
										);
										?></td>
								</tr>
								<tr>
									<td>แบบบ้าน</td>
									<td><?php
										echo CHtml::dropDownList("category1Id", $category2ToProduct->category1Id, CategoryToSub::model()->findCatArrayByBrandModelId($category2ToProduct->brandModelId), array(
											'prompt'=>'-- เลือกแบบบ้าน --',
											'ajax'=>array(
												'type'=>'POST',
												'data'=>array(
													'category1Id'=>'js:this.value',
													'brandModelId'=>'js:$("#brandModelId").val()'),
												'url'=>$this->createUrl('/myfile/ginzaHome/findHouseSeries'),
												'success'=>'js:function(data){

										//$("#sameAddress").prop("disabled", true);
										$("#category2Id").html(data);
										//$("#billingAmphur").prop("disabled", false);
										//$("#billingDistrict").html("");
										//$("#billingDistrict").prop("disabled", true);
										 }')));
										?></td>
								</tr>
								<tr>
									<td>ซีรีส์</td>
									<td>
										<?php
										echo CHtml::dropDownList("category2Id", $category2ToProduct->category2Id, CategoryToSub::model()->findSubCatArrayByBrandModelIdAndCategoryId($category2ToProduct->brandModelId, $category2ToProduct->category1Id), array(
											'prompt'=>'-- เลือกแบบบ้าน --',
											'ajax'=>array(
												'type'=>'POST',
												'data'=>array(
													'category2Id'=>'js:this.value',
													'category1Id'=>'js:$("#category1Id").val()',
													'brandModelId'=>'js:$("#brandModelId").val()'),
												'url'=>$this->createUrl('/myfile/ginzaHome/findHouseColor'),
												'success'=>'js:function(data){

										//$("#sameAddress").prop("disabled", true);
										$("#productOptionId").html(data);
										//$("#billingAmphur").prop("disabled", false);
										//$("#billingDistrict").html("");
										//$("#billingDistrict").prop("disabled", true);
										 }')));
										?>
									</td>
								</tr>
								<tr>
									<td>สี</td>
									<td><?php
										echo CHtml::dropDownList("productOptionId", $model->orders[0]->orderItems[0]->productOptionId, CHtml::listData($model->orders[0]->orderItems[0]->product->productOptionGroups[0]->productOptions, "productOptionId", "title"), array(
											'prompt'=>'-- เลือกสี --'));
										?></td>
								</tr>
								<tr>
									<td>จังหวัด</td>
									<td><?php
										echo CHtml::dropDownList("provinceId", $model->shippingProvinceId, Province::model()->findAllProvinceArray(), array(
											'prompt'=>'-- เลือกจังหวัด --'));
										?></td>
								</tr>
							</tbody>
						</table>
						<table class="row hide table table-bordered" id="period2" >
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
								echo CHtml::hiddenField("period", 2);
								foreach($child1->orders as $item):
									?>
									<tr style="color:black">
										<td  style="font-size:24px"><span style="margin-top:50px">งวดที่ 2</span></td>
										<td>
											<?php
											echo "<span style='font-size:24px'> " . $item->orderItems[0]->product->name . "</span> <br>" . $this->getOrderPeriodText(3);
											?>
										</td>
										<td style="font-size:24px">
											<?php
											echo "ยอดชำระ " . number_format($child1->totalIncVAT);
											$sumSup = 0;
											if(count($child1->supPay) > 0):
												?>
												<p style='color:green'>ชำระแล้ว</p>
												<?php
												foreach($child1->supPay as $sup)
												{
													$sumSup +=$sup->totalIncVAT;
													echo "<p style='color:green'>" . number_format($sup->totalIncVAT, 2) . "</p>";
												}
											endif;
											$sumSupNotPay = 0;
											if(count($child1->supNotPays) > 0):
												?>
												<p style='color:red'>รอยืนยันชำระ</p>
												<?php
												foreach($child1->supNotPays as $supNotPay)
												{
													$sumSupNotPay +=$supNotPay->totalIncVAT;
													echo "<p style='color:red'>" . number_format($supNotPay->totalIncVAT, 2) . " " . CHtml::link("ยืนยัน", Yii::app()->createUrl("/myfile/order/view/id/" . $supNotPay->orderGroupId), array(
														'class'=>'btn btn-success',
														'target'=>'_blank')) . "</p>";
												}
											endif;
											?>
										</td>
										<td>
											<?php
											echo CHtml::numberField("payValue", $child1->totalIncVAT - $sumSup - $sumSupNotPay, array(
												'class'=>'input-form text-right',
												'style'=>'border:2px solid black;color:blue;font-size:24px;width:250px',
												'max'=>$child1->totalIncVAT - $sumSup - $sumSupNotPay))
											?>
											<!--<a onclick="backToStep2()" class="btn btn-success">Back</a>-->
											<?php
//											echo CHtml::link("ชำระเงิน", "", array(
//												'class'=>'btn btn-primary',
//												'onclick'=>"pay(2)"));
											?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12">
							กรณีผู้สั่งซื้อ อนุมัติรายการทั้งหมดแล้ว ถือว่าผู้สั่งซื้อยอมรับเงื่อนไขที่เป็นไปตามรายละเอียดในสัญญาและถือเป็นการทำสัญญาซื้อขายกับบริษัทแล้ว
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center" style="font-weight: bold;color: black">
							ข้าพเจ้าได้อ่านและทำความเข้าใจรายละเอียดตามข้อตกลงและเงื่อนไขข้างต้นดีแล้ว<br>
							<?php echo CHtml::radioButton("accept", TRUE) ?>
							<label class="radio-label" for="accept">ยอมรับ</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row hide" id="submit2">
	<div class="col-lg-12 text-center">
		<a onclick="backToStep3()" class="btn btn-success">Back</a>
		<?php
		echo CHtml::link('ยอมรับ และ ชำระเงิน', "", array(
			'class'=>'btn btn-primary',
			'onClick'=>'goToStepSplit(2)'));
		?>
	</div>
</div>
<div class="row hide" id="submit3">
	<div class="col-lg-12 text-center">
		<a onclick="backToStep3()" class="btn btn-success">Back</a>
		<?php
		echo CHtml::link('Accept', "", array(
			'class'=>'btn btn-primary',
			'onClick'=>'goToStepSplit(3)'));
		?>
	</div>
</div>
<div class="row hide" id="submit4">
	<div class="col-lg-12 text-center">
		<a onclick="backToStep3()" class="btn btn-success">Back</a>
		<?php
		echo CHtml::link('Accept', "", array(
			'class'=>'btn btn-primary',
			'onClick'=>'goToStepSplit(4)'));
		?>
	</div>
</div>