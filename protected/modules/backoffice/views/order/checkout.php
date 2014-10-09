<?php
$this->breadcrumbs = array(
	'ดำเนินการสั่งซื้อ',
);

$this->pageHeader = 'ดำเนินการสั่งซื้อ';
$urlCheckUser = CController::createUrl('User/CheckEmailAddNewUser');
$userType = 0;
$daiibuy = new DaiiBuy();
$daiibuy->loadCookie();
?>
<script>
	/*<![CDATA[*/

	$(document).ready(function() {
		m1 = document.getElementById('paymentMethod_0');
		m2 = document.getElementById('paymentMethod_1');
		if (m1.checked || m2.checked) {
			aa = document.getElementById('submitCheckout');
			aa.removeAttribute("disabled");
		}
		if (<?php echo ( isset(Yii::app()->params["enableEPayment"]) && Yii::app()->params["enableEPayment"]) ? 0 : 1 ?>)
		{
			m1.style.display = "none";
		}
		var userId = <?php echo isset(Yii::app()->user->id) ? Yii::app()->user->id : 0; ?>;
		checkmail = 0;
		if (userId > 0)
		{
			document.getElementById("billingAddress").style.display = "inline";
			$("#collapseTwoTwo").removeClass("in");
			$("#collapseTwoOne").removeClass("in");
			$("#collapseTwoThree").removeClass("in");
<?php
if(isset($model->orderId))
{
	//echo $model->orderId . "ddsdfdsfsfdssdf";
	echo '$("#collapseTwoThree").addClass("in");';
}

if(isset($model->paymentMethod))
{
	if($model->paymentMethod == 1)
		echo '$("#collapseFourOne").addClass("in");';
	else if($model->paymentMethod == 2)
		echo '$("#collapseFourTwo").addClass("in");';
}
?>

			$("#sec1next").trigger("click");
			document.getElementById("userId").value = userId;
		}
		else
		{
			if ($("#customerType_0").is(":checked"))
			{
				document.getElementById("billingAddress_1").checked = true;
				document.getElementById('billingAddress').style.display = 'none';
				$('#collapseTwoOne').removeClass("in");
				$('#collapseTwoTwo').addClass("in");
			}

			if ($("#paymentMethod_0").is(":checked"))
			{
				$('#collapseFourTwo').removeClass("in");
				$('#collapseFourOne').addClass("in");
			}
		}

		$("#sec1next").click(function() {
			if ("<?php echo isset(Yii::app()->user->id) ? 1 : 0 ?>" == "1") {
//				document.location.reload(true);
			}
		});
		$("#billingAddress_0").click(function() {
			if ($(this).is(":checked"))
			{
				$('#collapseTwoTwo').removeClass("in");
				$('#collapseTwoThree').removeClass("in");
				$('#collapseTwoOne').addClass("in");
			}

		});
		$("#billingAddress_1").click(function() {
			if ($(this).is(":checked"))
			{
				$('#collapseTwoOne').removeClass("in");
				$('#collapseTwoThree').removeClass("in");
				$('#collapseTwoTwo').addClass("in");
				document.getElementById('Address_billing_addressId').value = "";
			}
		});
		$("#billingAddress_2").click(function() {
			if ($(this).is(":checked"))
			{
				$('#collapseTwoOne').removeClass("in");
				$('#collapseTwoTwo').removeClass("in");
				$('#collapseTwoThree').addClass("in");
				document.getElementById('Address_billing_addressId').value = "";
			}
		});




		$("#isSent").click(function() {
			if ($(this).is(":checked"))
			{
				if ($("#shippingAddress_0").is(":checked")) {
					$('#collapseThreeOne').addClass("in");
				} else {
					$('#collapseThreeOne').removeClass("in");
				}
				if ($("#shippingAddress_1").is(":checked")) {
					$('#collapseThreeTwo').addClass("in");
				} else {
					$('#collapseThreeTwo').removeClass("in");
				}
				if ($("#shippingAddress_2").is(":checked")) {
					$('#collapseThreeThree').addClass("in");
				} else {
					$('#collapseThreeThree').removeClass("in");
				}
				$('#collapseThreeZero').addClass("in");
			} else {
				$('#collapseThreeOne').removeClass("in");
				$('#collapseThreeTwo').removeClass("in");
				$('#collapseThreeThree').removeClass("in");
				$('#collapseThreeZero').removeClass("in");
			}
		});
		$("#shippingAddress_0").click(function() {
			if ($(this).is(":checked"))
			{
				$('#collapseThreeTwo').removeClass("in");
				$('#collapseThreeThree').removeClass("in");
				$('#collapseThreeOne').addClass("in");
			}
		});
		$("#shippingAddress_1").click(function() {
			if ($(this).is(":checked"))
			{
				$('#collapseThreeOne').removeClass("in");
				$('#collapseThreeThree').removeClass("in");
				$('#collapseThreeTwo').addClass("in");
				document.getElementById('Address_shipping_addressId').value = "";
			}
		});
		$("#shippingAddress_2").click(function() {
			if ($(this).is(":checked"))
			{
				$('#collapseThreeOne').removeClass("in");
				$('#collapseThreeTwo').removeClass("in");
				$('#collapseThreeThree').addClass("in");
				document.getElementById('Address_shipping_addressId').value = "";
			}
		});




		$("#customerType_0").click(function() {
			if ($(this).is(":checked"))
			{
				document.getElementById('billingAddress').style.display = 'none';
				$('#collapseTwoOne').removeClass("in");
				$('#collapseTwoTwo').addClass("in");
			}

		});
		$("#customerType_1").click(function() {
			if ($(this).is(":checked"))
			{
				document.getElementById('billingAddress').style.display = 'none';
				$('#collapseTwoOne').removeClass("in");
				$('#collapseTwoTwo').addClass("in");
			}

		});
		$("#paymentMethod_0").click(function() {
			if ($(this).is(":checked"))
			{
				//document.getElementById('billingAddress').style.display = 'none';
				$('#collapseFourTwo').removeClass("in");
				$('#collapseFourOne').addClass("in");
				//alert('บัตร');
				aa = document.getElementById('submitCheckout');
				aa.removeAttribute("disabled");
			}

		});
		$("#paymentMethod_1").click(function() {
			if ($(this).is(":checked"))
			{
				//document.getElementById('billingAddress').style.display = 'none';
				$('#collapseFourOne').removeClass("in");
				$('#collapseFourTwo').addClass("in");
				//alert('โอน');
				aa = document.getElementById('submitCheckout');
				aa.removeAttribute("disabled");
			}

		});
		$("#sec2next").click(function() {
			if (!$("#billingAddress_1").is(":checked") && !$("#billingAddress_0").is(":checked") && !$("#billingAddress_2").is(":checked"))
			{
				alert('กรุณาเลือกที่อยู่ใบกำกับภาษีจากตัวเลือก');
				return false;
			}
			else if ($("#billingAddress_1").is(":checked"))
			{
				if ($("#Address_billing_company").val() != "" && $("#Address_billing_taxNo").val() == "")
				{
					alert('กรุณากรอกเลขประจำตัวผู้เสียภาษี');
					return false;
				} else
				if (<?php echo isset(Yii::app()->user->id) ? 1 : 0; ?> == 1) {
					if ($("#Address_billing_firstname").val() == "" || $("#Address_billing_lastname").val() == ""
							|| $("#Address_billing_address_1").val() == ""
							|| $("#Address_billing_provinceId").val() == "" || $("#Address_billing_amphurId").val() == ""
							|| $("#Address_billing_districtId").val() == "" || $("#Address_billing_postcode").val() == ""
							|| $("#User_telephone").val() == "") {
						alert('กรุณาระบุข้อมูลที่อยู่ใบกำกับภาษีให้ครบถ้วน');
						return false;
					}

				} else
				if ($("#Address_billing_firstname").val() == "" || $("#Address_billing_lastname").val() == ""
						|| $("#Address_billing_address_1").val() == ""
						|| $("#Address_billing_provinceId").val() == "" || $("#Address_billing_amphurId").val() == ""
						|| $("#Address_billing_districtId").val() == "" || $("#Address_billing_postcode").val() == ""
						|| $("#User_email").val() == "" || $("#User_telephone").val() == "")
				{
					alert('กรุณาระบุข้อมูลที่อยู่ใบกำกับภาษีให้ครบถ้วน');
					return false;
				}
			}
			else if ($("#billingAddress_0").is(":checked"))
			{
				if (document.getElementById("Address_billing_addressId").value == "")
				{
					alert("กรุณาเลือกที่อยู่ใบกำกับภาษีจากรายการ หรือ ระบุที่อยู่ใหม่");
					return false;
				}

			}
			if (checkmail == 1) {
				alert("อีเมลล์นี้ถูกใช้งานแล้ว ไม่สามารถใช้อีเมลล์นี้ได้!!");
				return false;
			}

		});
		$("#User_email").change(function() {
			if ($("#User_email").val() !== "") {
				var url = "<?php echo $urlCheckUser; ?>";
				$.ajax({
					type: "POST",
					url: url,
					data: {userEmail: $("#User_email").val()},
					cache: false,
					success: function(data) {
						if (data === 'USER_EXISTS')
						{
							alert("อีเมลล์นี้ถูกใช้งานแล้ว ไม่สามารถใช้อีเมลล์นี้ได้!!");
							document.getElementById('User_email').focus();
							checkmail = 1;
						}
						else {
							checkmail = 0;
						}
						var Email = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
						if (!Email.test($("#User_email").val())) {
							alert("รูปแบบอีเมลล์ไม่ถูกต้อง กรุณาตรวจสอบอีเมลล์ของท่าน.");
							document.getElementById('User_email').focus();
						}
					}
				});
			}
		});
		$("#sec3next").click(function() {
			if (document.getElementById('isSent').checked) {
				if ((document.getElementById('customerReserve1').value === "" &&
						document.getElementById('customerReserve2').value === "") ||
						(document.getElementById('customerReserve1').value === "" &&
								document.getElementById('customerReserve3').value === "") ||
						(document.getElementById('customerReserve2').value === "" &&
								document.getElementById('customerReserve3').value === ""))
				{
					alert("กรุณาใส่ชื่อผู้รับสินค้าแทนอย่างน้อย 2 รายชื่อ.");
					return false;
				}
			}
			if (document.getElementById('dealerId').value == "")
			{
				alert("กรุณาเลือกตัวแทนจำหน่ายจากรายการ");
				return false;
			}

			if ($("#isSent").is(":checked")) {
				if (!$("#shippingAddress_1").is(":checked") && !$("#shippingAddress_0").is(":checked") && !$("#shippingAddress_2").is(":checked"))
				{
					alert('กรุณาเลือกที่อยู่จัดส่งสินค้าจากตัวเลือก');
					return false;
				}
				else if ($("#shippingAddress_1").is(":checked"))
				{
					if (<?php echo isset(Yii::app()->user->id) ? 1 : 0; ?> == 1) {

						if ($("#Address_shipping_firstname").val() == "" || $("#Address_shipping_lastname").val() == ""
								|| $("#Address_shipping_address_1").val() == ""
								|| $("#Address_shipping_provinceId").val() == "" || $("#Address_shipping_amphurId").val() == ""
								|| $("#Address_shipping_districtId").val() == "" || $("#Address_shipping_postcode").val() == "") {
							alert('กรุณาระบุข้อมูลที่อยู่ในการจัดส่งให้ครบถ้วน');
							return false;
						}

					} else
					if ($("#Address_shipping_firstname").val() == "" || $("#Address_shipping_lastname").val() == ""
							|| $("#Address_shipping_address_1").val() == ""
							|| $("#Address_shipping_provinceId").val() == "" || $("#Address_shipping_amphurId").val() == ""
							|| $("#Address_shipping_districtId").val() == "" || $("#Address_shipping_postcode").val() == ""
							|| $("#User_email").val() == "" || $("#User_telephone").val() == "")
					{
						alert('กรุณาระบุข้อมูลที่อยู่ในการจัดส่งให้ครบถ้วน');
						return false;
					}
				}
				else if ($("#shippingAddress_0").is(":checked"))
				{
					if (document.getElementById("Address_shipping_addressId").value == "")
					{
						alert("กรุณาเลือกที่อยู่จัดส่งสินค้าจากรายการ หรือ ระบุที่อยู่ใหม่");
						return false;
					}

				}
				if (checkmail == 1) {
					alert("อีเมลล์นี้ถูกใช้งานแล้ว ไม่สามารถใช้อีเมลล์นี้ได้!!");
					return false;
				}
			}

		});
		$("#paymentMethod").click(function() {
			m1 = document.getElementById('paymentMethod_0');
			m2 = document.getElementById('paymentMethod_1');
			if (m1.checked || m2.checked) {
				aa = document.getElementById('submitCheckout');
				aa.removeAttribute("disabled");
			}
		});

		document.onkeypress = stopRKey;
	});

	function stopRKey(evt) {
		var evt = (evt) ? evt : ((event) ? event : null);
		var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
		if ((evt.keyCode == 13) && (node.type == "text")) {
			return false;
		}
	}


	function doNothing() {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {

			if (!e)
				var e = window.event;
			e.cancelBubble = true;
			e.returnValue = false;
			$('#btnLogin').click();
			if (e.stopPropagation) {
				e.stopPropagation();
				e.preventDefault();
			}
		}
	}

	/*]]>*/
