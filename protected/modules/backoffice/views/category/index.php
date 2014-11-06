<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs = array(
	'Categories'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List Category',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create Category',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#category-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Categories
		<div class="pull-right">

		</div>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-lg-12">
				<?php
				$this->renderPartial('_search', array(
					'model'=>$model,
				));
				?>
			</div>
		</div>
	</div>
	<h3><?php echo isset($brandToCat->brandModel) ? $brandToCat->brandModel->title : "-" ?></h3>
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'category-grid',
		'dataProvider'=>$brandToCat->search(),
//		'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered table-hover',
		'columns'=>array(
			array(
				'class'=>'IndexColumn'),
			array(
				'class'=>'SortColumn',
				'url'=>'backoffice/modelToCategory1/sortItem'
			),
			array(
				'name'=>'image',
				'type'=>'html',
				'value'=>'isset($data->category)?CHtml::image(Yii::app()->baseUrl.$data->category->image, "", array("style"=>"width:50px")):"-"',
				'htmlOptions'=>array(
					'width'=>'50px'
				)
			),
			array(
				'name'=>'categoryId',
				'value'=>'isset($data->category)?$data->category->title:"-"'
			),
			array(
				'name'=>'description',
				'type'=>'html',
				'value'=>'isset($data->category)?$data->category->description:"-"'
			),
			'status',
			/*
			  'createDateTime',
			  'updateDatetime',
			 */
			array(
				'class'=>'CButtonColumn',
				'template'=>'{view} {update} {delete} {subCat} {product} {image}',
				'buttons'=>array(
					'product'=>array(
						'label'=>'<br><u>Product</u>',
						'url'=>'Yii::app()->createUrl("/backoffice/product/indexCat2?category1Id=".$data->categoryId."&brandModelId=".$_GET["brandModelId"])'
					),
					'view'=>array(
						'url'=>'Yii::app()->createUrl("/backoffice/category/view/id/".$data->categoryId)'
					),
					'update'=>array(
						'url'=>'Yii::app()->createUrl("/backoffice/category/update/id/".$data->categoryId)'
					),
//					'delete'=>array(
//						'url'=>'Yii::app()->createUrl("/backoffice/category/delete/id/".$data->categoryId)'
//					),
					'subCat'=>array(
						'label'=>'<br><u>Sub Category</u>',
						'url'=>'Yii::app()->createUrl("/backoffice/categoryToSub?categoryId=".$data->categoryId."&brandModelId=".$_GET["brandModelId"])'
					),
					'image'=>array(
						'label'=>'<br><u>image</u>',
						'url'=>'Yii::app()->createUrl("/backoffice/categoryImage?categoryId=".$data->categoryId)'
					)
				)
			),
		),
	));
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Add New Category or Select Existing
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-6" style="border-right: 1px solid">
							<h3>Choose Category..</h3>
							<?php
							echo Select2::dropDownList("categoryId", "", Category::model()->findAllCategoryBySupplierId(1, User::model()->getSupplierId(Yii::app()->user->id)), array(
								'prompt'=>'-- เลือก Category --',
								'id'=>'categoryId',
								'style'=>'max-width:400px;min-width:300px',
								'select2Options'=>array(
									'maximumSelectionSize'=>1,
								),
							));
							?>
							<?php
							echo CHtml::button("Save Choose Category", array(
								'class'=>'btn btn-success btn-xs',
								'onclick'=>'saveChooseCategory()'))
							?>
						</div>
						<div class="col-lg-6">
							<h3>New Category</h3>
							<?php
							echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create?brandModelId=' . $_GET["brandModelId"]), array(
								'class'=>'btn btn-xs btn-primary'));
							?>
						</div>
					</div>
				</div>
			</div>
			<script>
				function saveChooseCategory()
				{
					$.ajax({
						type: "POST",
						dataType: "JSON",
						url: '<?php echo Yii::app()->createUrl("backoffice/category/saveModelToCategory1"); ?>',
						beforeSend: function () {
							if ($("#categoryId").val() == "")
							{
								alert("Please Choose Category");
								return false;
							}
						},
						data: {categoryId: $("#categoryId").val(), brandModelId: <?php echo $_GET["brandModelId"] ?>},
						success: function (data) {
							if (data.status)
							{
								$.fn.yiiGridView.update("category-grid");
							}

						}
					});
				}
			</script>
		</div>
	</div>

</div>


