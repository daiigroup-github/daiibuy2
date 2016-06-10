<div class="row sidebar-box blue">

    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="sidebar-box-heading">
            <i class="icons icon-box-2"></i>
            <h4>รวมทั้งสิ้น</h4>
        </div>

        <div class="sidebar-box-content sidebar-padding-box">

            <table class="orderinfo-table table-bordered">

                <tr>
                    <td class="align-right"><span class="price big">รวม</span></td>
                    <td class="align-right" style="width: 169px;"><span class="price big" id="summaryTotal"><?php echo $orderSummary['total']; ?></span></td>
                </tr>

                <tr>
                    <td class="align-right"><span class="price big">ส่วนลด (<span id="summaryDiscountPercent"><?php echo $orderSummary['discountPercent']; ?></span>%)</span></td>
                    <td class="align-right" style="width: 169px;"><span class="price big" id="summaryDiscount"><?php echo $orderSummary['discount']; ?></span></td>
                <tr>
                    <td class="align-right"><span class="price big">รวมหลังหักส่วนลด</span></span></td>
                    <td class="align-right" style="width: 169px;"><span class="price big" id="summaryDiscount"><?php echo $orderSummary['totalPostSupplierRangeDiscount']; ?></span></td>
                </tr>
                </tr>

                <?php
//				throw new Exception(print_r(, true));
                if (isset(Yii::app()->user->id))
                //throw new Exception(Yii::app()->user->id);
                    $user = User::model()->findByPk(Yii::app()->user->id);
                if (isset(Yii::app()->user->id) && (Yii::app()->user->userType == 2 || isset($user->partnerCode))):
//					echo $orderSummary['partnerDiscount'];

                    if (isset($orderSummary['partnerDiscount'])) {
                        if ($orderSummary['partnerDiscountPercent'] == '-1') {
                            ?>
                            <tr>
                                <td class="align-right"><span class="price big">ส่วนลดพาร์ทเนอร์(<span id="partnerDiscountPercent">เงินสด</span>)</span></td>
                                <td class="align-right" style="width: 169px;"><span class="price big" id="partnerDiscount"><?php echo $orderSummary['partnerDiscount']; ?></span></td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td class="align-right"><span class="price big">ส่วนลดพาร์ทเนอร์(<span id="partnerDiscountPercent"><?php echo $orderSummary['partnerDiscountPercent']; ?></span>%)</span></td>
                                <td class="align-right" style="width: 169px;"><span class="price big" id="partnerDiscount"><?php echo $orderSummary['partnerDiscount']; ?></span></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td class="align-right"><span class="price big">รวมหลังหักส่วนลดพาร์ทเนอร์</span></span></td>
                            <td class="align-right" style="width: 169px;"><span class="price big" id="totalPostPartnerDiscount"><?php echo $orderSummary['totalPostPartnerDiscount']; ?></span></td>
                        </tr>


                        <?php
                    } else if (isset($orderSummary['distributorDiscount'])) {
                        ?>
                        <tr>
                            <td class="align-right"><span class="price big">ส่วนลดตัวแทนจำหน่าย (<span id="summaryDiscountPercent"><?php echo $orderSummary['distributorDiscountPercent']; ?></span>%)</span></td>
                            <td class="align-right" style="width: 169px;"><span class="price big" id="summaryDiscount"><?php echo $orderSummary['distributorDiscount']; ?></span></td>
                        </tr>
                        <tr>
                            <td class="align-right"><span class="price big">รวมหลังหักส่วนลดตัวแทนจำหน่าย</span></span></td>
                            <td class="align-right" style="width: 169px;"><span class="price big" id="summaryDiscount"><?php echo $orderSummary['totalPostDistributorDiscount']; ?></span></td>
                        </tr>
                        <?php
                    }
                endif;
                ?>

                <?php if (isset($orderSummary["extraDiscount"])): ?>
                    <tr>
                        <td class="align-right"><span class="price big">ส่วนลดพิเศษ </span></td>
                        <td class="align-right" style="width: 169px;"><span class="price big" id="summaryDiscount"><?php echo $orderSummary["extraDiscount"]; ?></span></td>
                    </tr>
                <?php endif; ?>

                <tr>
                    <td class="align-right"><span class="price big">รวมทั้งสิ้น</span></td>
                    <td class="align-right" style="width: 169px;"><span class="price big" id="summaryGrandTotal"><?php echo $orderSummary['grandTotal']; ?></span></td>
                </tr>

            </table>
        </div>
    </div>

</div>
