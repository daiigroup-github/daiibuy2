<?php
/* @var $this CategoryController */

$this->breadcrumbs = array(
	'Category',
);
?>
<?php $this->renderPartial('//layouts/_product_list', array('title' => $title,
                                                            'dataProvider' => $dataProvider,
                                                            'itemView' => $itemView,
                                                            'template'=>$template,
                                                            'summaryText'=>$summaryText,
)); ?>
