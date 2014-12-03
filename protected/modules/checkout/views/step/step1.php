<?php $this->renderPartial('_step_header', array('step'=>$step));
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
            <h4>Your account details</h4>
        </div>

        <?php
        $formLogin = $this->beginWidget('CActiveForm', array(
            'id' => '{id}',
            //'enableClientValidation' => true,
            //'clientOptions' => array('validateOnSubmit' => true,),
            'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
        ));

        ?>
        <div class="page-content">
            <p>If you are already registered please login directly here</p>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="iconic-input">
                        <?php echo $formLogin->textField($userModel, 'email', array('placeholder' => $userModel->attributeLabels()['email'])); ?>
                        <i class="icons icon-user-3"></i>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="iconic-input">
                        <?php echo $formLogin->passwordField($userModel, 'password', array('placeholder' => $userModel->attributeLabels()['password'],
							'style'=>"width:100%; background: #f7f7f7; font-size: 14px; border:1px solid #e6e6e6; height: 40px; padding: 5px 10px;")); ?>
                        <i class="icons icon-lock"></i>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <?php echo CHtml::submitButton('Login', array('class' => 'orange', 'name' => 'Login')); ?>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>

    </div>

    <div class="col-md-8 register-account">
        <div class="carousel-heading no-margin">
            <h4>Register</h4>
        </div>

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => '{id}',
            //'enableClientValidation' => true,
            //'clientOptions' => array('validateOnSubmit' => true,),
            'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
        ));
        ?>
        <div class="page-content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p><strong>Account</strong></p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($userModel, 'firstname');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($userModel, 'firstname');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($userModel, 'lastname');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($userModel, 'lastname');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($userModel, 'email');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($userModel, 'email');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($userModel, 'password');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->passwordField($userModel, 'password', array('style'=>'width:100%; background: #f7f7f7; font-size: 14px; border:1px solid #e6e6e6; height: 40px;'));?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($userModel, 'confirmPassword');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->passwordField($userModel, 'confirmPassword',array('style'=>'width:100%; background: #f7f7f7; font-size: 14px; border:1px solid #e6e6e6; height: 40px;'));?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p><strong>Billing Information</strong></p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'firstname');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'firstname');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'lastname');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'lastname');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'company');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'company');?>
                </div>
            </div>
			<div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'taxNo');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'taxNo');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'address_1');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'address_1');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'address_2');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'address_2');?>
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
						));
//						'prompt'=>'--- เลือกจังหวัด ---',
//						'ajax'=>array(
//							'type'=>'POST',
//							'data'=>array(
//								'provinceId'=>'js:this.value'),
//							'url'=>$this->createUrl('findAmphur'),
//							'success'=>'js:function(data){
//                                    $("#shippingAmphur").html(data);
//                                    $("#shippingAmphur").prop("disabled", false);
//                                    $("#shippingDistrict").html("");
//                                    $("#shippingDistrict").prop("disabled", true);
//                                }',
//						),
//					));
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
						'id'=>'shippingAmphur',
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
						'id'=>'shippingDistrict',
						)
					);
					?>
				</div>
			</div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'postcode');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'postcode');?>
                </div>
            </div>

			<div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($userModel, 'telephone');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($userModel, 'telephone');?>
                </div>
            </div>
			<div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($userModel, 'fax');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($userModel, 'fax');?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <?php echo CHtml::submitButton('Register', array('class'=>'big blue', 'name'=>'Register'));?>
                    <?php echo CHtml::resetButton('Reset', array('class'=>'big'));?>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>

    </div>
</div>
