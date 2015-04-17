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
foreach($orders as $order)
{
	$this->renderPartial('_order_info', array(
		'order'=>$order,
		'supplierId'=>isset($supplierId) ? $supplierId : Yii::app()->session['supplierId'],
		'i'=>$i));
	$i++;
}
?>

<?php
$this->renderPartial('_order_info_summary', array(
	'orderSummary'=>$orderSummary));
?>

<?php
$confirmationContent = Content::model()->showConfirmationContentBySupplierId(isset($supplierId) ? $supplierId : Yii::app()->session['supplierId']);
//	throw new Exception(print_r($confirmationContent, true));
?>
<div class="row sidebar-box orange">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="sidebar-box-heading">
            <i class="icons fa fa-file-o"></i>
            <h4><?php echo $confirmationContent[0]->title; ?></h4>
        </div>
        <div class="sidebar-box-content sidebar-padding-box">
			<?php echo $confirmationContent[0]->description; ?>
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
    <a id="checkoutBtn" class="<?php echo $checkOutClass; ?>" href="<?php echo $this->createUrl('cart/checkout/id/' . $supplierId); ?>"><i class="glyphicon glyphicon-shopping-cart"></i> Check out</a>
</p>