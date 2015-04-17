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


<div class="row">
	<!-- Heading -->
	<div class="col-lg-12 col-md-12 col-sm-12">

		<div class="carousel-heading">
			<h4>My Files Atech : Create My File</h4>
			<div class="pull-right">
				<a class="col-lg-6 col-md-6 col-sm-6 glyphicon glyphicon-chevron-left button" onclick="javascript:history.back();"></a>
				<a class="col-lg-6 col-md-6 col-sm-6 glyphicon glyphicon-chevron-right button" onclick="javascript:history.forward();"></a>
			</div>
		</div>

	</div>
	<!-- /Heading -->
</div>
<div class="row" >
	<ul class="nav nav-tabs" role="tablist" >
		<li class="active orange"><a href="<?php echo Yii::app()->request->baseUrl . "/index.php/myfile/atechWindow/"; ?>"><h5 >ไฟล์ของฉัน</h5></a></li>
		<li class="green"><a href="<?php echo Yii::app()->request->baseUrl . "/index.php/myfile/atechWindow/create"; ?>"><h5 >+ สร้างใหม่</h5></a></li>
	</ul>
</div>
<!-- WIZARD -->
<div class="myfile-main">
	<div class="row form-group hidden">
        <div class="col-xs-12">
            <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                <li class="<?php echo $this->action->id == 'create' ? 'active' : ''; ?>"><a href="#step-1">
						<h4 class="list-group-item-heading">Step 1</h4>
						<p class="list-group-item-text">First step description</p>
					</a></li>
                <li><a href="#step-2">
						<h4 class="list-group-item-heading">Step 2</h4>
						<p class="list-group-item-text">Second step description</p>
					</a></li>
				<li class="<?php echo ($this->action->id == 'view' && $model->status == 0) ? 'active' : ''; ?>"><a href="#step-2-1">

						<h4 class="list-group-item-heading">Step 2-1</h4>
						<p class="list-group-item-text">Third step description</p>
					</a></li>
				<li><a href="#step-2-2">
						<h4 class="list-group-item-heading">Step 2-2</h4>
						<p class="list-group-item-text">ใส่ปริมาณเอง</p>
					</a></li>
                <li class="<?php echo ($this->action->id == 'view' && $model->status == 1) ? 'active' : ''; ?>"><a href="#step-3">
						<h4 class="list-group-item-heading">Step _</h4>
						<p class="list-group-item-text">เปรียบเทียบประเมินราคา</p>
					</a></li>

				<li class="<?php echo ($this->action->id == 'view' && $model->status == 2) ? 'active' : ''; ?>"><a href="#step-4">
						<h4 class="list-group-item-heading">Step 4</h4>
						<p class="list-group-item-text">Third step description</p>
					</a></li>
				<li><a href="#step-5">
						<h4 class="list-group-item-heading">Step 5</h4>
						<p class="list-group-item-text">Third step description</p>
					</a></li>
            </ul>
        </div>
	</div>

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
									<h4><b>เพื่อประเมิณ<br>และเปรียบเทียบราคา</b></h4>
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
						<?php // $this->renderPartial('_upload_plan', array('model'=>$model));   ?>

						<div class="row">
							<div class="col-sm-7">

								<div class="form-group">
									แปลนชั้น 1 : <input name="OrderFile[0]" type="file" class="file" data-show-upload="false">
								</div>
								<div class="form-group">
									แปลนชั้น 2 : <input name="OrderFile[1]" type="file" class="file" data-show-upload="false">
								</div>
								<div class="form-group">
									แปลนชั้น 3 : <input name="OrderFile[2]" type="file" class="file" data-show-upload="false">
								</div>
								<div class="form-group">
									แบบขยายประตู-หน้าต่าง 1 : <input name="OrderFile[3]" type="file" class="file" data-show-upload="false">
								</div>
								<div class="form-group">
									แบบขยายประตู-หน้าต่าง 2 : <input name="OrderFile[4]" type="file" class="file" data-show-upload="false">
								</div>
								<div class="form-group">
									แบบขยายประตู-หน้าต่าง 3 : <input name="OrderFile[4]" type="file" class="file" data-show-upload="false">
								</div>
								<div class="form-group">
									แบบขยายประตู-หน้าต่าง 4 : <input name="OrderFile[4]" type="file" class="file" data-show-upload="false">
								</div>
								<div class="form-group">
									แบบขยายประตู-หน้าต่าง 5 : <input name="OrderFile[4]" type="file" class="file" data-show-upload="false">
								</div>
								<div class="form-group">
									แบบขยายประตู-หน้าต่าง 6 : <input name="OrderFile[4]" type="file" class="file" data-show-upload="false">
								</div>
								<div class="form-group">
									แบบขยายประตู-หน้าต่าง 7 : <input name="OrderFile[4]" type="file" class="file" data-show-upload="false">
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
			<div class="carousel-heading no-margin">
				<b><h4>รอ Call Center ประเมิณราคา</h4></b>
			</div>
            <div class="col-md-12 well">

				<div class="row text-center">
					<div style="margin-top: 2%">
						<?php $i = 0; ?>
						<?php // throw new Exception(print_r($model->orderFiles,true)); ?>
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

			</div>
		</div>
	</div>

	<?php $this->endWidget(); ?>


	<div class="row setup-content" id="step-2-2">
		<div class="col-xs-12">
            <div class="col-md-12 well">
				<div class="row pull-right">

					<!--<button id="addItemButton" class="btn btn-block btn-info">เพิ่มสินค้า</button>-->
					<?php
					echo CHtml::button('เพิ่มสินค้า', array(
						'class'=>'btn btn-info',
						'id'=>'addProductCriteriaAtech',
						'ajax'=>array(
							'type'=>'POST',
							'url'=>CController::createUrl('atechWindow/addNewProductItem'),
							'dataType'=>'html',
							'data'=>array(
								"rows"=>"js:document.getElementById('criteriaTableAtech').rows.length"),
							'success'=>'js:function(data){
					//alert("YESS");
					$("#criteriaTableAtech").append(data);
				}',
						),
					));
					?>
				</div>
				<div class="row">
					<div class="page-header myfile-fenzer-header" >
						<h3>STEP.2 ใส่ปริมาณเอง</h3><small>กรุณาเลือกแบบหน้าต่างและกำหนดปริมาณที่ต้องการ.</small>
					</div>
				</div>
				<div class="row text-center">
					<form id="aa">
						<table id="criteriaTableAtech" class="table table-hover edit-table" style="background-color: #DDD" name="<?php // echo $productResult['categoryId'];                                  ?>">
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
								<?php // foreach($productResult['items'] as $item): ?>
								<?php
								$categoryDropDownArray = Category::model()->findAllParentCategoryArray(2);
								$sizeDropDownArray = Product::model()->findAllAtechSizeArray();
								?>
								<tr>
									<td>1</td>
									<td class="cat"><?php
										echo CHtml::dropDownList('Criteria[0][category]', "category", $categoryDropDownArray, array(
											'class'=>'form-control',
											'prompt'=>'เลือกประเภท',
											'onchange'=>'findType(this)'));
										?></td>
									<td class="type"><?php
										// echo CHtml::dropDownList('Criteria[0][type]', "type", $typeDropDownArray);
										echo CHtml::dropDownList('Criteria[0][type]', "type", array(), array(
											'prompt'=>'เลือกรูปแบบ',
											'class'=>'form-control',
											'onchange'=>'findSize(this);',
											'id'=>'type',
										));
										?></td>
									<td class="size"><?php
										// echo CHtml::dropDownList('Criteria[0][size]', "size", $sizeDropDownArray);
										echo CHtml::dropDownList('Criteria[0][size]', "size", array(), array(
											'prompt'=>'เลือกขนาด',
											'class'=>'form-control',
											'id'=>'"size"',
										));
										?></td>
									<td><?php
										echo CHtml::textField('Criteria[0][quantity]', 1, array(
											'class'=>'edit-table-qty-input'));
										?></td>
									<td><button id="deleteRow" class="btn btn-danger">remove</button></td>
								</tr>
								<tr>
									<td>2</td>
									<td class="cat"><?php
										echo CHtml::dropDownList('Criteria[1][category]', "category", $categoryDropDownArray, array(
											'class'=>'form-control',
											'prompt'=>'เลือกประเภท',
											'onchange'=>'findType(this)'));
										?></td>
									<td class="type"><?php
										// echo CHtml::dropDownList('Criteria[0][type]', "type", $typeDropDownArray);
										echo CHtml::dropDownList('Criteria[1][type]', "type", array(), array(
											'prompt'=>'เลือกรูปแบบ',
											'class'=>'form-control',
											'onchange'=>'findSize(this);',
//										'id'=>'type',
										));
										?></td>
									<td class="size"><?php
										// echo CHtml::dropDownList('Criteria[0][size]', "size", $sizeDropDownArray);
										echo CHtml::dropDownList('Criteria[1][size]', "size", array(), array(
											'prompt'=>'เลือกขนาด',
											'class'=>'form-control',
//										'id'=>'"size"',
										));
										?></td>
									<td><?php
										echo CHtml::textField('Criteria[1][quantity]', 1, array(
											'class'=>'edit-table-qty-input'));
										?></td>
									<td><button id="deleteRow" class="btn btn-danger">remove</button></td>
								</tr>
					<!--			<tr>
									<td>2</td>
									<td><?php // echo CHtml::dropDownList('Criteria[1][category]', "category", $categoryDropDownArray);                                  ?></td>
									<td><?php // echo CHtml::dropDownList('Criteria[1][type]', "type", $typeDropDownArray);                                  ?></td>
									<td><?php // echo CHtml::dropDownList('Criteria[1][size]', "size", $sizeDropDownArray);                                  ?></td>
									<td><?php // echo CHtml::textField('Criteria[1][quantity]', 1,array('class'=>'edit-table-qty-input'));                                  ?></td>
									<td><button id="deleteRow" class="btn btn-danger">remove</button></td>
								</tr>-->

							</tbody>
						</table>
					</form>
				</div>

				<div class="row wizard-control">

					<div class="pull-left">
						<a id="backToStep1" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-chevron-left"></i>ย้อนกลับ</a>
					</div>
					<div class="pull-right">
						<a id="nextToStep3Atech" class="btn btn-primary btn-lg">ต่อไป <i class="glyphicon glyphicon-chevron-right"></i> </a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row setup-content" id="step-3">
		<div class="col-xs-12">

            <div class="col-md-12 well">
				<div class="row sidebar-box" id="confirm_content">
					<div class="col-xs-12">
						<div class="sidebar-box-heading">
							<i class="fa fa-list"></i>
							<h4>ยืนยันรายการสินค้า <?php echo $model->title; ?></h4>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="row sidebar-box blue" style="margin-top: 55px;">
									<div class="col-sm-12">
										<div class="sidebar-box-heading">
											<i class="fa fa-apple"></i>
											<h4>Brand</h4>
										</div>
										<div class="sidebar-box-content">
											<ul>
												<?php foreach($modelArray as $item): ?>
													<li>
														<a class="<?php echo $this->action->id == 'view' ? 'atechUpdate' : ($this->action->id == 'create' ? 'atechNav' : 'atechUpdate'); ?>" href="#" name="<?php echo $item->brandModelId; ?>" >
															<?php echo $item->title; ?>
														</a>
													</li>
												<?php endforeach; ?>
											</ul>
										</div>
									</div>
								</div>
								<!--						<div class="btn-group-vertical" style="margin-top: 50px">

															<button name="<?php // echo $item->brandModelId;                                ?>" type="button" style="width: 200px" class="btn btn-default brandModelButton"><?php // echo $item->title;                                ?></button>

													</div>-->
							</div>
							<div class="col-md-9">
								<div class="row" id="atech_result" >
									<?php
									if(isset($productResult))
									{

										$this->renderPartial('_edit_product_result', array(
											'productResult'=>$productResult));
									}
