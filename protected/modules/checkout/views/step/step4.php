<?php $this->renderPartial('_step_header', array('step' => $step)); ?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'payment-form',
    //'enableClientValidation' => true,
    //'clientOptions' => array('validateOnSubmit' => true,),
    'htmlOptions' => array('class' => '', 'role'=>'form'),
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
								<?php foreach($bankArray as $bank){ ?>
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
                            <td class="align-right" style="width: 169px;"><span class="price big" id="summaryTotal"><?php echo $orderSummary['total'];?></span></td>
                        </tr>

                        <tr>
                            <td class="align-right"><span class="price big">Discount (<span id="summaryDiscountPercent"><?php echo $orderSummary['discountPercent'];?></span>%)</span></td>
                            <td class="align-right" style="width: 169px;"><span class="price big" id="summaryDiscount"><?php echo $orderSummary['discount'];?></span></td>
                        </tr>

                        <tr>
                            <td class="align-right"><span class="price big">Grand Total</span></td>
                            <td class="align-right" style="width: 169px;"><span class="price big" id="summaryGrandTotal"><?php echo $orderSummary['grandTotal'];?></span></td>
                        </tr>

                    </table>

                </div>
            </div>

        </div>
    </div>
</div>

<div class="page-content">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php echo CHtml::link('&lt; Back', '', array('class' => 'button orange', 'name' => 'Register')); ?>
            <?php echo CHtml::submitButton('Payment', array('class' => 'big green pull-right', 'name' => 'Payment')); ?>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>
