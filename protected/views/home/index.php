<?php
/* @var $this HomeController */

$this->breadcrumbs = array(
    'Home',
);
?>

<?php $this->renderPartial('//layouts/_ios_slider'); ?>

    <div class="row">
        <div class="col-md-12">

            <div class="row sidebar-box blue">

                <div class="col-lg-12 col-md-12 col-sm-12">

                    <div class="carousel-heading no-margin">
                        <h4>ผู้ผลิต</h4>
                    </div>

                    <div class="page-content">

                        <div class="row">

                            <div class="col-md-6">
                                <?php echo $this->renderPartial('_supplier_box', array('supplier' => $suppliers[0])); ?>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <?php foreach ($suppliers as $k=>$supplier): ?>
                                        <?php if ($k == 0) continue; ?>
                                        <div class="col-md-6">
                                            <?php echo $this->renderPartial('_supplier_box', array('supplier' => $supplier)); ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

<?php
/*
  <!-- Banner -->
  <section class="banner">

  <div class="left-side-banner banner-item icon-on-right gray">
  <h4>8(802)234-5678</h4>
  <p>Monday - Saturday: 8am - 5pm PST</p>
  <i class="icons icon-phone-outline"></i>
  </div>

  <a href="#">
  <div class="middle-banner banner-item icon-on-left light-blue">
  <h4>Free shipping</h4>
  <p>on all orders over $99</p>
  <span class="button">Learn more</span>
  <i class="icons icon-truck-1"></i>
  </div>
  </a>

  <a href="#">
  <div class="right-side-banner banner-item orange">
  <h4>Crazy sale!</h4>
  <p>on selected items</p>
  <span class="button">Shop now</span>
  </div>
  </a>

  </section>
  <!-- /Banner -->
 */
?>