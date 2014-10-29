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
	<!--STEP 1 Select Province-->
    <div class="row setup-content" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12 well">
				<div class="row">
					<div class="col-md-4">
						<div class="page-header select-province">
							<h1>สร้าง My File</h1><small> กรุณากรอกข้อมูลตามด้านล่าง.</small>
						</div>
						<div class="form-group">
							<div class="col-sm-10">
								<?php
								echo $form->textField($model, 'title', array(
									'size'=>20,
									'maxlength'=>20,
									'class'=>'form-control',
									'placeholder'=>'กรุณากรอกชื่อ My File.'));
								?>
								<?php echo $form->error($model, 'title'); ?>
							</div>
						</div>
						<!--						<div>
						<?php
//							echo CHtml::textField('title', $model->title, array(
//								'class'=>'form-control',
//								'id'=>'myfile_title',
//								'placeholder'=>'กรุณากรอกชื่อ My File.'
//							));
						?>
												</div>-->
						<div style="margin-top: 15px">
							<?php
							echo CHtml::dropDownList('Order[provinceId]', $model->provinceId, CHtml::listData(Province::model()->findAll(), 'provinceId', 'provinceName'), array(
								'class'=>'form-control',
								'id'=>'selectProvince',
								'prompt'=>'--กรุณาเลือกจังหวัด--',
							));
							?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="page-header select-province">
						<h4>Step 1</h4>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4 col-sm-offset-1 text-center">
						<a id="uploadPlanAtech">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h2><b>อัพโหลดแบบดีไซน์</b></h2>
								</div>
								<div class="panel-body">
									<h4><b>เพื่อส่ง Call Center <br>ประเมิณพื้นที่</b></h4>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-4 col-sm-offset-1 text-center">
						<a id="manualQuantityAtech">
							<div class="panel panel-warning" >
								<div class="panel-heading" style="background-color: #F65D20;color: white">
									<h2><b>ใส่ปริมาณพื้นที่</b></h2>
								</div>
								<div class="panel-body">
									<h4><b>เพื่อประเมิณราคากระเบื้อง<br>และเปรียบเทียบราคา</b></h4>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="row wizard-control">
					<div class="pull-right">
						<button id="nextToStep2" class="btn btn-primary btn-lg hidden"> ต่อไป <i class="glyphicon glyphicon-chevron-right"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--STEP 2 upload plan-->
	<div class="row setup-content" id="step-2">
		<div class="col-xs-12">
            <div class="col-md-12 well text-left">
				<div class="row">
					<div class="page-header myfile-fenzer-header" >
						<h1>อัพโหลดแบบแปลน</h1><small> กรุณาอัพโหลดแบบแปลนที่ต้องการให้ประเมินราคา.</small>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12" id="upload_plan">
						<?php // $this->renderPartial('_upload_plan', array('model'=>$model));      ?>

						<div class="row">
							<div class="col-sm-7">

								<div class="form-group">
									รูปแปลน : <input name="OrderFile[0]" type="file" class="file" data-show-upload="false">
								</div>
								<div class="form-group">
									รูปด้าน 1 : <input name="OrderFile[1]" type="file" class="file" data-show-upload="false">
								</div>
								<div class="form-group">
									รูปด้าน 2 : <input name="OrderFile[2]" type="file" class="file" data-show-upload="false">
								</div>
								<div class="form-group">
									รูปด้าน 3 : <input name="OrderFile[3]" type="file" class="file" data-show-upload="false">
								</div>
								<div class="form-group">
									รูปด้าน 4 : <input name="OrderFile[4]" type="file" class="file" data-show-upload="false">
								</div>

								<?php ?>
							</div>
							<div class="col-sm-5">
								<div class="panel panel-info">
									<div class="panel-heading text-left">
										<h4><b><i class="glyphicon glyphicon-exclamation-sign"></i> หมายเหตุ</b></h4>
									</div>
									<div class="panel-body">
										<small><b>1.หลังจากลูกค้าอัพโหลดแบบ รอ 3 วันทำการ เพื่อทำการประเมินราคา <br>
												2.ขนาดที่ลูกค้าได้รับจากการประเมินราคาใน www.daiibuy.com จะเป็นขนาดมาตรฐานจากโรงงานเท่านั้น โดยจะมีการปรับขนาดหน้าต่าง ให้ใกล้เคียงกับขนาดมารฐาน<br>
												3.หากลูกค้าต้องการสั่งซื้อขนาดอื่นๆ นอกเหนือจากขนาดมารฐาน<br>
												โปรดติดต่อบริษัท ไดอิ กรุ๊ป จำกัด มหาชน โทร. 02-9383464</b></small>
									</div>
								</div>
							</div>
						</div>
						<?php foreach($orderDetailTemplateField as $field): ?>
							<div class="row">
								<div class="col-lg-1 control-label">
									<?php echo $field->description; ?>
								</div>
								<div class="col-lg-9l">
									<?php
									echo CHtml::textArea("OrderDetailValue[$field->orderDetailTemplateFieldId][value]", "", array(
										'class'=>'form-control',
										'rows'=>5))
									?>
								</div>
							</div>
						<?php endforeach; ?>
						<div class="row wizard-control">

							<?php
							echo CHtml::submitButton('Create', array(
								'class'=>'btn btn-primary'));
							?>
						</div>
					</div>
				</div>
				<!--				<div class="row wizard-control">-->
				<!--					<div class="pull-right">
									<button id="commitUpload" class="btn btn-success btn-lg"><i class="glyphicon glyphicon-ok"></i> ส่งข้อมูล</button>
									</div>-->
				<!--					<div class="pull-left">
										<button id="backToStep1" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-chevron-left"></i> ย้อนกลับ</button>
									</div>
									<div class="pull-right">
										<button id="nextToStep3" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-chevron-right"></i> ต่อไป</button>
									</div>-->
				<!--</div>-->
			</div>
		</div>
	</div>
	<div class="row setup-content" id="step-2-1">
		<div class="col-xs-12">
            <div class="col-md-12 well">
				<div class="row">
					<div class="page-header myfile-fenzer-header" >
						<h3>รอ Call Center ประเมินราคา</h3>
					</div>
				</div>
				<div class="row text-center">
					<div style="margin-top: 2%">
						<?php $i = 0; ?>
						<?php foreach($model->orderFiles as $orderFile): ?>
							<div class='col-lg-6 col-md-6 col-sm-12'>
								<div class="blog-item">
									<?php
									echo CHtml::image(Yii::app()->baseUrl . $orderFile->filePath, '', array(
										'style'=>'width:300px;height:300px'));
									?>
									<div class="blue button center-block" style="text-align: center;background-clip: border-box;color: white;width:300px;"><?php echo $i == 0 ? "แบบแปลน" : "ด้านข้าง " . $i; ?></div>
								</div>
							</div>
							<?php $i++; ?>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="row">

					<?php foreach($orderDetailTemplateField as $field): ?>
						<div class="col-lg-1 control-label"><?php echo $field->description; ?></div>
						<div class="col-lg-11">
							<?php
							if(isset($model->orderId)):
								$orderDetailId = OrderDetail::model()->find("orderId = :orderId", array(
										":orderId"=>$model->orderId))->orderDetailId;
								$fieldValue = OrderDetailValue::model()->find("orderDetailId = :orderDetailId AND orderDetailTemplateFieldId = :orderDetailTemplateFieldId", array(
									":orderDetailId"=>$orderDetailId,
									":orderDetailTemplateFieldId"=>$field->orderDetailTemplateFieldId));
								echo $fieldValue->value;
							endif;
							?>
						</div>
					<?php endforeach; ?>

				</div>

			</div>
		</div>
	</div>

	<div class="row setup-content" id="step-2-2">
		<div class="col-xs-12">
            <div class="col-md-12 well">
				<div class="row">
					<div class="page-header myfile-fenzer-header" >
						<h3>STEP.2 ใส่ปริมาณเอง</h3><small>กรุณาเลือกแบบหน้าต่างและกำหนดปริมาณที่ต้องการ.</small>
					</div>
				</div>
				<div class="row text-center">
					<form id="atechTableForm">
						<table id="editTable" class="table table-hover edit-table" style="background-color: #67ae73" name="<?php // echo $productResult['categoryId'];                                                                                                                                                                                              ?>">
							<thead>
								<tr>ตารางแสดงรายละเอียดสินค้า</tr>
								<tr>
									<th>ลำดับ</th>
									<th>ประเภท</th>
									<th>รูปแบบ</th>
									<th>ขนาด</th>
									<th class="edit-table-qty" >จำนวน</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody >
								<?php // foreach($productResult['items'] as $item):            ?>
								<tr>
									<td>1</td>
									<td><?php
										echo CHtml::dropDownList('Criteria[category]', "category", array(
											1=>'ประตู',
											2=>'หน้าต่าง'));
										?></td>
									<td><?php
										echo CHtml::dropDownList('Criteria[type]', "type", array(
											1=>'บานเลื่อน 2 บาน',
											2=>'บานเลื่อน 4 บาน',
											3=>'บานเปิดเดี่ยว',
											4=>'บานเปิดคู่',
											5=>'บานกระทุ้ง',
											6=>'บานส่องแสง'));
										?></td>
									<td><?php echo CHtml::dropDownList('Criteria[size]', "size", Product::model()->findAllAtechSizeArray()); ?></td>
									<td><?php
										echo CHtml::textField('Criteria[quantity]', "quantity", array(
											'class'=>'edit-table-qty-input'));
										?></td>
									<td><button id="deleteRow" class="btn btn-danger">remove</button></td>
								</tr>

								<?php // endforeach;          ?>

