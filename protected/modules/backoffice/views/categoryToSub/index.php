<?php
/* @var $this CategoryToSubController */
/* @var $model CategoryToSub */

$this->breadcrumbs = array(
	'Category To Subs'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List CategoryToSub',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create CategoryToSub',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#category-to-sub-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Category To Subs
		<div class="pull-right">
			<?php
//			echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create?categoryId=' . $_GET["categoryId"]), array(
//				'class'=>'btn btn-xs btn-primary'));
			?>
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
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'category-to-sub-grid',
		'dataProvider'=>$model->search(),
//		'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered table-hover',
		'columns'=>array(
			array(
				'class'=>'IndexColumn'),
			array(
				'class'=>'SortColumn'),
			array(
				'name'=>'subCategoryId',
				'type'=>'html',
				'value'=>'Chtml::image(Yii::app()->baseUrl.$data->subCategory->image,"",array("style"=>"width:150px"))."<br>".$data->subCategory->title',
				'htmlOptions'=>array(
					"style"=>'width:150px',
					"class"=>'text-center')
			),
			'isTheme',
			'isSet',
			'status',
			/*
			  'createDateTime',
			  'updateDateTime',
			 */
			array(
				'class'=>'CButtonColumn',
				'template'=>'{view} {update} {delete} {product} {image}',
				'buttons'=>array(
					'product'=>array(
						'label'=>'<br><u>Product</u>',
						'url'=>'Yii::app()->createUrl("/backoffice/product/indexCat2?categoryId=".$data->subCategoryId)'
					),
					'image'=>array(
						'label'=>'<br><u>Image</u>',
						'url'=>'Yii::app()->createUrl("/backoffice/categoryImage?categoryId=".$data->subCategoryId)'
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
							echo Select2::dropDownList("categoryId", "", Category::model()->findAllCategoryBySupplierId(0, Yii::app()->user->id), array(
								'prompt'=>'-- เลือก Category --',
								'id'=>'subCategoryId',
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
							echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create?categoryId=' . $_GET["categoryId"]), array(
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
						url: '<?php echo Yii::app()->createUrl("backoffice/categoryToSub/saveCategoryToSub"); ?>',
						beforeSend: function () {
							if ($("#categoryId").val() == "")
							{
								alert("Please Choose Category");
								return false;
							}
						},
						data: {subCategoryId: $("#subCategoryId").val(), categoryId: <?php echo $_GET["categoryId"] ?>},
						success: function (data) {
							if (data.status)
							{
								$.fn.yiiGridView.update("category-to-sub-grid");
							}

						}
					});
				}
			</script>
		</div>
	</div>
</div>


