<div class="row">

    <div class="col-lg-9 col-md-9 col-sm-9">

        <div class="carousel-heading">
            <h4>Payment Method</h4>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="carousel-heading no-margin">
                    <h4>
                        <input type="radio" name="aaa" id="card1"/>
                        <label class="radio-label" for="card1"><i class="icons fa fa-credit-card"></i>
                            บัตรเครดิต</label>
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
                        <input type="radio" name="aaa" id="trans"/>
                        <label class="radio-label" for="trans"><i class="icons fa fa-money"></i> โอนเงิน</label>
                    </h4>
                </div>

                <div class="page-content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p>
                            <ul>
                                <li>ธนาคารกรุงเทพ</li>
                                <li>ธนาคารกรุงศรีอยุธยา</li>
                                <li>ธนาคารธนชาต</li>
                            </ul>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-3 col-md-3 col-sm-3">

        <div class="row sidebar-box blue">

            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="sidebar-box-heading">
                    <i class="icons icon-box-2"></i>
                    <h4>Summary</h4>
                </div>

                <div class="sidebar-box-content sidebar-padding-box">
                    <table class="orderinfo-table table-bordered">
                        <tbody>
                        <tr>
                            <td class="align-right"><span class="price big">Total</span></td>
                            <td class="align-right" style="width: 169px;"><span class="price big">2,000,000.00</span>
                            </td>
                        </tr>

                        <tr>
                            <td class="align-right"><span class="price big">Discount</span></td>
                            <td class="align-right" style="width: 169px;"><span class="price big">2,000,000.00</span>
                            </td>
                        </tr>

                        <tr>
                            <td class="align-right"><span class="price big">Grand Total</span></td>
                            <td class="align-right" style="width: 169px;"><span class="price big">2,000,000.00</span>
                            </td>
                        </tr>

                        </tbody>
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
            <?php echo CHtml::submitButton('Check out', array('class' => 'big green pull-right', 'name' => 'Register')); ?>
        </div>
    </div>
</div>