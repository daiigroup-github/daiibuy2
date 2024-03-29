<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
	$this->module->id,
);
/*
  $this->renderPartial('//layouts/_product_list', array(
  'title' => $title,
  'dataProvider' => $dataProvider,
  'itemView' => $itemView,
  'template' => $template,
  ));
 */
?>

<div class="row">
	<!-- Heading -->
	<div class="col-lg-12 col-md-12 col-sm-12">

		<div class="carousel-heading">
			<h4><?php echo $supplierModel->name; ?></h4>
		</div>

	</div>
	<!-- /Heading -->
</div>

<?php
foreach($categorys as $category)
{
	if(!isset($category1Id))
	{
		$category1Id = CategoryToSub::model()->find("subCategoryId=" . $category->categoryId)->categoryId;
	}
	$this->renderPartial('_product_item', array(
		'category'=>$category,
		'category1Id'=>isset($category1Id) ? $category1Id : null));
}
?>