<div class="row">
	<!-- Heading -->
	<div class="col-lg-12 col-md-12 col-sm-12">

		<div class="carousel-heading">
			<h4><?php echo $title; ?></h4>
		</div>

	</div>
	<!-- /Heading -->
</div>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>$itemView,
	'pagerCssClass'=>'pagination',
	//'enablePagination'=>false,
	//'ajaxUpdate'=>false,
	'id'=>'resultHolder',
	'pager'=>array(
		'class'=>'ext.pager.Pager',
		'htmlOptions'=>array(
			'class'=>'pagination'
		),
		'header'=>'',
		'prevPageLabel'=>'<',
		'nextPageLabel'=>'>',
		'firstPageLabel'=>'<<',
		'lastPageLabel'=>'>>',
	),
	'summaryCssClass'=>'category-results',
	'summaryText'=>isset($summaryText) ? $summaryText : '',
	'template'=>$template
));
?>

