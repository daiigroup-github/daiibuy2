<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
    $this->module->id,
);
?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="carousel-heading">
                <h4>Check Out :: Step <?php echo $step; ?></h4>
            </div>
        </div>
    </div>

<?php $this->renderPartial('_wizard_nav', array('step' => $step)); ?>