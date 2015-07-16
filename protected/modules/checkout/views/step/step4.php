<?php
$this->renderPartial('_step_header', array(
	'step'=>$step));
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'payment-form',
	//'enableClientValidation' => true,
	//'clientOptions' => array('validateOnSubmit' => true,),
	'htmlOptions'=>array(
		'class'=>'',
		'role'=>'form'),
	));
?>
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="carousel-heading">
            <h4>Payment Method</h4>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="carousel-heading no-margin">
                    <h4>
                        <input type="radio" name="paymentMethod" id="card" value="1" />
                        <label class="radio-label" for="card"><i class="icons fa fa-credit-card"></i> บัตรเครดิต</label>
                    </h4>
                </div>

                <div class="page-content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p>
                                ชำระเงินออนไลน์ผ่านระบบ Krungsri e-Payment
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="carousel-heading no-margin">
                    <h4>
                        <input type="radio" name="paymentMethod" id="trans" value="2" />
                        <label class="radio-label" for="trans"><i class="icons fa fa-money"></i> โอนเงิน</label>
                    </h4>
                </div>

                <div class="page-content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p>
                            <ul>
								<?php
								foreach($bankArray as $bank)
								{
									?>
									<li><?php echo BankName::model()->getBankNameByBankNameId($bank->bankNameId) . " ชื่อบัญชี : " . $bank->accName ?></li>
								<?php } ?>
                            </ul>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-4 col-md-4 col-sm-4">

        <div class="row sidebar-box blue">

            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="sidebar-box-heading">
                    <i class="icons icon-box-2"></i>
                    <h4>Summary</h4>
                </div>

                <div class="sidebar-box-content sidebar-padding-box">
                    <table class="orderinfo-table table-bordered">

                        <tr>
                            <td class="align-right"><span class="price big">Total</span></td>
                            <td class="align-right" style="width: 169px;"><span class="price big" id="summaryTotal"><?php echo $orderSummary['total']; ?></span></td>
                        </tr>

                        <tr>
                            <td class="align-right"><span class="price big">Discount (<span id="summaryDiscountPercent"><?php echo $orderSummary['discountPercent']; ?></span>%)</span></td>
                            <td class="align-right" style="width: 169px;"><span class="price big" id="summaryDiscount"><?php echo $orderSummary['discount']; ?></span></td>
                        </tr>
						<?php
//						throw new Exception(print_r($orderSummary, TRUE));
						if(isset($orderSummary['extraDiscount'])):
							?>
							<tr>
								<td class="align-right"><span class="price big">Spacial Discount (<span id="summaryDiscountPercent"><?php echo $orderSummary['extraDiscountArray']['extraDiscountPercent']; ?></span>%)</span></td>
								<td class="align-right" style="width: 169px;"><span class="price big" id="summaryDiscount"><?php echo $orderSummary['extraDiscount']; ?></span></td>
							</tr>
						<?php endif; ?>
                        <tr>
                            <td class="align-right"><span class="price big">Grand Total</span></td>
                            <td class="align-right" style="width: 169px;"><span class="price big" id="summaryGrandTotal"><?php echo $orderSummary['grandTotal']; ?></span></td>
                        </tr>

                    </table>

                </div>
            </div>

        </div>
    </div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="carousel-heading">
            <h4>กรุณาอ่านและยอมรับ ข้อตกลงและเงื่อนไขการชำระเงิน</h4>
		</div>

		<div class="page-content">

			<?php
			$orderSummary['grandTotal'] = str_replace(",", "", $orderSummary['grandTotal']);
			if(doubleval($supplierModel->minimumOrder) > doubleval($orderSummary['grandTotal'])):
				?>
				<br />
				<p class="alert alert-danger text-center">
					เนื่องจากยอดซื้อของลูกค้า <?php echo number_format(doubleval($orderSummary['grandTotal']), 2); ?> บาท ไม่ถึงจำนวนเงินขั้นต่ำของผู้ขายกำหนด <?php echo number_format(doubleval($supplierModel->minimumOrder), 2); ?> บาท
					ผู้ขายจะจัดส่งสินค้าไปที่ศูนย์กระจายสินค้าประจำจังหวัด เพื่อให้ลูกค้ามารับด้วยตนเอง
				</p>
				<br />
			<?php endif; ?>

			<input type="checkbox" name="accept" id="accept" />
			<label class="checkbox-label" for="accept"> ฉันได้อ่านและยอมรับ <a id="readTermCondition" style="text-decoration: underline;color: red" href="#" >ข้อตกลงและเงื่อนไข</a> การสั่งซื้อสินค้า ของ www.daiibuy.com</label>
		</div>
	</div>
</div>
<div class="modal fade " id="termAndConditionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog" style="width:900px">
		<?php $content = Content::model()->findByPk(16); ?>
		<div class="modal-content">
			<div class="modal-header">
				<div class="carousel-heading">
					<?php //<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>   ?>
					<h4 class="modal-title" id="myModalLabel"><?php echo $content->title; ?></h4>
				</div>
			</div>
			<div class="modal-body">
				<?php echo $content->description; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal" id="acceptModal">Accept</button>
				<?php //<button type="button" class="btn btn-primary">Save changes</button>   ?>
			</div>
		</div>
	</div>
</div>

<div class="page-content">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
			<?php
			echo CHtml::link('&lt; Back', 'javascript:window.history.back();', array(
				'class'=>'button orange',
				'name'=>'Register'));
			?>
			<?php
			echo CHtml::submitButton('Payment', array(
				'class'=>'big green pull-right',
				'name'=>'Payment',
				'onClick'=>'return checkAcceptAgreement()'));
			?>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>
