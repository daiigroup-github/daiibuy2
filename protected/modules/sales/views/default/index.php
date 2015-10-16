<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
	$this->module->id,
);
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions'=>array(
//		'class'=>'form-signin',
//		'role'=>'form'
	),
	));
?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-lg-12" >


		<div class="sidebar-box-heading">
			<i class="icons icon-search-1"></i>
			<h4>ค้นหาลูกค้า</h4>
		</div>

		<div class="sidebar-box-content sidebar-padding-box">
			<div class="row">
				<div class="col-md-6" style="border-right: 2px black solid">
					<div class="row sidebar-box blue">

						<div class="col-lg-12 col-md-12 col-sm-12">

							<div class="sidebar-box-heading">
								<i class="icons icon-box-2"></i>
								<h4>ขั้นตอนการใช้งาน</h4>
							</div>

							<div class="sidebar-box-content sidebar-padding-box"   style="border: 1px black solid">
								<div >
									<p style="color: green"><i class="icons icon-edit" style="font-size: 26px"></i> กรอก <strong>Username</strong> และ <strong>Password</strong> ที่ใช้ Login ระบบ Intranet <br><br><span style="font-size: 14px;color: red">***หมายเหตุ รหัสผ่าน ของพนักงาน ถือเป็นความลับ ของ บริษัท และเพื่อความปลอดภัยของข้อมูลบริษัท จึงไม่ควรบอกแก่บุคคลอื่น</span></p>
									<hr>
									<p style="color: black">กดปุ่ม <a class="btn btn-primary" style="margin-bottom: 5px">ตรวจสอบ</a> ข้อมูล เพื่อทำการ ให้ระบบ ตรวจสอบ ข้อมูล เมื่อข้อมูลถูกต้อง จึงจะสามารถ ค้นหาลูกค้าได้</p>
									<hr>
									<p style="color: #9b59b6"><i class="icons icon-edit" style="font-size: 26px"></i> กรอก ข้อมูลของลูกค้า เพื่อ ตรวจสอบ ข้อมูล</p>
									<hr>
									<p style="color: #F65D20">กดปุ่ม <a class="btn btn-success" style="margin-bottom: 5px">ค้นหา</a> เพื่อ ตรวจสอบข้อมูล จาก ระบบ</p>
								</div>
								<hr>
								<!--								<div style="font-size: small" class="alert alert-danger">
																	<p>**หมายเหตุ</p>

																</div>-->
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row sidebar-box orange">

						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="sidebar-box-heading">
								<i class="icons icon-box-2"></i>
								<h4>ข้อมูลพนักงาน</h4>
							</div>

							<div class="sidebar-box-content sidebar-padding-box" style="border: 1px black solid">
								<div class="row">
									<div class="col-md-12 text-danger">
										<?php echo isset($message) ? $message : ""; ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php
										echo $form->emailField($model, 'username', array(
											'class'=>'form-control',
											'placeholder'=>'Username'));
										?>
										<?php echo $form->error($model, 'username'); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">

										<?php
										echo $form->passwordField($model, 'password', array(
											'class'=>'form-control',
											'placeholder'=>'Password'));
										?>
										<?php echo $form->error($model, 'password'); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<button class="btn btn-lg btn-primary btn-block" type="submit">ตรวจสอบ</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
					$this->renderPartial("_user_search", array(
						'model'=>$model));
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->endWidget(); ?>