<!--			<tr>
				<td><?php
								// echo CHtml::dropDownList('productId', 'selectedCode',
//					CHtml::listData(Product::model()->findAll('supplierId ='. 176 .' AND Status = 1'), 'productId', 'code'),
//					array('id'=>'itemCode',
//						'prompt'=>'เลือกรหัส',
//						'ajax'=>array(
//									'type'=>'POST',
//									'url'=>CController::createUrl('fenzer/addNewProductItem'), //url to call.
////									'update'=>'#height_content', //selector to update
//									'dataType'=>'html',
//									'data'=>array(
//										"productId"=>"js:this.value",
//										"categoryId"=>$productResult['categoryId']),
//										"length"=>0,
//									'success'=>'js:function(data){
//										alert("Yo");
//										$("#result_content").html(data);
//									}',
//								),
//					));
								?></td>
				<td><?php // echo '';                                                                                                                                                                                              ?></td>
				<td><?php // echo '';                                                                                                                                                                                             ?></td>
				<td><?php // echo CHtml::textField('quantity', '',array('id'=>'qty','style'=>'width:100px;text-align:Right;'));                                                                                                                                                                                              ?></td>
				<td><?php // echo '';                                                                                                                                                                                             ?></td>
				<td><?php // echo '';                                                                                                                                                                                             ?></td>
				<td><?php // echo '';                                                                                                                                                                                             ?></td>
			</tr>-->
							</tbody>
						</table>
					</form>
					<!--					<div style="margin-top: 2%">
					<?php // $i = 0;      ?>
					<?php // foreach($model->orderFiles as $orderFile):           ?>
										<div class='col-lg-6 col-md-6 col-sm-12'>
										<div class="blog-item">
					<?php // echo CHtml::image(Yii::app()->baseUrl.$orderFile->filePath, '', array('style'=>'width:300px;height:300px'));            ?>
											<div class="blue button center-block" style="text-align: center;background-clip: border-box;color: white;width:300px;"><?php // echo $i==0? "แบบแปลน":"ด้านข้าง ".$i;                                                                                                                                                                                              ?></div>
									</div>
								</div>
					<?php // $i++;       ?>
					<?php // endforeach;           ?>
						</div>-->
				</div>
			</div>
		</div>
	</div>

	<div class="row setup-content" id="step-3">
		<div class="col-xs-3">
			<?php
			$favs = UserFavourite::model()->findAllThemeByUserId(Yii::app()->user->id);
			?>
			<div class="row sidebar-box red ">
				<div class="col-sm-12">
					<div class="sidebar-box-heading">
						<i class="fa fa-heart"></i>
						<h4>Favourite Theme</h4>
					</div>
					<div class="sidebar-box-content">
						<ul>
							<?php foreach($favs as $fav): ?>
								<li><a href=""><?php echo $fav->category2->title; ?></li></a>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-9">
			<div class="row sidebar-box blue ">
				<div class="col-md-12">
					<h3>ตารางประเมินราคา <?php echo $model->title; ?></h3>
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
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
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									foreach($model->orderItems as $item):
										?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $item->groupName . "." ?></td>
											<td style="text-align: center"><?php echo $item->area; ?></td>
											<td>ตร.เมตร</td>
											<td class="text-info" id="productCode"></td>
											<td id="productDescription"></td>
											<td id="productUnit"></td>
											<?php // $squareMeterQuantiry = 1 / (($item->product->width * $item->product->height) / 10000);   ?>
											<?php // $estimateAreaQuantity = $item->area * $squareMeterQuantiry; ?>
											<?php // $price = $estimateAreaQuantity * $item->product->price;     ?>
											<td style="text-align: center" id="squareMeterQuantity"></td>
											<td style="text-align: center" id="estimateAreaQuantity"></td>
											<td id="quantity"></td>
											<td id="price<?php echo $item->orderItemsId ?>"></td>
										</tr>
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
			<div class="row">
				<div class="col-md-12 well wizard-control">
					<button id="calculatePrice" class="btn btn-warning btn-lg col-lg-offset-3"><i class="glyphicon glyphicon-refresh"></i> อัพเดทราคา</button>
					<button id="nextToStep4" class="btn btn-primary btn-lg pull-right"><i class="glyphicon glyphicon-chevron-right"></i> ต่อไป</button>
				</div>
			</div>
		</div>
	</div>

	<div class="row setup-content" id="step-4">
		<div class="col-xs-12">
			<div class="col-md-12 well text-center">
				<div class="row" id="confirm_content"></div>
				<div class="row wizard-control">
					<div class="pull-right">

						<button id="backToStep3" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-chevron-left"></i> ย้อนกลับ</button>
						<button id="finishAtech" class="btn btn-success btn-lg"><i class="glyphicon glyphicon-ok"></i> เสร็จสิ้น</button>
						<button id="addToCart" class="btn btn-warning btn-lg"><i class="glyphicon glyphicon-shopping-cart"></i> ใส่ตระกร้า</button>
						<button id="requestSpecial" class="btn btn-info btn-lg"><i class="glyphicon glyphicon-share"></i> Request Special Project</button>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>



