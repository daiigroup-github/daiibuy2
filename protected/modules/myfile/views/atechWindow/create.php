<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
$this->breadcrumbs = array(
	$this->module->id,
);
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
                <li class="active"><a href="#step-1">
						<h4 class="list-group-item-heading">Step 1</h4>
						<p class="list-group-item-text">First step description</p>
					</a></li>
                <li><a href="#step-2">
						<h4 class="list-group-item-heading">Step 2</h4>
						<p class="list-group-item-text">Second step description</p>
					</a></li>
                <li><a href="#step-3">
						<h4 class="list-group-item-heading">Step 3</h4>
						<p class="list-group-item-text">Third step description</p>
					</a></li>
				<li><a href="#step-5">
						<h4 class="list-group-item-heading">Step 4</h4>
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
							<h1>เลือกจังหวัด</h1><small> กรุณาเลือกจังหวัดที่ท่านต้องการสั่งซื้อสินค้า.</small>
						</div>
						<div>
							<?php
							echo CHtml::dropDownList('provinceId', $model->provinceId, CHtml::listData(Province::model()->findAll(), 'provinceId', 'provinceName'), array(
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
					<div class="col-md-6 text-center">
						<a>
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3><b>อัพโหลดแบบดีไซน์</b></h3>
								</div>
								<div class="panel-body">
									<h4><b>เพื่อส่ง Call Center ประเมิณจำนวนและเทียบราคา</b></h4>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-6 text-center">
						<a>
							<div class="panel panel-warning">
								<div class="panel-heading">
									<h3><b>ใส่ปริมาณเอง</b></h3>
								</div>
								<div class="panel-body">
									<h4><b>เพื่อเปรียบเทียบราคา</b></h4>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="row wizard-control">
					<div class="pull-right">
						<button id="nextToStep2" class="btn btn-primary btn-lg">ต่อไป</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--STEP 2 Select Height-->
	<div class="row setup-content" id="step-2">
		<div class="col-xs-12">
            <div class="col-md-12 well text-left">
				<div class="row">
					<div class="page-header myfile-fenzer-header" >
						<h1>เลือกความสูง(เมตร)</h1><small> กรุณาเลือกช่วงความสูงของรั้วที่ท่านต้องการ.</small>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div>
							<?php
							echo CHtml::dropDownList("OrderDetailValue[height]", '', $heightArray, array(
								'class'=>'form-control',
								'id'=>'selectHeight',
								'prompt'=>'--กรุณาเลือกความสูง--',
								'ajax'=>array(
									'type'=>'POST',
									'url'=>CController::createUrl('fenzer/showFenzerProductResultByHeight'), //url to call.
//									'update'=>'#height_content', //selector to update
									'dataType'=>'html',
									'data'=>array(
										"height"=>"js:this.value"),
									'success'=>'js:function(data){
										$("#height_content").html(data);
									}',
								),
							));
							?>
						</div>
					</div>
					<div class="col-md-9" id="height_content">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12" id="select_content">
					</div>
				</div>
				<div class="row wizard-control">
					<div class="pull-left">
						<button id="backToStep1" class="btn btn-primary btn-lg">ย้อนกลับ</button>
					</div>
					<div class="pull-right">
						<button id="nextToStep3" class="btn btn-primary btn-lg">ต่อไป</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row setup-content" id="step-3">
		<div class="col-xs-12">
            <div class="col-md-12 well text-center">
				<div class="row text-left">
					ประเมินราคา
				</div>
				<div class="row">
					<div class="col-md-6">
						Height : <?php
						echo CHtml::textField('height', '', array(
							'id'=>'height_input',
							'class'=>'input-lg',
							'disabled'=>true,));
						?>
						เมตร
					</div>
					<div class="col-md-6 pull-left">
						Length : <?php
						echo CHtml::textField('length', '', array(
							'id'=>'length_input',
							'class'=>'input-lg',
						));
						?>
						เมตร
					</div>
				</div>
				<div class="row" id="order_list">

				</div>
				<div class="row wizard-control">
					<div class="pull-left" >
						<button id="backToStep2" class="btn btn-primary btn-lg">ย้อนกลับ</button>
					</div>
					<div class="col-lg-10 text-center">
						<button id="calculatePrice" class="btn btn-warning btn-lg">อัพเดทราคา</button>
					</div>
					<div class="pull-right">
						<button id="nextToStep4" class="btn btn-primary btn-lg">ต่อไป</button>
					</div>
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
						<button id="backToStep3" class="btn btn-primary btn-lg">ย้อนกลับ</button>
						<button id="addToCart" class="btn btn-primary btn-lg">ใส่ตระกร้า</button>
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

<?php // echo $form->errorSummary($model);        ?>

	<div class="row">
<?php // echo $form->labelEx($model, 'supplierId');   ?>
<?php // echo $form->textField($model, 'supplierId');   ?>
<?php // echo $form->error($model, 'supplierId');       ?>
	</div>

	<div class="row">
<?php // echo $form->labelEx($model, 'type');    ?>
<?php // echo $form->textField($model, 'type');   ?>
<?php // echo $form->error($model, 'type');       ?>
	</div>

	<div class="row">
<?php // echo $form->labelEx($model, 'status');    ?>
<?php // echo $form->textField($model, 'status');   ?>
<?php // echo $form->error($model, 'status');       ?>
	</div>

	<div class="row">
<?php // echo $form->labelEx($model, 'title');    ?>
<?php // echo $form->textField($model, 'title');   ?>
<?php // echo $form->error($model, 'title');       ?>
	</div>


	<div class="row buttons">
<?php // echo CHtml::submitButton('Submit');         ?>
	</div>

<?php // $this->endWidget();        ?>

</div>-->
<!-- form -->

