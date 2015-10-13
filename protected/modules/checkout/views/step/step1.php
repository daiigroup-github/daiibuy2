<?php
$this->renderPartial('_step_header', array(
	'step'=>$step));
Yii::app()->clientScript->registerScript("loadProvince", "
	$(document).ready(function(){
	$.ajax({
		type:'POST',
		data:{provinceId:" . $this->cookie->provinceId . "},
		url:'" . $this->createUrl('findAmphur') . "',
		success:function(data){
			$('#billingAmphur').html(data);
			$('#billingAmphur').prop('disabled', false);
			$('#billingDistrict').html('');
			$('#billingDistrict').prop('disabled', true);

			$('#shippingAmphur').html(data);
			$('#shippingAmphur').prop('disabled', false);
			$('#shippingDistrict').html('');
			$('#shippingDistrict').prop('disabled', true);
		}
	})
	});
");
Yii::app()->clientScript->registerScript("loadProvince", "
	$(document).ready(function(){
	$.ajax({
		type:'POST',
		data:{provinceId:" . $this->cookie->provinceId . "},
		url:'" . $this->createUrl('findAmphur') . "',
		success:function(data){
			$('#billingAmphur').html(data);
			$('#billingAmphur').prop('disabled', false);
			$('#billingDistrict').html('');
			$('#billingDistrict').prop('disabled', true);

			$('#shippingAmphur').html(data);
			$('#shippingAmphur').prop('disabled', false);
			$('#shippingDistrict').html('');
			$('#shippingDistrict').prop('disabled', true);
		}
	})
	});
");
?>

<div class="row">
    <div class="col-md-4">
        <div class="carousel-heading no-margin">
            <h4>เข้าสู่ระบบ / LOGIN</h4>
        </div>
		<?php
		$formLogin = $this->beginWidget('CActiveForm', array(
			'id'=>'{id}',
			//'enableClientValidation' => true,
			//'clientOptions' => array('validateOnSubmit' => true,),
			'htmlOptions'=>array(
				'class'=>'form-horizontal',
				'role'=>'form'),
		));
		?>
        <div class="page-content">
			<left>หากคุณเคยสมัครสมาชิกแล้ว กรุณาเข้าสู่ระบบที่นี่.
				<br>If you are already registered please login directly here.</left><br>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="iconic-input">
<?php echo $formLogin->textField($userModel, 'email', array(
	'placeholder'=>$userModel->attributeLabels()['email'])); ?>
                        <i class="icons icon-user-3"></i>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="iconic-input">
<?php echo $formLogin->passwordField($userModel, 'password', array(
	'placeholder'=>$userModel->attributeLabels()['password'],
	'style'=>"width:100%; background: #f7f7f7; font-size: 14px; border:1px solid #e6e6e6; height: 40px; padding: 5px 10px;"));
?>
                        <i class="icons icon-lock"></i>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
<?php echo CHtml::submitButton('Login', array(
	'class'=>'orange',
	'name'=>'Login')); ?>
                </div>
            </div>
        </div>
		<?php $this->endWidget(); ?>

    </div>

    <div class="col-md-8 register-account">
        <div class="carousel-heading no-margin">
            <h4>สมัครสมาชิก / Register</h4>
        </div>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'{id}',
	//'enableClientValidation' => true,
	//'clientOptions' => array('validateOnSubmit' => true,),
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'role'=>'form'),
	));
?>
        <div class="page-content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p><u><strong>ข้อมูลบัญชี</strong></u></p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($userModel, 'firstname'); ?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
