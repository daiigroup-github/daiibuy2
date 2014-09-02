<?php
//$this->pageHeader = "Home";
$baseUrl = Yii::app()->baseUrl;

$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl . '/js/fancyBox/fancyBox.js');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/lib/jquery-1.7.2.min.js');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/lib/jquery.mousewheel-3.0.6.pack.js');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.js?v=2.0.6');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-buttons.js?v=1.0.2');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.2');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-media.js?v=1.0.0');
$cs->registerCssFile($baseUrl . '/js/fancyBox/fancyBox.css');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.css?v=2.0.6');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-buttons.css?v=1.0.2');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.2');
?>
<?php $url = CController::createUrl('admin/user/dynamicUserType'); ?>
<?php $urlLocation = CController::createUrl('admin/address/dynamicLocation'); ?>
<script type="text/javascript">
	$(document).ready(
			function() {
				var type = <?php
if(isset($model->type))
{
	echo $model->type;
}
else
{
	echo 0;
}
?>;
				if (type == 3)
				{
					document.getElementById('minOrder').style.display = 'block';
				}
				var userId = <?php
if(isset($model->userId))
{
	echo $model->userId;
}
else
{
	echo 0;
}
?>;
				var url = "<?php echo $url; ?>";
				//alert(url);
				if (type > 0)
				{
					$.ajax({
						type: "POST",
						dataType: "JSON",
						url: url,
						update: "#attechFile",
						data: {type: type, userId: userId},
						success: function(data) {
							if (data.userType != 1)
								$('#attechFile').html(data.attechForm);
							if (data.userType == 2)
							{
								document.getElementById('shippingAddress').style.display = 'block';
							}
							else
							{
								document.getElementById('shippingAddress').style.display = 'none';
							}
							if (data.userType == 3)
							{
								document.getElementById('minOrder').style.display = 'block';
							}
							else
							{
								document.getElementById('minOrder').style.display = 'none';
							}
						}
					});
				}
				else
				{
				}
			}
	);
	function copyAddress(check)
	{   //business
		var bFName = document.getElementById("Address_business_firstname");
		var bLName = document.getElementById("Address_business_lastname");
		var bCompany = document.getElementById("Address_business_company");
		var bAddress1 = document.getElementById("Address_business_address_1");
		var bAddress2 = document.getElementById("Address_business_address_2");
		var bdistrict = document.getElementById("Address_business_districtId");
		var bamphur = document.getElementById("Address_business_amphurId");
		var bprovince = document.getElementById("Address_business_provinceId");
		var bPostCode = document.getElementById("Address_business_postcode");

		var sFName = document.getElementById("Address_shipping_firstname");
		var sLName = document.getElementById("Address_shipping_lastname");
		var sCompany = document.getElementById("Address_shipping_company");
		var sAddress1 = document.getElementById("Address_shipping_address_1");
		var sAddress2 = document.getElementById("Address_shipping_address_2");
		var sdistrict = document.getElementById("Address_shipping_districtId");
		var samphur = document.getElementById("Address_shipping_amphurId");
		var sprovince = document.getElementById("Address_shipping_provinceId");
		var sPostCode = document.getElementById("Address_shipping_postcode");

		if (check)
		{
			sFName.value = bFName.value;
			sLName.value = bLName.value;
			sCompany.value = bCompany.value;
			sAddress1.value = bAddress1.value;
			sAddress2.value = bAddress2.value;
			sprovince.getElementsByTagName('option')[bprovince.value].selected = 'selected';
			//samphur.getElementsByTagName('option')[bamphur.value].selected = 'selected';
			var url = "<?php echo $urlLocation; ?>";
			$.ajax({
				type: "POST",
				url: url,
				data: {provinceId: bprovince.value},
				success: function(data) {
					$("#Address_shipping_amphurId").html(data);
					samphur.value = bamphur.value;

				}
			});

			$.ajax({
				type: "POST",
				url: url,
				data: {amphurId: bamphur.value},
				success: function(data) {
					$("#Address_shipping_districtId").html(data);
					sdistrict.value = bdistrict.value;

				}
			});

			sPostCode.value = bPostCode.value;
		}
		else
		{
			sFName.value = "";
			sLName.value = "";
			sCompany.value = "";
			sAddress1.value = "";
			sAddress2.value = "";
			sPostCode.value = "";
			sProvince.value = "";
			sAmphur.value = "";
			sdistrict.value = "";
		}
	}
</script>
<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'enctype'=>'multipart/form-data',
		'class'=>'form-horizontal well'
	),
	));