</script>
<div>

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'checkout-form',
		'enableAjaxValidation'=>false,
	));
	?>
	<?php
	echo $form->errorSummary($model, array(
		"style"=>"color:red"));
	?>
    <div class="accordion" id="accordion2" >
        <div class="accordion-group img-rounded" >
            <div class="accordion-heading img-rounded" style="background: whitesmoke">
                <span class="accordion-toggle icon-user icon-large" data-parent="#accordion2">
                    1. เข้าสู่ระบบหรือสมัครสมาชิก
                </span>
            </div>
            <div id="collapseOne" class="accordion-body collapse in img-rounded" style="background: white">
                <div class="accordion-inner">
                    <div class="row">
                        <div class="span5">
                            <h4>ลูกค้าใหม่</h4>
							<?php
							echo CHtml::radioButtonList("customerType", 1, array(
								'1'=>'ลงทะเบียนใหม่',
								'2'=>'ซื้อในนามบุคคลทั่วไป(ไม่ต้องการเป็นสมาชิก)'), array(
								'separator'=>'</br>',
								'labelOptions'=>array(
									'style'=>'display:inline')))
							?>
                        </div>
                        <div class="span5">
                            <h4>ลูกค้าเก่า</h4>
							<?php echo CHtml::hiddenField("userId", 0); ?>
							<?php
							echo $this->renderPartial("//share/login", array(
								'model'=>$logIn));
							?>
                        </div>
                    </div>
                    <button type="button" id="sec1next" class="btn btn-info" data-toggle="collapse" data-parent="#accordion2" data-target="#collapseTwo">ต่อไป</button>
                </div>
            </div>
        </div>

        <div class="accordion-group" img-rounded>
            <div class="accordion-heading img-rounded" style="background: whitesmoke">
                <span class="accordion-toggle icon-file icon-large" data-parent="#accordion2" href="#collapseTwo">
                    2. ที่อยู่ในการออกใบกำกับภาษี/ใบเสร็จรับเงิน
                </span>
            </div>
            <div id="collapseTwo" class="img-rounded accordion-body collapse" style="background: white">
                <div class="accordion-inner">
					<?php
					$billingAddressArray = array(
						'1'=>'ต้องการเลือกที่อยู่ที่มีอยู่แล้ว',
						'2'=>'ระบุที่อยู่ใบเสร็จ/ใบกำกับภาษี',
					);
					$billingAddressValue = '';

					if(isset($model->orderId))
					{
						$billingAddressArray[3] = 'ที่อยู่ตามรายการที่ได้เลือกไว้ก่อนหน้า';
						$billingAddressValue = 3;
					}

					echo CHtml::radioButtonList("billingAddress", $billingAddressValue, $billingAddressArray, array(
						'separator'=>'</br>',
						'labelOptions'=>array(
							'style'=>'display:inline')))
					?>
					<?php //echo CHtml::radioButtonList("billingAddress")."ต้องการเลือกที่อยู่ที่มีอยู่แล้ว";         ?>
                    <div id="collapseTwoOne" class="accordion-body collapse">
                        <div class="accordion-inner" id="addressList">
							<?php
							if(isset(Yii::app()->user->id))
							{
								echo $this->renderPartial("//address/_address_list", array(
									"type"=>"billing",
									'form'=>$form,
									'userId'=>Yii::app()->user->id));
							}
							?>
                        </div>
                    </div>
					<?php //echo CHtml::radioButton("billingAddress",array("class"=>"accordion-toggle","data-toggle"=>"collapse","data-parent"=>"#accordion2" ,"href"=>"#collapsTwoTwo"))."ระบุที่อยู่ใหม่";           ?>
