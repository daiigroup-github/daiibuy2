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
		'i'=>$i));
	$i++;
}
?>

<?php
$this->renderPartial('_order_info_summary', array(
	'orderSummary'=>$orderSummary));
?>

<p class="pull-right">
    <a class="button big orange" href="#"><i class="icons icon-reply"></i>Continue Shopping</a>
    <a class="button big blue" href="#"><i class="glyphicon glyphicon-refresh"></i> Update</a>
    <a class="button big green" href="<?php echo $this->createUrl('cart/checkout/id/' . $supplierId); ?>"><i class="glyphicon glyphicon-shopping-cart"></i> Check out</a>
</p>