<!--********old code-->
<!--<div class="form">

<?php
//	$form = $this->beginWidget('CActiveForm', array(
//		'id'=>'order-create-form',
// Please note: When you enable ajax validation, make sure the corresponding
// controller action is handling ajax validation correctly.
// See class documentation of CActiveForm for details on this,
// you need to use the performAjaxValidation()-method described there.
//		'enableAjaxValidation'=>false,
//	));
?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php // echo $form->errorSummary($model);                            ?>

	<div class="row">
<?php // echo $form->labelEx($model, 'supplierId');        ?>
<?php // echo $form->textField($model, 'supplierId');         ?>
<?php // echo $form->error($model, 'supplierId');                            ?>
	</div>

	<div class="row">
<?php // echo $form->labelEx($model, 'type');         ?>
<?php // echo $form->textField($model, 'type');         ?>
<?php // echo $form->error($model, 'type');                            ?>
	</div>

	<div class="row">
<?php // echo $form->labelEx($model, 'status');         ?>
<?php // echo $form->textField($model, 'status');        ?>
<?php // echo $form->error($model, 'status');                            ?>
	</div>

	<div class="row">
<?php // echo $form->labelEx($model, 'title');        ?>
<?php // echo $form->textField($model, 'title');       ?>
<?php // echo $form->error($model, 'title');                            ?>
	</div>


	<div class="row buttons">
<?php // echo CHtml::submitButton('Submit');                              ?>
	</div>

<?php // $this->endWidget();                               ?>

</div>-->
<!-- form -->

<?php $this->endWidget(); ?>
