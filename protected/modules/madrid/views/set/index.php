<?php
/* @var $this ThemeController */

$this->breadcrumbs=array(
	'Theme',
);
?>

<?php $this->renderPartial('//layouts/_product_list', array('title' => $title,
                                                            'dataProvider' => $dataProvider,
                                                            'itemView' => $itemView,
                                                            'template'=>$template,
                                                            'summaryText'=>$summaryText,
                                                            'itemClass'=>$itemClass
)); ?>