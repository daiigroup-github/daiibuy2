<?php
/* @var $this CategoryController */

$this->breadcrumbs = array(
	'Category',
);
?>
<?php
$this->renderPartial('_product_list', array(
	'title'=>$title,
	'dataProvider'=>$dataProvider,
	'itemView'=>$itemView,
	'template'=>$template,
	'summaryText'=>$summaryText,
	'category2Id'=>$category2Id,
));
?>
