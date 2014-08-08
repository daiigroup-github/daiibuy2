<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
    $this->module->id,
);
?>

<div class="row">

    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="carousel-heading">
            <h4>Order Information</h4>

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
foreach ($carts as $cart) {
    $this->renderPartial('//layouts/_order_info', array('cart' => $cart));
}
?>

<?php $this->renderPartial('//layouts/_order_info_summary', array('cart' => $cart)); ?>

<p class="pull-right">
    <a class="button big orange" href="#"><i class="icons icon-reply"></i>Continue Shopping</a>
    <a class="button big blue" href="#"><i class="glyphicon glyphicon-refresh"></i> Update</a>
    <a class="button big green" href="#"><i class="glyphicon glyphicon-shopping-cart"></i> Check out</a>
</p>