<!--                      <span class="accordion-toggle" data-toggle="collapse" data-parent="#collapseTwo" href="#collapseTwoTwo">
                            New Address
                    </span>-->
                    <div id="collapseTwoTwo" class="accordion-body collapse">
                        <div class="accordion-inner">
							<?php
							$this->renderPartial("//address/_address", array(
								"model"=>$address,
								"type"=>"billing",
								'form'=>$form,
								'model'=>$address));
							$user = new User();
							?>
							<?php
							if(!isset(Yii::app()->user->id))
							{
								echo $form->labelEx($user, "email");
								echo $form->textField($user, "email");
							}
							?>

							<?php
							echo $form->labelEx($user, "telephone");
							echo $form->textField($user, "telephone");
							?>

							<?php
							echo $form->labelEx($user, "fax");
							echo $form->textField($user, "fax");
							?>
                        </div>
                    </div>
                    <div id="collapseTwoThree" class="accordion-body collapse">
                        <div class="accordion-inner">
                            <address>
                                <strong><?php echo $model->paymentFirstname . ' ' . $model->paymentLastname; ?></strong><br />
								<?php if(!empty($model->paymentCompany)) echo $model->paymentCompany . '<br />'; ?>
								<?php if(!empty($model->paymentAddress1)) echo $model->paymentAddress1 . '<br />'; ?>
								<?php if(!empty($model->paymentAddress2)) echo $model->paymentAddress2 . '<br />'; ?>
								<?php if(!empty($model->shippingProvince)) echo Province::model()->findByPk($model->shippingProvince)->provinceName . '<br />'; ?>
								<?php if(!empty($model->paymentPostcode)) echo $model->paymentPostcode . '<br />'; ?>
								<?php if(!empty($model->telephone)) echo 'โทรศัพท์ : ' . $model->telephone . '<br />'; ?>
								<?php if(!empty($model->fax)) echo 'โทรสาร : ' . $model->fax . '<br />'; ?>
                            </address>
                        </div>
                    </div>
                    <button type="button" id="sec2back" class="btn btn-inverse" data-toggle="collapse" data-parent="#accordion2" data-target="#collapseOne">กลับ</button>
                    <button type="button" id="sec2next" class="btn btn-info" data-toggle="collapse" data-parent="#accordion2" data-target="#collapseThree">ต่อไป</button>
                </div>
            </div>
        </div>

        <div class="accordion-group img-rounded">
            <div class="accordion-heading img-rounded" style="background: whitesmoke">
                <span class="accordion-toggle icon-home icon-large"  data-parent="#accordion2" href="#collapseThree">
                    3. เลือกศูนย์กระจายสินค้าเพื่อรับสินค้า/เลือกส่งสินค้าถึงบ้าน/ที่อยู่จัดส่งสินค้า
                </span>
            </div>
            <div id="collapseThree" class="img-rounded accordion-body collapse" style="background: white">
                <div class="accordion-inner">
					<?php
					echo $this->renderPartial("//share/_dealer_list", array(
						"type"=>"billing",
						'amphurId'=>$amphurId,
						'dealerId'=>$model->dealerId));
					?>
					<?php
					echo "<label><input type='checkbox' id='isSent' name='isSentToCustomer' value='" . TRUE . "' /> <b>ต้องการให้ส่งสินค้าถึงฉันโดยตรง</b></label>";
					echo "กรุณากรอกชื่อผู้รับสินค้าแทน <b>อย่างน้อยสองท่าน</b><br>" . Chtml::textField('customerReserve1', '', array(
						'class'=>'input-large',
						'placeholder'=>'ผู้รับแทนคนที่ 1')) . " " . Chtml::textField('customerReserve2', '', array(
						'class'=>'input-large',
						'placeholder'=>'ผู้รับแทนคนที่ 2')) . " " . Chtml::textField('customerReserve3', '', array(
						'class'=>'input-large',
						'placeholder'=>'ผู้รับแทนคนที่ 3'));
					?><br>

					<div id="collapseThreeZero" class="accordion-body collapse">
                        <div class="accordion-inner">
							<?php
							$shippingAddressArray = array(
								'1'=>'ต้องการเลือกที่อยู่จัดส่งสินค้าที่มีอยู่แล้ว',
								'2'=>'ระบุที่อยู่ในการจัดส่งสินค้า',
							);
							$shippingAddressValue = '';

							if(isset($model->orderId))
							{
								$shippingAddressArray[3] = 'ที่อยู่ตามรายการที่ได้เลือกไว้ก่อนหน้า';
								$shippingAddressValue = 3;
							}

							echo CHtml::radioButtonList("shippingAddress", $shippingAddressValue, $shippingAddressArray, array(
								'separator'=>'</br>',
								'labelOptions'=>array(
									'style'=>'display:inline')))
							?>
						</div>
					</div>

					<div id="collapseThreeOne" class="accordion-body collapse">
                        <div class="accordion-inner" id="addressList">
							<?php
							if(isset(Yii::app()->user->id))
							{
								echo $this->renderPartial("//address/_address_list", array(
									"type"=>"shipping",
									'form'=>$form,
									'userId'=>Yii::app()->user->id));
							}
							?>
                        </div>
                    </div>


					<div id="collapseThreeTwo" class="accordion-body collapse">
                        <div class="accordion-inner">
							<?php
							$this->renderPartial("//address/_address", array(
								"model"=>$address,
								"type"=>"shipping",
								'form'=>$form,
								'model'=>$address));
							?>
							<?php
							if(!isset(Yii::app()->user->id))
							{
								echo $form->labelEx($user, "email");
								echo $form->textField($user, "email");
							}
							?>

							<?php
