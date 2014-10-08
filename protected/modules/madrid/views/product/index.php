<?php
/* @var $this ProductController */

$this->breadcrumbs = array(
    'Product',
);
?>

<?php $this->renderPartial('_product_single', array('product' => $product, 'productModel'=>$productModel, 'images'=>$images, 'descriptionTabs'=>$descriptionTabs)); ?>