//							throw new Exception(print_r($productResult,true));
									?>
								</div>
							</div>
						</div>
						<div class="row wizard-control">
							<?php
							if($this->action->id == 'create')
							{
								?>
								<div class="pull-left">
									<a id="backToStep2-2" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-chevron-left"></i> ย้อนกลับ</a>
								</div>
							<?php } ?>
							<div class="pull-right">
								<a id="nextToStep4Atech" name="<?php echo $this->action->id == 'create' ? "" : $model->orderId; ?>" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-chevron-right"></i> ต่อไป</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row setup-content" id="step-4">
		<div class="col-xs-12">
			<div class="col-md-12 well">
				<div class="row sidebar-box" >
					<div class="col-xs-12">
						<div class="sidebar-box-heading">
							<i class="fa fa-list"></i>
							<h4>ยืนยันรายการสินค้า <?php echo $model->title; ?></h4>
						</div>
						<div class="row sidebar-box-content" id="confirm_product">
							<?php if(isset($productResult)): ?>
								<?php
								if($model->status != 0)
									$this->renderPartial('/atechWindow/_confirm_product', array(
										'productResult'=>$productResult,
										), false, TRUE);
								?>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="row wizard-control">
					<div class="pull-right">
						<?php if(!$model->isRequestSpacialProject): ?>
							<a id="backToStep3" class="btn btn-primary btn-lg" ><i class="glyphicon glyphicon-chevron-left"></i> ย้อนกลับ</a>
						<?php endif; ?>
						<a id="finishAtech" class="btn btn-success btn-lg" href="<?php echo ($this->action->id == 'create') ? Yii::app()->createUrl("/myfile/atechWindow/") : Yii::app()->createUrl("/myfile/atechWindow/finish/id/$model->orderId") ?>"><i class="glyphicon glyphicon-ok"></i> เสร็จสิ้น</a>
						<?php if($model->type < 3): ?>
							<a id="addToCartAtech" class="btn btn-warning btn-lg" href="<?php echo ($this->action->id == 'create') ? "#" : Yii::app()->createUrl("/myfile/atechWindow/addToCartNow/id/$model->orderId") ?>"><i class="glyphicon glyphicon-shopping-cart"></i> ใส่ตระกร้า</a>
						<?php endif; ?>
						<a id="" class="btn btn-danger btn-lg" href="<?php echo Yii::app()->createUrl("/myfile/atechWindow/duplicateMyfile/id/$model->orderId") ?>"><i class="glyphicon glyphicon-plus"></i> สร้างสำเนา</a>
						<?php if(!$model->isRequestSpacialProject): ?>
							<?php if(Yii::app()->user->userType == 2): ?>
								<a id="requestSpecial" class="btn btn-info btn-lg" href="<?php echo Yii::app()->createUrl("/myfile/atechWindow/requestSpacialProject/id/$model->orderId") ?>"><i class="glyphicon glyphicon-share"></i> Request Special Project</a>
							<?php endif; ?>
						<?php else: ?>
							<?php if($model->userSpacialProject[0]->status == 1): ?>
								<span class="btn btn-danger btn-xs">Sending Request Spacial Project</span>
							<?php elseif($model->userSpacialProject[0]->status == 2): ?>
								<span class="btn btn-success btn-xs">อนุมัติคำขอ Spacial Project</span>
							<?php elseif($model->userSpacialProject[0]->status == 3): ?>
								<a id="requestSpecial" class="btn btn-danger btn-lg" href="<?php echo Yii::app()->createUrl("/myfile/atechWindow/requestSpacialProject/id/$model->orderId") ?>"> ไม่อนุมัติคำขอ Spacial Project -<i class="glyphicon glyphicon-share"></i> Request อีกครั้ง</a>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function findSize(sel)
	{
		var attrName = sel.attributes['name'].value;
		var obj = $('select[name=\"' + attrName + '\"]');
		var cat2 = obj.val();

		$.ajax({
			'url': '<?php echo CController::createUrl('atechWindow/findAllSizeByCate2Id'); ?>',
//			'dataType': 'json',
			'type': 'POST',
			'data': {'cat2': cat2},
			'success': function(data) {
				obj.parent().parent().children('.size').children('select').html(data);
//				findProductByCat1(sel);
			},
		});
	}
	function findType(sel)
	{
		var attrName = sel.attributes['name'].value;
		var obj = $('select[name=\"' + attrName + '\"]');
		var cat1Id = obj.val();

		$.ajax({
			'url': '<?php echo CController::createUrl('atechWindow/findAllCat2ByCat1Id'); ?>',
//			'dataType': 'json',
			'type': 'POST',
			'data': {'cat1Id': cat1Id},
			'success': function(data) {
				obj.parent().parent().children('.type').children('select').html(data);
//				findProductByCat1(sel);
			},
		});
	}
</script>

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

<?php // echo $form->errorSummary($model);         ?>

	<div class="row">
<?php // echo $form->labelEx($model, 'supplierId');      ?>
<?php // echo $form->textField($model, 'supplierId');      ?>
<?php // echo $form->error($model, 'supplierId');         ?>
	</div>

	<div class="row">
<?php // echo $form->labelEx($model, 'type');      ?>
<?php // echo $form->textField($model, 'type');      ?>
<?php // echo $form->error($model, 'type');         ?>
	</div>

	<div class="row">
<?php // echo $form->labelEx($model, 'status');       ?>
<?php // echo $form->textField($model, 'status');      ?>
<?php // echo $form->error($model, 'status');          ?>
	</div>

	<div class="row">
<?php // echo $form->labelEx($model, 'title');      ?>
<?php // echo $form->textField($model, 'title');       ?>
<?php // echo $form->error($model, 'title');           ?>
	</div>


	<div class="row buttons">
<?php // echo CHtml::submitButton('Submit');             ?>
	</div>

<?php // $this->endWidget();            ?>

</div>-->
<!-- form -->

