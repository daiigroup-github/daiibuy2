<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
    $this->module->id,
);
?>

<?php
foreach ($products as $product) {
    $this->renderPartial('_product_row', array(
        'title' => 'Sanitary',
        'maxItems' => 3,
        'moreUrl'=>$product['moreUrl'],
        'items' => $product['items'],
    ));
}
?>