<?php echo $form->textField($userModel, 'firstname'); ?>
<?php echo $form->error($userModel, 'firstname'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($userModel, 'lastname'); ?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
					<?php echo $form->textField($userModel, 'lastname'); ?>
<?php echo $form->error($userModel, 'lastname'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($userModel, 'email'); ?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
					<?php echo $form->textField($userModel, 'email', array(
						'id'=>'verifyEmail',
						'onblur'=>'checkEmail();')); ?>
					<span id="mailMessage" class="mailMessage"></span>
<?php echo $form->error($userModel, 'email'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($userModel, 'password'); ?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
<?php echo $form->passwordField($userModel, 'password', array(
	'style'=>'width:100%; background: #f7f7f7; font-size: 14px; border:1px solid #e6e6e6; height: 40px;',
	'id'=>'pass1',
	'onblur'=>'checkPass(); return false;')); ?>
<?php echo $form->error($userModel, 'password'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($userModel, 'confirmPassword'); ?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
					<?php echo $form->passwordField($userModel, 'confirmPassword', array(
						'style'=>'width:100%; background: #f7f7f7; font-size: 14px; border:1px solid #e6e6e6; height: 40px;',
						'onblur'=>'checkPass(); return false;')); ?>
					<span id="confirmMessage" class="confirmMessage"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p><u><strong>ข้อมูลสำหรับออกใบกำกับภาษี</strong></u></p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'firstname'); ?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
					<?php echo $form->textField($addressModel, 'firstname'); ?>
					<?php echo $form->error($addressModel, 'firstname'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'lastname'); ?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
					<?php echo $form->textField($addressModel, 'lastname'); ?>
					<?php echo $form->error($addressModel, 'lastname'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'company'); ?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
					<?php echo $form->textField($addressModel, 'company'); ?>
					<?php echo $form->error($addressModel, 'company'); ?>
                </div>
            </div>
			<div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'taxNo'); ?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
					<?php echo $form->textField($addressModel, 'taxNo'); ?>
					<?php echo $form->error($addressModel, 'taxNo'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'address_1'); ?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
<?php echo $form->textField($addressModel, 'address_1'); ?>
					<?php echo $form->error($addressModel, 'address_1'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'address_2'); ?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
					<?php echo $form->textField($addressModel, 'address_2'); ?>
					<?php echo $form->error($addressModel, 'address_2'); ?>
					<span style="font-size: 14px;color: red"><b>**ไม่ต้องกรอก <u>ตำบล, อำเภอ, จังหวัด และรหัสไปรษณีย์</u> ลงในที่อยู่ 1 และที่อยู่ 2 </b></span>
                </div>

            </div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4">
					<p><?php echo $form->labelEx($addressModel, 'provinceId'); ?></p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<?php
//					echo $province->provinceName;
					echo $form->dropDownList($addressModel, 'provinceId', CHtml::listData(Province::model()->findAll(), 'provinceId', 'provinceName'), array(
						'id'=>'shippingProvince',
//						'disabled'=>'disabled',
//						));
						'prompt'=>'--- เลือกจังหวัด ---',
						'ajax'=>array(
							'type'=>'POST',
							'data'=>array(
								'provinceId'=>'js:this.value'),
							'url'=>$this->createUrl('findAmphur'),
							'success'=>'js:function(data){
                                    $("#shippingAmphur").html(data);
                                    $("#shippingAmphur").prop("disabled", false);
                                    $("#shippingDistrict").html("");
                                    $("#shippingDistrict").prop("disabled", true);
                                }',
						),
					));
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4">
					<p><?php echo $form->labelEx($addressModel, 'amphurId'); ?></p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
<?php
echo $form->dropDownList($addressModel, 'amphurId', array(), array(
//                            'class'=>'chosen-select-full-width',
	'id' => 'shippingAmphur',
	'prompt' => '--- เลือกอำเภอ ---',
	'ajax'=>array(
		'type'=>'POST',
		'data'=>array(
			'amphurId'=>'js:this.value'),
		'url'=>$this->createUrl('findDistrict'),
		'success'=>'js:function(data){
                                    $("#shippingDistrict").html(data);
                                    $("#shippingDistrict").prop("disabled", false);
                                }',
	),
	)
);
?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4">
					<p><?php echo $form->labelEx($addressModel, 'districtId'); ?></p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
