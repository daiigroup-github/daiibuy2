<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
    $this->module->id,
);
?>

<?php
foreach ($products as $product) {
    $this->renderPartial('_product_row', array(
        'title' => $product['title'],
        'maxItems' => $product['maxItems'],
        'moreUrl'=>$product['moreUrl'],
        'items' => $product['items'],
    ));
}
?>

