<?php
/* @var $this OrderController */
/* @var $model Order */
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

$this->breadcrumbs = array(
    'Orders' => array(
        'index'),
    $model->orderGroupId,
);

$supplier = Supplier::model()->findByPk($model->supplierId);
//$dealer = user::model()->findByPk($model->dealerId);
//$supplierAddr = Address::model()->find("userId=:userId", array(
//	":userId"=>$model->supplierId));
//$dealerAddr = Address::model()->find("userId=:userId", array(
//	":userId"=>$model->dealerId));
//$daiiAddr = Address::model()->findByPk(1);
$daiiAddr = Configuration::model()->find("name = 'daii-address'");
if (isset(Yii::app()->user->id)) {
    $user = User::model()->findByPk(Yii::app()->user->id);
}
//$discount = isset($daiibuy->discount[$model->supplierId]) ? $daiibuy->discount[$model->supplierId] : $model->usedPoint;
$pointToBahtConfig = Configuration::model()->getPointToBaht();
$pointToBaht = (float) $pointToBahtConfig->value;
//$margin = $model->getSupplierMarginToDaiiBuy();
?>

<div class="row">
    <div class="col-md-12">

        <?php
        if ((Yii::app()->controller->action->id == "view" || Yii::app()->controller->action->id == "UserConfirmFromMail") && Yii::app()->controller->id == "order") {

            $this->renderPartial("_actions", array(
                'model' => $model,
                'pageText' => $pageText,
                'user' => $user,
                'token' => isset($token) ? $token : NULL));
            $this->renderPartial("_files", array(
                'model' => $model));
        }
        ?>

        <style type="text/css">
            <!--
            @media print {
                div.page  {
                    height: 100%;
                    margin: 0px 0px 0px 0px;
                }
            }
            -->
        </style>
        <?php
        if ((Yii::app()->controller->action->id != "printPayForm")) {
            ?>
            <div class="img-rounded" style="background-color:white; border: 2px; border-color: #dddddd; border-style: solid;">
                <?php if ($this->action->id != "view"): ?>
                    <?php
                    $this->renderPartial("_header", array(
                        'model' => $model,
                        'daiiAddr' => $daiiAddr,
                        'pageText' => $pageText,
                        'supplier' => $supplier
                    ));
                    ?>
                    <?php
                    $this->renderPartial("_header_address", array(
                        'model' => $model,
                        'user' => $user,
                    ));
                    ?>
                    <?php endif; ?>
                    <div class="col-lg-12">
                        <h2>
                                <?php echo isset($model->paymentCompany) ? $model->paymentCompany : $model->paymentFirstname . " " . $model->paymentLastname; ?>
                            </h2>
                    </div>
                    <?php
                $this->renderPartial("_items", array(
                    'model' => $model,
                    'user' => $user,
                ));
                ?>
            </div>
            <?php
        }
        ?>
    </div><?php
    if (Yii::app()->controller->action->id == "printPayForm") {
        ?>

        <div class="row">
            <?php
            if ($model->status == 1) {
                ?>

                <?php
                if (isset($model->supplierId)) {
                    $this->renderPartial("transfer_form_print", array(
                        'supplierId' => $model->supplierId,
                        'model' => $model,
                        'title' => "ส่วนที่ 1 สำหรับธนาคาร"));
                    ?>
                    <p style="margin-left:20px"><image src = "<?php echo Yii::app()->request->baseUrl . "/images/payin-cut.png"; ?>" style = "width: 750px" /><p>
                        <?php
                        $this->renderPartial("transfer_form_print", array(
                            'supplierId' => $model->supplierId,
                            'model' => $model,
                            'title' => "ส่วนที่ 2 สำหรับลูกค้า"));
                    }
                }
            }
            ?>
    </div>
</div>
<!--</div>-->
<?php

function showImage($imageUrl, $title) {
    $image = "";
    if (!empty($imageUrl) && isset($imageUrl)) {
        if (strpos($imageUrl, ".pdf")) {
            $imageUrl = Yii::app()->baseUrl . "/" . $imageUrl;
            $image = "<a class='pdf' Title='$title' href='$imageUrl'>ดู</a>";
        } else {
            $imageUrl = Yii::app()->baseUrl . "/" . $imageUrl;
            //$image = "<a class='fancyFrame' Title='$title' href='$imageUrl'><img src='$imageUrl' width='50px' alt='' /></a>";
            $image = "<a class='fancyFrame' Title='$title' href='$imageUrl'>ดู</a>";
        }
    }
    return $image;
}

function getOrderShippingAddress($model) {
    return "<p style='text-align: left'>" . isset($model->shippingCompany) ? $model->shippingCompany : $model->paymentFirstname . " " . $model->paymentLastname . "</p><p style='text-align: left'>" . $model->shippingAddress1 . $model->shippingAddress2 . " " . $model->shippingDistrict->districtName . " " . $model->shippingAmphur->amphurName . " " . $model->shippingProvince->provinceName . " " . $model->paymentPostcode . " โทรศัพท์ :  " . $model->telephone . " Email : " . $model->email . "<p>";
}

function getOrderPaymentAddress($model) {
//	throw new Exception(print_r($model->paymentFirstname,true));
    $res = "";
    if (isset($model->paymentCompany) && !empty($model->paymentCompany)) {
        $res.= $model->paymentCompany;
    } else {
        $res.=" คุณ" . $model->paymentFirstname . " " . $model->paymentLastname;
    }
    $res .= (isset($model->paymentTaxNo) ? "<br>เลขที่ประจำตัวผู้เสียภาษี : " . $model->paymentTaxNo : "") . "<br>" . $model->paymentAddress1 . $model->paymentAddress2 . " " . $model->paymentDistrict->districtName . " " . (isset($model->paymentAmphur->amphurName) ? $model->paymentAmphur->amphurName : "" ) . " " . $model->paymentProvince->provinceName . " " . $model->paymentPostcode . "<br>โทรศัพท์ :  " . $model->telephone;
//	throw new Exception(print_r($res,true));
    return $res;
}

function getOrderSupplierBillingAddress($model, $isFull = false) {
    $supplier = $model->supplier;
    if ($isFull) {
        return $supplier->companyName . "<br>" . (isset($supplier->address1) ? $supplier->address1 . " " . $supplier->district->districtName . " " . $supplier->amphur->amphurName . " " . $supplier->province->provinceName . " " . $supplier->postcode . " โทรศัพท์ :  " . $model->supplier->tel : $supplier->address2 . " " . $supplier->district->districtName . " " . $supplier->amphur->amphurName . " " . $supplier->province->provinceName . " " . $supplier->postcode . " โทรศัพท์ :  " . $model->supplier->telephone . " ผู้ติดต่อ : " . $model->supplier->firstname . " " . $model->supplier->lastname . "</p>");
    } else {
        return "<h4>" . $supplier->companyName . "</h4>" . $supplier->address1 . " " . $supplier->district->districtName . " " . $supplier->amphur->amphurName . " " . $supplier->province->provinceName . " " . $supplier->postcode;
    }
}
?>