<?php
echo $form->dropDownList($addressModel, 'districtId', array(), array(
//                            'class'=>'chosen-select-full-width',
	'id' => 'shippingDistrict',
	'prompt' => '--- เลือกตำบล ---',
	)
);
?>
				</div>
			</div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'postcode'); ?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
					<?php echo $form->textField($addressModel, 'postcode'); ?>
					<?php echo $form->error($addressModel, 'postcode'); ?>
                </div>
            </div>

			<div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($userModel, 'telephone'); ?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
<?php echo $form->textField($userModel, 'telephone'); ?>
<?php echo $form->error($userModel, 'telephone'); ?>
                </div>
            </div>
			<div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($userModel, 'fax'); ?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
<?php echo $form->textField($userModel, 'fax'); ?>
<?php echo $form->error($userModel, 'fax'); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
<?php echo CHtml::submitButton('Register', array(
	'class'=>'big blue',
	'name'=>'Register')); ?>
<?php echo CHtml::resetButton('Reset', array(
	'class'=>'big')); ?>
                </div>
            </div>
        </div>
<?php $this->endWidget(); ?>

    </div>
</div>

<script>
	function checkPass()
	{
		//Store the password field objects into variables ...
		var pass1 = document.getElementById('pass1');
		var pass2 = document.getElementById('User_confirmPassword');
		//Store the Confimation Message Object ...
		var message = document.getElementById('confirmMessage');
		//Set the colors we will be using ...
		var goodColor = "#66cc66";
		var badColor = "#ff6666";
		//Compare the values in the password field
		//and the confirmation field
		if ((pass1.value !== "" && pass2.value === "")) {
		} else {
			if ((pass1.value === "" && pass2.value === "")) {
				pass1.style.backgroundColor = badColor;
				pass2.style.backgroundColor = badColor;
				message.style.color = badColor;
				message.style.fontSize = '12px';
				message.innerHTML = "<b>กรุณาใส่รหัสผ่าน!</b>";
				pass1.focus();
			} else if ((pass1.value === pass2.value)) {
				//The passwords match.
				//Set the color to the good color and inform
				//the user that they have entered the correct password
				pass1.style.backgroundColor = goodColor;
				pass2.style.backgroundColor = goodColor;
				message.style.color = goodColor;
				message.style.fontSize = '12px';
				message.innerHTML = "<b>รหัสผ่านตรงกัน!</b>";
			} else {
				//The passwords do not match.
				//Set the color to the bad color and
				//notify the user.
				pass2.style.backgroundColor = badColor;

				message.style.color = badColor;
				message.style.fontSize = '12px';
				message.innerHTML = "<b>กรุณาใส่รหัสผ่านให้ตรงกัน!</b>";
//		pass2.focus();
			}
		}
	}
	function checkEmail() {
		var email = document.getElementById('verifyEmail');
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var message = document.getElementById('mailMessage');
		var goodColor = "#66cc66";
		var badColor = "#ff6666";

		if (!filter.test(email.value)) {
			email.style.backgroundColor = badColor;
			message.style.color = badColor;
			message.style.fontSize = '12px';
			message.innerHTML = "<b>กรุณาใส่รูปแบบอีเมล์ให้ถูกต้อง</b> <i>(ตัวอย่าง : customer@gmail.com).</i>";
			email.focus();
			return false;
		} else {
			var url = '<?php echo $this->createUrl("isValidEmail"); ?>';
			$.ajax({
						type: "POST",
						dataType: "JSON",
						url: url,
						data: {email: email.value},
						success: function (data) {
							if(data.status){
				email.style.backgroundColor = goodColor;
				message.style.color = goodColor;
				message.style.fontSize = '12px';
				message.innerHTML = "<b>คุณสามารถใช้อีเมลล์นี้ได้.</b>";
			}else{
				email.style.backgroundColor = badColor;
			message.style.color = badColor;
			message.style.fontSize = '12px';
			message.innerHTML = "<b>อีเมลล์นี้มีอยู่แล้วในระบบ ไม่สามารถใช้งานได้.</b>";
			email.focus();
			return false;
	}
						}
					});
		}
	}
</script>
