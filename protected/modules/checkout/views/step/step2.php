<?php
$this->renderPartial('_step_header', array(
	'step'=>$step));
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'address-form',
	//'enableClientValidation' => true,
//'clientOptions' => array('validateOnSubmit' => true,),
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'role'=>'form'),
	));
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

    <div class="col-md-6 register-account">
        <div class="carousel-heading no-margin">
            <h4>ที่อยู่สำหรับใบเสร็จ</h4>
        </div>

        <div class="page-content">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p>
						<?php
						echo CHtml::radioButton('billingRadio', false, array(
							'id'=>'billingRadio',
							'value'=>1));
						?>
                        <label class="radio-label" for="billingRadio">เลือก</label>
                    </p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
					<?php
					echo CHtml::dropDownList('existingBillingAddress', '', $shippingAddressModel->getAllAddressByType(Address::ADDRESS_TYPE_BILLING, $this->cookie->provinceId), array(
						'class'=>'chosen-select-full-width',
						'prompt'=>' --- Select ---',
						'onchange'=>'ChkRadioBillAddress(1,this)'));
					?>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p>
						<?php
						echo CHtml::radioButton('billingRadio', false, array(
							'id'=>'newBillingRadio',
							'value'=>2));
						?>
                        <label class="radio-label" for="newBillingRadio">ที่อยู่ใหม่</label>
                    </p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($billingAddressModel, 'firstname'); ?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
					<?php
					echo $form->textField($billingAddressModel, 'firstname', array(
						'id'=>'billingFirstName',
						'name'=>'billing[firstname]',
						'onchange'=>'ChkRadioBillAddress(2,null)'));
					?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($billingAddressModel, 'lastname'); ?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
					<?php
					echo $form->textField($billingAddressModel, 'lastname', array(
						'id'=>'billingLastName',
						'name'=>'billing[lastname]'));
					?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($billingAddressModel, 'company'); ?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
					<?php
					echo $form->textField($billingAddressModel, 'company', array(
						'id'=>'billingCompany',
						'name'=>'billing[company]'));
					?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($billingAddressModel, 'address_1'); ?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
					<?php
					echo $form->textField($billingAddressModel, 'address_1', array(
						'id'=>'billingAddress1',
						'name'=>'billing[address_1]'));
					?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($billingAddressModel, 'address_2'); ?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
					<?php
					echo $form->textField($billingAddressModel, 'address_2', array(
						'id'=>'billingAddress2',
						'name'=>'billing[address_2]'));
					?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($billingAddressModel, 'provinceId'); ?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
					<?php
					$province = Province::model()->findByPk($this->cookie->provinceId);
					echo $province->provinceName;
//					echo $form->dropDownList($billingAddressModel, 'provinceId', CHtml::listData(Province::model()->findAll(array(
//								'order'=>'provinceName')), 'provinceId', 'provinceName'), array(
//						'id'=>'billingProvince',
//						'name'=>'billing[provinceId]',
//						'prompt'=>' --- เลือกจังหวัด ---',
//						'ajax'=>array(
//							'type'=>'POST',
//							'data'=>array(
//								'provinceId'=>'js:this.value'),
//							'url'=>$this->createUrl('findAmphur'),
//							'success'=>'js:function(data){
//                                    $("#billingAmphur").html(data);
//                                    $("#billingAmphur").prop("disabled", false);
//                                    $("#billingDistrict").html("");
//                                    $("#billingDistrict").prop("disabled", true);
//                                }',
//						),
//					));
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4">
					<p><?php echo $form->labelEx($billingAddressModel, 'amphurId'); ?></p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8" id="">
					<?php
					echo $form->dropDownList($billingAddressModel, 'amphurId',
						//CHtml::listData($billingAddressModel->province->amphurs, 'amphurId', 'amphurName'),
						array(), array(
//                            'class'=>'chosen-select-full-width',
						'id'=>'billingAmphur',
						'name'=>'billing[amphurId]',
						'ajax'=>array(
							'type'=>'POST',
							'data'=>array(
								'amphurId'=>'js:this.value'),
							'url'=>$this->createUrl('findDistrict'),
							'success'=>'js:function(data){
                                    $("#billingDistrict").html(data);
                                    $("#billingDistrict").prop("disabled", false);
                                }',
						),
						)
					);
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4">
					<p><?php echo $form->labelEx($billingAddressModel, 'districtId'); ?></p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<?php
					echo $form->dropDownList($billingAddressModel, 'districtId',
						//CHtml::listData($billingAddressModel->amphur->districts, 'districtId', 'districtName'),
						array(), array(
//                            'class'=>'chosen-select-full-width',
						'id'=>'billingDistrict',
						'name'=>'billing[districtId]'
						)
					);
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4">
					<p><?php echo $form->labelEx($billingAddressModel, 'postcode'); ?></p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<?php
					echo $form->textField($billingAddressModel, 'postcode', array(
						'id'=>'billingPostcode',
						'name'=>'billing[postcode]'));
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4">
					<p><?php echo $form->labelEx($billingAddressModel, 'taxNo'); ?></p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<?php
					echo $form->textField($billingAddressModel, 'taxNo', array(
						'id'=>'billingTaxNo',
						'name'=>'billing[taxNo]'));
					?>
				</div>
			</div>
		</div>
	</div>


	<?php
	/**
	 * Shipping Address
	 */
	?>
	<div class="col-md-6 register-account">
		<div class="carousel-heading no-margin">
			<h4>ที่อยู่สำหรับจัดส่งสินค้า</h4>
		</div>

		<div class="page-content">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4">
					<p>
						<?php
						echo CHtml::radioButton('shippingRadio', false, array(
							'id'=>'shippingRadio',
							'value'=>1));
						?>
						<label class="radio-label" for="shippingRadio">เลือก</label>
					</p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<?php
					echo CHtml::dropDownList('existingShippingAddress', '', $shippingAddressModel->getAllAddressByType(Address::ADDRESS_TYPE_SHIPPING, $this->cookie->provinceId), array(
						'class'=>'chosen-select-full-width',
						'prompt'=>'--- Select ---',
						'onchange'=>'ChkRadioShipAddress(1,this)'));
					?>
				</div>
			</div>
			<hr />
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4">
					<p>
						<?php
						echo CHtml::radioButton('shippingRadio', false, array(
							'id'=>'newShippingRadio',
							'value'=>2));
						?>
						<label class="radio-label" for="newShippingRadio">ที่อยู่ใหม่</label>
					</p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<?php
					echo CHtml::checkBox('sameAddress', false, array(
						'id'=>'sameAddress'));
					?>
					<label for="sameAddress">ใช้ที่อยู่เดียวกับใบเสร็จ</label>
				</div>
			</div>
			<br />
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4">
					<p><?php echo $form->labelEx($shippingAddressModel, 'firstname'); ?></p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<?php
					echo $form->textField($shippingAddressModel, 'firstname', array(
						'id'=>'shippingFirstName',
						'name'=>'shipping[firstname]',
						'onchange'=>'ChkRadioShipAddress(2,null)'));
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4">
					<p><?php echo $form->labelEx($shippingAddressModel, 'lastname'); ?></p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<?php
					echo $form->textField($shippingAddressModel, 'lastname', array(
						'id'=>'shippingLastName',
						'name'=>'shipping[lastname]'));
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4">
					<p><?php echo $form->labelEx($shippingAddressModel, 'company'); ?></p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<?php
					echo $form->textField($shippingAddressModel, 'company', array(
						'id'=>'shippingCompany',
						'name'=>'shipping[company]'));
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4">
					<p><?php echo $form->labelEx($shippingAddressModel, 'address_1'); ?></p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<?php
					echo $form->textField($shippingAddressModel, 'address_1', array(
						'id'=>'shippingAddress1',
						'name'=>'shipping[address_1]'));
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4">
					<p><?php echo $form->labelEx($shippingAddressModel, 'address_2'); ?></p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<?php
					echo $form->textField($shippingAddressModel, 'address_2', array(
						'id'=>'shippingAddress2',
						'name'=>'shipping[address_2]'));
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4">
					<p><?php echo $form->labelEx($shippingAddressModel, 'provinceId'); ?></p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<?php
					echo $province->provinceName;
