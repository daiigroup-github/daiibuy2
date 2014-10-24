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
                <li class="<?php echo $this->action->id == 'create'? 'active' : ''; ?>"><a href="#step-1">
						<h4 class="list-group-item-heading">Step 1</h4>
						<p class="list-group-item-text">First step description</p>
					</a></li>
                <li><a href="#step-2">
						<h4 class="list-group-item-heading">Step 2</h4>
						<p class="list-group-item-text">Second step description</p>
					</a></li>
					  <li class="<?php echo ($this->action->id == 'view' && $model->status == 0)? 'active' : ''; ?>"><a href="#step-3-1">
						<h4 class="list-group-item-heading">Step 3</h4>
						<p class="list-group-item-text">Third step description</p>
					</a></li>
                <li class="<?php echo ($this->action->id == 'view' && $model->status == 1)? 'active' : ''; ?>"><a href="#step-3">
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
							<h1>สร้าง My File</h1><small> กรุณากรอกข้อมูลตามด้านล่าง.</small>
						</div>
						<div class="form-group">
							<div class="col-sm-10">
							<?php echo $form->textField($model,'title',array('size'=>20,'maxlength'=>20, 'class'=>'form-control','placeholder'=>'กรุณากรอกชื่อ My File.')); ?>
							<?php echo $form->error($model,'title'); ?>
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
					<div class="col-md-6 text-center">
						<a id="uploadPlanAtech">
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
						<a id="manualQuantityAtech">
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
						<?php // $this->renderPartial('_upload_plan', array('model'=>$model)); ?>

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

			<?php

			?>
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
	<div class="row setup-content" id="step-3-1">
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
					<?php echo CHtml::image(Yii::app()->baseUrl.$orderFile->filePath, '', array('style'=>'width:300px;height:300px')); ?>
						<div class="blue button center-block" style="text-align: center;background-clip: border-box;color: white;width:300px;"><?php echo $i==0? "แบบแปลน":"ด้านข้าง ".$i; ?></div>
				</div>
			</div>
		<?php $i++; ?>
	<?php endforeach;?>
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
						<button id="backToStep2" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-chevron-left"></i> ย้อนกลับ</button>
					</div>
					<div class="col-lg-9 text-center">
						<button id="calculatePrice" class="btn btn-warning btn-lg"><i class="glyphicon glyphicon-refresh"></i> อัพเดทราคา</button>
					</div>
					<div class="pull-right">
						<button id="nextToStep4" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-chevron-right"></i> ต่อไป</button>
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

<?php $this->endWidget(); ?>
