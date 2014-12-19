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

			<?php /*
			  <div class="carousel-arrows">
			  <a href="#"><i class="icons icon-reply"></i></a>
			  </div>
			 */
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