//					echo $form->dropDownList($shippingAddressModel, 'provinceId', CHtml::listData(Province::model()->findAll(array(
//								'order'=>'provinceName')), 'provinceId', 'provinceName'), array(
//						'id'=>'shippingProvince',
//						'name'=>'shipping[provinceId]',
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
					<p><?php echo $form->labelEx($shippingAddressModel, 'amphurId'); ?></p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<?php
					echo $form->dropDownList($shippingAddressModel, 'amphurId', array(), array(
//                            'class'=>'chosen-select-full-width',
						'id'=>'shippingAmphur',
						'name'=>'shipping[amphurId]',
						'disabled'=>'disabled',
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
					<p><?php echo $form->labelEx($shippingAddressModel, 'districtId'); ?></p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<?php
					echo $form->dropDownList($shippingAddressModel, 'districtId', array(), array(
//                            'class'=>'chosen-select-full-width',
						'id'=>'shippingDistrict',
						'name'=>'shipping[districtId]',
						'disabled'=>'disabled'
						)
					);
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4">
					<p><?php echo $form->labelEx($shippingAddressModel, 'postcode'); ?></p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<?php
					echo $form->textField($shippingAddressModel, 'postcode', array(
						'id'=>'shippingPostcode',
						'name'=>'shipping[postcode]'));
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4">
					<p><?php echo $form->labelEx($shippingAddressModel, 'taxNo'); ?></p>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<?php
					echo $form->textField($shippingAddressModel, 'taxNo', array(
						'id'=>'shippingTaxNo',
						'name'=>'shipping[taxNo]'));
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="page-content">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
			<?php
			echo CHtml::link('&lt; Back', '', array(
				'class'=>'button orange',
				'name'=>'Back'));
			?>
			<?php
			echo CHtml::submitButton('Next >', array(
				'class'=>'big green pull-right',
				'name'=>'Next'));
			?>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>

<?php
Yii::app()->clientScript->registerScript('sameAddress', "
    $('#sameAddress').change(function(){
        var addressType = ['billing', 'shipping'];
        var addressTextField = ['FirstName', 'LastName', 'Company', 'Address1', 'Address2', 'Postcode', 'TaxNo'];
        var addressListField = ['District', 'Amphur', 'Province'];
        if ($(this).is(':checked')) {
            for(var j in addressTextField) {
                $('#shipping'+addressTextField[j]).val($('#billing'+addressTextField[j]).val());
            }

            for(var i in addressListField) {
                $('#shipping'+addressListField[i]).html($('#billing'+addressListField[i]).html());
                $('#shipping'+addressListField[i]).prop('disabled', false);
            }
        }
    });
");
?>
