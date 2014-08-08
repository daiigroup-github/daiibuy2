<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
    $this->module->id,
);
?>

<?php $this->renderPartial('//layouts/_product_row', array(
    'title' => 'Sanitary',
    'maxItems' => 3,
    'moreUrl' => 'madrid/category/index/id/1'
)); ?>
<?php $this->renderPartial('//layouts/_product_row', array(
    'title' => 'Tile',
    'maxItems' => 3,
    'moreUrl' => 'madrid/category/index/id/2'
)); ?>
