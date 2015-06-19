<h2 class="blue text-center" id="myModalLabel">ข้อตกลงและเงื่อนไข ตรวจรับงานงวดที่ 1</h2>
<div class="col-md-12">
	<!--						<div class="sidebar-box-heading">
								<i class="fa fa-tdst"></i>
								<h4>ข้อตกลงและเงื่อนไข <?php // echo $model->title;                                                                                                                                                                                                                                                                                                                                                    ?></h4>
							</div>-->
	<div class="row sidebox-content ">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-11">
					1. เนื่องจากบางบริษัทได้เข้าดำเนินการสำรวจผังตามใบสั่งซื้อของลูกค้าไปแล้วนั้น ทางบริษัทเห็นว่า สามารถเข้าดำเนินการก่อสร้างขั้นตอไปได้<br>
					ผู้สั่งซื้อกรุณาตรวจสอบรายละเอียดตามรายการด้านล่าง
					<table class="table table-bordered table-condensed ">
						<tr>
							<td style="width:50%">Layout Approve </td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
						</tr>
						<tr>
							<td>ผลสำรวจ</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
						</tr>
						<tr>
							<td>ใบรับงานสำรวจ</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="row">
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
			</div>
			<div class="row">
				<div class="col-md-12" >
					<div class="row">
						<div class="col-md-12">
							3. ก่อนสั่งซื้องวดต่อไป ลูกค้าสามารถปรับเปลี่ยนรายละเอียดบ้านได้โดย
						</div>
					</div>
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td>3.1</td>
								<td>สามารถปรับเปลี่ยน Series ของบ้านจาก Light / C / E / SL ได้ โดยคิดมูลค่าตามจริงของบ้านหลังนั้นๆ</td>
							</tr>
							<tr>
								<td>3.2</td>
								<td>สามารถปรับเปลี่ยนสีของบ้าน Silver / Oak Brown / Earth Tone ได้โดยไม่เสียค่าใช้จ่ายเพิ่ม</td>
							</tr>
							<tr>
								<td>3.3</td>
								<td>สามารถปรับเปลี่ยน Size ของบ้านได้ โดยคิดมูลค่าตามจริงของบ้านหลังนั้นๆ</td>
							</tr>
							<tr>
								<td colspan="2" style="color:red">ซึ่งหลังจากนี้แล้วทางบริษัทฯจะเข้าดำเนินการก่อสร้างตามรายละเอียดที่ลูกค้ายืนยัน ลูกค้าจะไม่สามารถปรับเปลี่ยนใดๆ ได้อีก</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					รายละเอียดบ้านตามที่ลูกค้าเลือกปัจจุบัน
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td>ชนิดบ้าน</td>
								<td><?php
									$category2ToProduct = Category2ToProduct::model()->find("productId = " . $model->orders[0]->orderItems[0]->productId);
									echo CHtml::dropDownList("brandModelId", $category2ToProduct->brandModelId, CHtml::listData($brandModels, "brandModelId", "title"), array(
										'prompt'=>'-- เลือกแบบบ้าน --',
										'id'=>'brandModelId',
										'ajax'=>array(
											'type'=>'POST',
											'data'=>array(
												'brandModelId'=>'js:this.value'),
											'url'=>$this->createUrl('/myfile/ginzaHome/findStyle'),
											'success'=>'js:function(data){

										//$("#sameAddress").prop("disabled", true);
										$("#styleId").html(data);
										//$("#billingAmphur").prop("disabled", false);
										//$("#billingDistrict").html("");
										//$("#billingDistrict").prop("disabled", true);
										 }'))
									);
									?></td>
							</tr>
							<tr>
								<td>รูปแบบ</td>
								<td><?php
									echo CHtml::dropDownList("categoryId", $model->orders[0]->orderItems[0]->styleId, ModelToCategory1::model()->findAllCatArrayFromBrandModelId($category2ToProduct->brandModelId), array(
										'prompt'=>'-- เลือกแบบบ้าน --',
										'id'=>'styleId'
										,
										'ajax'=>array(
											'type'=>'POST',
											'data'=>array(
												'categoryId'=>'js:this.value',
												'brandModelId'=>'js:$("#brandModelId").val()'),
											'url'=>$this->createUrl('/myfile/ginzaHome/findHouseModel'),
											'success'=>'js:function(data){

										//$("#sameAddress").prop("disabled", true);
										$("#categoryId").html(data);
										//$("#billingAmphur").prop("disabled", false);
										//$("#billingDistrict").html("");
										//$("#billingDistrict").prop("disabled", true);
										 }')
									));
									?></td>
							</tr>
							<tr>
								<td>แบบบ้าน</td>
								<td><?php
									echo CHtml::dropDownList("category2Id", $category2ToProduct->category1Id, CategoryToSub::model()->findSubCatArrayByBrandModelIdAndCategoryId($category2ToProduct->brandModelId, $model->orders[0]->orderItems[0]->styleId), array(
										'prompt'=>'-- เลือกแบบบ้าน --'));
									?></td>
							</tr>
							<tr>
								<td>ซีรีส์</td>
								<td>
									<?php
									echo CHtml::dropDownList("category2Id", $category2ToProduct->category2Id, CategoryToSub::model()->findSubCatArrayByBrandModelIdAndCategoryId($category2ToProduct->brandModelId, $category2ToProduct->category1Id), array(
										'prompt'=>'-- เลือกแบบบ้าน --'));
									?>
								</td>
							</tr>
							<tr>
								<td>สี</td>
								<td><?php
									echo CHtml::dropDownList("productOptionId", $model->orders[0]->orderItems[0]->orderItemOptions[0]->productOptionId, CHtml::listData($model->orders[0]->orderItems[0]->product->productOptionGroups[0]->productOptions, "productOptionId", "title"), array(
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
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					4. กรณีผู้สั่งซื้อ อนุมัติรายการทั้งหมดแล้ว ถือว่าผู้สั่งซื้อยอมรับเงื่อนไขที่เป็นไปตามรายละเอียดในสัญญาและถือเป็นการทำสัญญาซื้อขายกับบริษัทแล้ว
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
<div class="col-lg-12 text-center">
	<?php
	echo CHtml::ajaxButton('Accept', Yii::app()->createUrl('selectProvince/saveProvince'), array(
		'type'=>'POST',
		'dataType'=>'json',
		'success'=>'js:function(data){
							$("#condition' . $period . 'Modal").modal("hide");
							$("#payForm' . $period . '").submit();
						}'
		), array(
		'class'=>'btn btn-primary'));
//	echo CHtml::ajaxButton('Reject', Yii::app()->createUrl('selectProvince/saveProvince'), array(
//		'type'=>'POST',
//		'dataType'=>'json',
//		'success'=>'js:function(data){
//							$("#condition' . $period . 'Modal").modal("hide");
//						}'
//		), array(
//		'class'=>'btn btn-danger'));
	?>
</div>