//							echo $form->labelEx($user, "telephone");
//							echo $form->textField($user, "shippingTelephone");
//
							?>

							<?php
//							echo $form->labelEx($user, "fax");
//							echo $form->textField($user, "fax");
							?>
                        </div>
                    </div>
                    <div id="collapseThreeThree" class="accordion-body collapse">
                        <div class="accordion-inner">
                            <address>
                                <strong><?php echo $model->paymentFirstname . ' ' . $model->paymentLastname; ?></strong><br />
								<?php if(!empty($model->paymentCompany)) echo $model->paymentCompany . '<br />'; ?>
								<?php if(!empty($model->paymentAddress1)) echo $model->paymentAddress1 . '<br />'; ?>
								<?php if(!empty($model->paymentAddress2)) echo $model->paymentAddress2 . '<br />'; ?>
								<?php if(!empty($model->shippingProvince)) echo Province::model()->findByPk($model->shippingProvince)->provinceName . '<br />'; ?>
								<?php if(!empty($model->paymentPostcode)) echo $model->paymentPostcode . '<br />'; ?>
								<?php if(!empty($model->telephone)) echo 'โทรศัพท์ : ' . $model->telephone . '<br />'; ?>
								<?php if(!empty($model->fax)) echo 'โทรสาร : ' . $model->fax . '<br />'; ?>
                            </address>
                        </div>
                    </div>
                    <button type="button" id="sec3back" class="btn btn-inverse" data-toggle="collapse" data-parent="#accordion2" data-target="#collapseTwo">กลับ</button>
                    <button type="button" id="sec3next" class="btn btn-info" data-toggle="collapse" data-parent="#accordion2" data-target="#collapseFour">ต่อไป</button>
                </div>
            </div>
        </div>
		<?php
		if(isset(Yii::app()->user->id))
		{
			$userId = Yii::app()->user->id;
			$collectedPoint = UserReward::model()->sumUserPoints($userId);
			$user = User::model()->findByPk($userId);

//			if($collectedPoint > 0)
//			{
			?>
			<!--				<div class="accordion-group img-rounded">
								<div class="accordion-heading img-rounded" style="background: whitesmoke">
									<span class="accordion-toggle icon-home icon-large"  data-parent="#accordion2" href="#collapseFour">
										4. ใช้คะแนน daiiBuy Rewards.
									</span>
								</div>
								<div id="collapseFour" class="img-rounded accordion-body collapse" style="background: white">
									<div class="accordion-inner">
			<?php
//							if($user->type == 1 || $user->type == 2)
//							{
//								$pointRemain = intval($collectedPoint);
			?>
											<div class="alert alert-info alert-block accordion-body collapse" style="display:inline-table">
												<script>
													function useRewardBtn() {
														pointRemain = <?php // echo $pointRemain;                                                                                              ?>;
														usedPoint = $("#rewardPointId").val();
														//										alert(usedPoint);
														var url = "<?php // echo CController::createUrl('Order/UsePoint');                                                                                              ?>";
														$.ajax({
															dataType: 'json',
															type: "POST",
															url: url,
															data: {rewardPoint: usedPoint},
															cache: false,
															success: function(data) {
																//												alert(usedPoint);
																//												alert(document.getElementById('usedPointOrder').value);
																document.getElementById('usedPointOrder').value = usedPoint;
																//												document.getElementById('usedPointOrder').value = new Number(JSON.parse(usedPoint));

															}
														});
														return false;
													}

													$("#rewardPointIdClick").click(function() {
														pointRemain = <?php // echo $pointRemain;                                                                                              ?>;
														usedPoint = $("#rewardPointId").val();
														var url = "<?php // echo CController::createUrl('Order/UsePoint');                                                                                              ?>";
														$.ajax({
															type: "POST",
															url: url,
															data: {rewardPoint: usedPoint},
															cache: false,
															success: function(data) {
																$("#rewardPointId").value = data['usedPoint'];

															}
														});
														return false;
													});

													$("#rewardPointId").change(function() {
														pointRemain = <?php // echo $pointRemain;                                                                                              ?>;
														usedPoint = $("#rewardPointId").val();
														var url = "<?php // echo CController::createUrl('Order/UsePoint');                                                                                              ?>";
														$.ajax({
															type: "POST",
															url: url,
															data: {rewardPoint: usedPoint},
															cache: false,
															success: function(data) {
																$("#rewardPointId").value = data['usedPoint'];
															}
														});
														return false;
													});
												</script>
												<div class="row">
													<div class="span4">
														<h4>daiiBuy Reward</h4>
													</div>
												</div>
												<div class="row">
													<br/>
													<div class="span5">

														<p><b>คุณมีคะแนน Reward ทั้งหมดที่ใช้ได้ :</b> <?php
//												echo CHtml::textField('pointAll', $pointRemain, array(
//													'class'=>'textbox input-small text-right',
//													'id'=>'allPoint',
//													'disabled'=>'disabled')) . " คะแนน";
			?></p>
														<p><b>คุณมีคะแนน Reward ที่ใช้ไปแล้วใน Order นี้ :</b> <?php
//												echo CHtml::textField('usePoint', $usedPoint, array(
//													'class'=>'textbox input-small text-right',
//													'id'=>'usedPointOrder',
//													'disabled'=>'disabled')) . " คะแนน";
			?></p>
													</div>
												</div>
												<div class="row">
													<div class="span3">
			<?php
//											echo "ใช้คะแนนจำนวน " . CHtml::textField('usedPoint', $collectedPoint, array(
//												'class'=>'textbox input-small text-right',
//												'id'=>'rewardPointId',));
			?>
													</div>
													<div class="span2">
			<?php
//											echo CHtml::link("ใช้คะแนน", "#", array(
//												'class'=>'btn btn-success',
//												'id'=>'rewardPointId',
//												'onclick'=>'useRewardBtn();'));
			?>
													</div>
												</div>
											</div>
			<?php
//							}
			?>
										<br>
										<button type="button" id="sec4back" class="btn btn-inverse" data-toggle="collapse" data-parent="#accordion2" data-target="#collapseThree">กลับ</button>
										<button type="button" id="sec4next" class="btn btn-info" data-toggle="collapse" data-parent="#accordion2" data-target="#collapseFive">ต่อไป</button>
									</div>
								</div>
							</div>-->
			<!--				<div class="accordion-group img-rounded">
								<div class="accordion-heading img-rounded" style="background: whitesmoke">
									<span class="accordion-toggle icon-shopping-cart icon-large"  data-parent="#accordion2" href="#collapseFour">-->
			<!--							5. ช่องทางการชำระเงิน
									</span>
								</div>
								<div id="collapseFive" class="accordion-body collapse img-rounded" style="background: white">
									<div class="accordion-inner">
										<script>
											$("#paymentMethod").click(function() {
												m1 = document.getElementById('paymentMethod_0');
												m2 = document.getElementById('paymentMethod_1');
												if (m1.checked || m2.checked) {
													aa = document.getElementById('submitCheckout');
													aa.removeAttribute("disabled");
												}
											});
										</script>
										//<?php
//							echo CHtml::radioButtonList("paymentMethod", (isset($model->paymentMethod)) ? $model->paymentMethod : '', array(
//								"1"=>"ชำระเงินออนไลน์",
//								"2"=>"โอนเงิน"), array(
//								'separator'=>'</br>',
//								'labelOptions'=>array(
//									'style'=>'display:inline')));
			?>
										<div id="collapseFiveOne" class="accordion-body collapse">
											<div class="accordion-inner">
												<p>ชำระค่าสินค้าผ่านระบบ ออนไลน์ e-Payment Of Krungsri Bank</p>
												<img src="<?php // echo Yii::app()->baseUrl . "/images/krungsri.jpg"                                                                                             ?>" class="img-rounded">
												<div id="lblTest"></div>
											</div>
										</div>
										<div id="collapseFiveTwo" class="accordion-body collapse">
											<div class="accordion-inner">
			<?php // $this->renderPartial("transfer_form");  ?>
												<div id="lblTest"></div>
											</div>
										</div>
										<button type="button" class="btn btn-inverse" data-toggle="collapse" data-parent="#accordion2" data-target="#collapseFour">กลับ</button>
																<button type="button" class="btn btn-info" data-toggle="collapse" data-parent="#accordion2" data-target="#collapseFive">ต่อไป</button>
										//<?php
//							echo CHtml::link('ซื้อสินค้าเพิ่มเติม', Yii::app()->createUrl(''), array(
//								'class'=>'btn btn-info btn-small',));
//
//							if(isset($model))
//							{
//								if($model->paymentMethod == "2" || $model->paymentMethod == "3")
//									echo CHtml::submitButton('ชำระเงินค่าสินค้า', array(
//										'class'=>'btn btn-success btn-small',
//										'id'=>'submitCheckout'
//									));
//								else
//									echo CHtml::submitButton('ชำระเงินค่าสินค้า', array(
//										'class'=>'btn btn-success btn-small',
//										'id'=>'submitCheckout',
//										'disabled'=>'disabled'
//									));
//							}else
//							{
//								echo CHtml::submitButton('ชำระเงินค่าสินค้า', array(
//									'class'=>'btn btn-success btn-small',
//									'id'=>'submitCheckout',
//									'disabled'=>'disabled'
//								));
//							}
			?>
									</div>
								</div>
							</div>-->

			<?php
//			}
//			else
//			{
			?>
			<div class="accordion-group img-rounded">
				<div class="accordion-heading img-rounded" style="background: whitesmoke">
					<span class="accordion-toggle icon-shopping-cart icon-large"  data-parent="#accordion2" href="#collapseFour">
						4. ช่องทางการชำระเงิน
					</span>
				</div>
				<div id="collapseFour" class="accordion-body collapse img-rounded" style="background: white">
					<div class="accordion-inner">
						<script>
							$("#paymentMethod").click(function() {
								m1 = document.getElementById('paymentMethod_0');
								m2 = document.getElementById('paymentMethod_1');
								if (m1.checked || m2.checked) {
									aa = document.getElementById('submitCheckout');
									aa.removeAttribute("disabled");
								}
							});
						</script>
						<?php
						echo CHtml::radioButtonList("paymentMethod", (isset($model->paymentMethod)) ? $model->paymentMethod : '', array(
							"1"=>"ชำระเงินออนไลน์",
							"2"=>"โอนเงิน"), array(
							'separator'=>'</br>',
							'labelOptions'=>array(
								'style'=>'display:inline')));
						?>
						<div id="collapseFourOne" class="accordion-body collapse">
							<div class="accordion-inner">
								<p>ชำระค่าสินค้าผ่านระบบ ออนไลน์ e-Payment Of Krungsri Bank</p>
								<img src="<?php echo Yii::app()->baseUrl . "/images/krungsri.jpg" ?>" class="img-rounded">
								<div id="lblTest"></div>
							</div>
						</div>
						<div id="collapseFourTwo" class="accordion-body collapse">
							<div class="accordion-inner">
								<?php
								if(isset($supplierModel->userId))
									$this->renderPartial("transfer_form_print1", array(
										'supplierId'=>$supplierModel->userId));
								?>
								<div id="lblTest"></div>
							</div>
						</div>
						<button type="button" class="btn btn-inverse" data-toggle="collapse" data-parent="#accordion2" data-target="#collapseThree">กลับ</button>
						<?php
						echo CHtml::link('ซื้อสินค้าเพิ่มเติม', Yii::app()->createUrl(''), array(
							'class'=>'btn btn-info btn-small',));

						if(isset($model))
						{
							if($model->paymentMethod == "2" || $model->paymentMethod == "3")
								echo CHtml::submitButton('ชำระเงินค่าสินค้า', array(
									'class'=>'btn btn-success btn-small',
									'id'=>'submitCheckout'
								));
							else
								echo CHtml::submitButton('ชำระเงินค่าสินค้า', array(
									'class'=>'btn btn-success btn-small',
									'id'=>'submitCheckout',
									'disabled'=>'disabled'
								));
						}else
						{
							echo CHtml::submitButton('ชำระเงินค่าสินค้า', array(
								'class'=>'btn btn-success btn-small',
								'id'=>'submitCheckout',
								'disabled'=>'disabled'
							));
						}
						?>
					</div>
				</div>
			</div>

			<?php
//			}
		}
		else
		{
			?>
			<div class="accordion-group img-rounded">
				<div class="accordion-heading img-rounded" style="background: whitesmoke">
					<span class="accordion-toggle icon-shopping-cart icon-large"  data-parent="#accordion2" href="#collapseFour">
						4. ช่องทางการชำระเงิน
					</span>
				</div>
				<div id="collapseFour" class="accordion-body collapse img-rounded" style="background: white">
					<div class="accordion-inner">
						<script>
							$("#paymentMethod").click(function() {
								m1 = document.getElementById('paymentMethod_0');
								m2 = document.getElementById('paymentMethod_1');
								if (m1.checked || m2.checked) {
									aa = document.getElementById('submitCheckout');
									aa.removeAttribute("disabled");
								}
							});
						</script>
						<?php
						echo CHtml::radioButtonList("paymentMethod", (isset($model->paymentMethod)) ? $model->paymentMethod : '', array(
							"1"=>"ชำระเงินออนไลน์",
							"2"=>"โอนเงิน"), array(
							'separator'=>'</br>',
							'labelOptions'=>array(
								'style'=>'display:inline')));
						?>
						<div id="collapseFourOne" class="accordion-body collapse">
							<div class="accordion-inner">
								<p>ชำระค่าสินค้าผ่านระบบ ออนไลน์ e-Payment Of Krungsri Bank</p>
								<img src="<?php echo Yii::app()->baseUrl . "/images/krungsri.jpg" ?>" class="img-rounded">
								<div id="lblTest"></div>
							</div>
						</div>
						<div id="collapseFourTwo" class="accordion-body collapse">
							<div class="accordion-inner">
								<?php
								if(isset($supplierId))
									$this->renderPartial("transfer_form_print1", array(
										'supplierId'=>$supplierId));
								?>
								<div id="lblTest"></div>
							</div>
						</div>
						<button type="button" class="btn btn-inverse" data-toggle="collapse" data-parent="#accordion2" data-target="#collapseThree">กลับ</button>
						<?php
						echo CHtml::link('ซื้อสินค้าเพิ่มเติม', Yii::app()->createUrl(''), array(
							'class'=>'btn btn-info btn-small',));
						if(isset($model))
						{
							if($model->paymentMethod == "2" || $model->paymentMethod == "3")
								echo CHtml::submitButton('ชำระเงินค่าสินค้า', array(
									'class'=>'btn btn-success btn-small',
									'id'=>'submitCheckout'
								));
							else
								echo CHtml::submitButton('ชำระเงินค่าสินค้า', array(
									'class'=>'btn btn-success btn-small',
									'id'=>'submitCheckout',
									'disabled'=>'disabled'
								));
						}else
						{
							echo CHtml::submitButton('ชำระเงินค่าสินค้า', array(
								'class'=>'btn btn-success btn-small',
								'id'=>'submitCheckout',
								'disabled'=>'disabled'
							));
						}
						?>
					</div>
				</div>
			</div>
			<?php
		}
		?>
	</div>
	<?php $this->endWidget(); ?>
</div>