?>
<div class="control-group">
    <div class="controls">
		<?php
		echo CHtml::submitButton($model->isNewRecord ? 'สร้าง' : 'บันทึก', array(
			'class'=>'btn btn-primary pull-right')); //'onclick'=>"validatePromotion()" ));
		?>
    </div>
</div>

<div class="row">
	<?php
	$isShowUserCer = false;
	if(Yii::app()->controller->action->id == "update")
	{
		$isShowUserCer = TRUE;
	}
	if(isset($model) && $model->type != 3)
	{
		$isShowUserCer = FALSE;
	}
	?>
	<div class="span1"></div>
	<div class="span10">
        <div class="tabbable"> <!-- Only required for left/right tabs -->
            <ul class="nav nav-tabs">
                <li class="active" id="t1"><a href="#tab1" data-toggle="tab">รายละเอียด User</a></li>
				<?php
				if($isShowUserCer)
				{
					?>
					<li id="t2"><a href="#tab2" data-toggle="tab">เอกสารสัญญา Margin</a></li>
				<?php } ?>
				<li id="t3"><a href="#tab3" data-toggle="tab">เพิ่มเติม..</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab1">
                    <p class="note">Fields with <span class="required">*</span> are required.</p>
					<?php echo $form->errorSummary($model); ?>
					<div class="alert">
                        <h3>ข้อมูลบัญชี</h3>

                        <div class="control-group">
							<label class="control-label"><?php echo $form->labelEx($model, 'email'); ?></label>
							<div class="controls">

								<?php
								//echo $form->textField($model,'email',array('size'=>60,'maxlength'=>96));
								echo CHtml::activeTextField($model, 'email', array(
									'id'=>'textAjax',
									'ajax'=>array(
										'type'=>'POST',
										'url'=>CController::createUrl('admin/user/checkEmail'),
										'update'=>'#email_result',
									//'data' => '???'
									)
								));
								?>
								<div class="help-inline">ใช้ Email ในการเข้าสู่ระบบ</div>
                                <div id="email_result" class="alert-danger"></div>
								<?php echo $form->error($model, 'email'); ?>
							</div>
                        </div>
						<?php
						if(Yii::app()->controller->action->id != "update")
						{
							?>
							<div class="control-group">
								<label class="control-label"><?php echo $form->labelEx($model, 'password'); ?></label>
								<div class="controls"><?php
									echo $form->passwordField($model, 'password', array(
										'size'=>40,
										'maxlength'=>40
									));
									?>
									<?php echo $form->error($model, 'password'); ?>
								</div>
							</div>
							<?php
						}
						else
						{
							if(Yii::app()->user->userType == 4 && (!isset($model->referenceId) || empty($model->referenceId)) && $model->type == 2)
							{
								?>
								<div class="control-group">
									<label class="control-label"><?php echo $form->labelEx($model, 'referenceId'); ?></label>
									<div class="controls">
										<?php
										echo $form->dropDownlist($model, 'referenceId', User::model()->findAllAdminAssignArray(), array(
											'prompt'=>'-- เลือกผู้แต่งตั้ง --'));
										?>
										<?php echo $form->error($model, 'referenceId'); ?>
									</div>
								</div>
								<?php
							}
							else if(Yii::app()->user->userType == 4 && (isset($model->referenceId) || !empty($model->referenceId)) && $model->type == 2)
							{
//								$referenceUser = User::model()->find('userId = ' . $model->referenceId);
								?>
								<div class="control-group">
									<label class="control-label"><?php echo $form->labelEx($model, 'referenceId'); ?></label>
									<div class="controls">
										<?php
										echo $form->dropDownlist($model, 'referenceId', User::model()->findAllAdminAssignArray(), array(
											'prompt'=>'-- เลือกผู้แต่งตั้ง --'));
										?>
										<?php echo $form->error($model, 'referenceId'); ?>
									</div>
								</div>
								<!--								<div class="control-group">
																	<label class="control-label"><?php echo "ผู้แต่งตั้ง" ?></label>
																	<div class="controls">
																		<input type='text' name='nTotal' value='<?php // echo $referenceUser->firstname . " " . $referenceUser->lastname;   ?>'size="32" readonly="true">
								<?php // echo $form->error($model, 'referenceId'); ?>
																	</div>
																</div>-->
								<?php
							}
						}
						?>

						<div class="control-group">
							<label class="control-label"><?php echo $form->labelEx($model, 'firstname'); ?></label>
							<div class="controls">
								<?php
								echo $form->textField($model, 'firstname', array(
									'size'=>32,
									'maxlength'=>32
								));
								?>
								<?php echo $form->error($model, 'firstname'); ?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label"><?php echo $form->labelEx($model, 'lastname'); ?></label>
							<div class='controls'>
								<?php
								echo $form->textField($model, 'lastname', array(
									'size'=>32,
									'maxlength'=>32
								));
								?>
								<?php echo $form->error($model, 'lastname'); ?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label"><?php echo $form->labelEx($model, 'telephone'); ?></label>
							<div class='controls'>
								<?php
								echo $form->textField($model, 'telephone', array(
									'size'=>32,
									'maxlength'=>32
								));
								?>
								<?php echo $form->error($model, 'telephone'); ?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label"><?php echo $form->labelEx($model, 'fax'); ?></label>
							<div class='controls'>
								<?php
								echo $form->textField($model, 'fax', array(
									'size'=>32,
									'maxlength'=>32
								));
								?>
								<?php echo $form->error($model, 'fax'); ?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label"><?php echo $form->labelEx($model, 'status'); ?></label>
							<div class="controls">
								<?php echo $form->checkBox($model, 'status'); ?>
								<?php echo $form->error($model, 'status'); ?>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label"><?php echo $form->labelEx($model, 'approved'); ?></label>
							<div class="controls">
								<?php echo $form->checkBox($model, 'approved'); ?>
								<?php echo $form->error($model, 'approved'); ?>
							</div>
						</div>
					</div>
					<div class="alert-info">
						<h3>เอกสารประกอบการสมัคร</h3>
						<div class="control-group">
							<label class="control-label"><?php echo $form->labelEx($model, 'type'); ?></label>
							<div class="controls">
								<?php
								echo $form->dropdownList($model, 'type', User::model()->getAllUserType(), array(
									"prompt"=>"-",
									'ajax'=>array(
										'type'=>'POST',
										//request type
										'dataType'=>'JSON',
										'url'=>CController::createUrl('admin/user/dynamicUserType'),
										//url to call.
										//Style: CController::createUrl('currentController/methodToCall')
										'update'=>'#attechFile',
										//selector to update
										'data'=>array(
											"userId"=>$model->userId,
											"type"=>"js:this.value"
										),
										'success'=>"function(data){
											$('#attechFile').html(data.attechForm);
											if(data.userType == 2)
											{
												document.getElementById('shippingAddress').style.display = 'block';
											}
											else
											{
												document.getElementById('shippingAddress').style.display = 'none';
											}
											if(data.userType == 3)
											{
												document.getElementById('minOrder').style.display = 'block';
											}
											else
											{
												document.getElementById('minOrder').style.display = 'none';
											}
										}"
									//leave out the data key to pass all form values through
									)
								));
								?>
								<?php echo $form->error($model, 'type'); ?>
							</div>
						</div>
						<div id="attechFile"></div>
					</div>
					<div id="minOrder" class="alert-info" style="display: none;">
						<div class="control-group">
							<div class="control-label"><?php echo $form->labelEx($model, 'minimumOrder'); ?></div>
							<div class="controls">

								<?php
								echo $form->textField($model, 'minimumOrder');
								?>
								<?php echo $form->error($model, 'minimumOrder'); ?>
								<div class="help-block">ใช้ สำหรับ Supplier เพื่อระบุยอดขั้นต่ำที่จะขายต่อ order</div>
							</div>
						</div>
					</div>
					<div class="alert-success">
						<h3>ที่อยู่ในการจัดส่งเอกสาร</h3>
						<?php
						if(isset($address))
						{
							$this->renderPartial("//address/_address", array(
								"model"=>$address,
								"type"=>"billing",
								'form'=>$form
							));
						}
						?>
					</div>
					<?php
					if(isset($shippingAddressModel))
					{
						?>
						<div class="alert" id="shippingAddress" style="display: none">
							<h3>ที่อยู่ในการจัดส่งสินค้า</h3>
							<?php
							echo CHtml::checkBox("sameAddress", false, array(
								'onclick'=>'copyAddress(this.checked)')) . "เหมือนที่อยู่จัดส่งเอกสาร";
							?>
							<?php
							$this->renderPartial("//address/_address", array(
								"model"=>$shippingAddressModel,
								"type"=>"shipping",
								'form'=>$form
							));
							?>
						</div>
					<?php } ?>
				</div>
				<?php
				if($isShowUserCer)
				{
					?>
					<div class="tab-pane" id="tab2">
						<?php
						$this->renderPartial("certificate", array(
							'model'=>$model))
						?>
					</div>
				<?php } ?>
				<div class="tab-pane" id="tab3">
					<?php
					$this->renderPartial("_form_profile", array(
						'model'=>$model,
						'form'=>$form
					))
					?>
				</div>
			</div>
		</div>

	</div>
</div>
<?php $this->endWidget(); ?>
<!-- form -->