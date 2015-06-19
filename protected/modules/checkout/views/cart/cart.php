<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
    $this->module->id,
);
?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="carousel-heading">
            <h4>ดำเนินการชำระเงิน</h4>
            <?php
            ?>
        </div>
    </div>
</div>

<?php
$i = 1;
foreach ($orders as $order) {
    $this->renderPartial('_order_info', array(
        'order' => $order,
        'supplierId' => isset($supplierId) ? $supplierId : Yii::app()->session['supplierId'],
        'i' => $i));
    $i++;
}
?>

<?php
$this->renderPartial('_order_info_summary', array(
    'orderSummary' => $orderSummary));
?>

<?php
//description tab
if ($desc !== array()) {
    $this->renderPartial('_desc_tab', array('tabs' => $desc));
}
?>

<?php
$supplierContentGroup = SupplierContentGroup::model()->find('supplierId = ' . (isset($supplierId) ? $supplierId : Yii::app()->session['supplierId']) . ' AND status = 2');
if (!isset($supplierContentGroup->supplierContents[0]))
    $confirmationContent = "<b>เงื่อนไขและข้อตกลงในการซื้อสินค้า บริษัท ไดอิ กรุ๊ป จำกัด(มหาชน) </b><br>1.ราคาสินค้ารวมภาษีมูลค่าเพิ่มแล้ว<br> 2.ราคาสินค้ารวมอุปกรณ์<br>  3.กรรมสิทธิ์สินค้ายังคงเป็นของบริษัทฯ จนกว่าจะได้รับการชำระเงินเป็นที่เรียบร้อยแล้ว<br>  4.ระยะเวลาการส่งของ ภายใน 1-3 วันหลังจากยืนยันการชำระเงิน(โดยประมาณ)<br>"; //	throw new Exception(print_r($confirmationContent, true));
?>
<div class="row sidebar-box orange">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="sidebar-box-heading">
            <i class="icons fa fa-file-o"></i>
            <h4><?php echo isset($supplierContentGroup->supplierContents[0]->title) ? $supplierContentGroup->supplierContents[0]->title : "เงื่อนไขและข้อตกลง"; ?></h4>
        </div>
        <div class="sidebar-box-content sidebar-padding-box">
            <?php echo isset($supplierContentGroup->supplierContents[0]->description) ? $supplierContentGroup->supplierContents[0]->description : $confirmationContent; ?><br>
            <div class="text-center">
                <input type="checkbox" name="accept" id="acceptConfirm"/>
                <label class="checkbox-label" for="acceptConfirm"> ยอมรับ <i>"ข้อตกลงและเงื่อนไข"</i></label>
            </div>
        </div>

    </div>

</div>

<p class="pull-right">
    <a class="button big orange" href="<?php echo Yii::app()->homeUrl; ?>"><i class="icons icon-reply"></i>Continue Shopping</a>
    <!--<a class="button big blue" href="#"><i class="glyphicon glyphicon-refresh"></i> Update</a>-->
    <?php
    $supplier = Supplier::model()->findByPk($supplierId);
    $minValue = (isset($supplier) && $supplier->minimumOrder > 0) ? $supplier->minimumOrder : Configuration::model()->find('name = "minValueToBuy"')->value;
    $orderTotal = str_replace(",", "", $orderSummary['total']);
    $checkOutClass = ($orderTotal < $minValue) ? "button big green hide" : "button big green";
    ?>
    <a id="checkoutBtn" class="<?php echo $checkOutClass; ?> hide" href="<?php echo $this->createUrl('cart/checkout/id/' . $supplierId); ?>"><i class="glyphicon glyphicon-shopping-cart"></i> Check out</a>
</p>