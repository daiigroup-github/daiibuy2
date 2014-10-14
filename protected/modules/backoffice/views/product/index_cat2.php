<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs = array(
	'Products',
);

$this->menu = array(
	array(
		'label'=>'Create Product',
		'url'=>array(
			'create')),
);

//$this->pageHeader = 'Manage Products';
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Product
		<div class="pull-right">
			<?php
//			echo CHtml::link('<i class="icon-plus-sign icon-white"></i> เพิ่มสินค้า', array(
//				'create'), array(
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
		'id'=>'product-grid',
		'dataProvider'=>$cat2ToProduct->search(),
		//'filter'=>$model,
		'itemsCssClass'=>'table table-striped table-bordered table-condensed table-hover',
		'columns'=>array(
			array(
				'class'=>'IndexColumn'
			),
			array(
				'class'=>'SortColumn',
				'url'=>'backoffice/category2ToProduct/sortItem'
			),
			array(
				'header'=>'Image',
				'name'=>'image',
				'type'=>'html',
				'value'=>'CHtml::image(Yii::app()->request->baseUrl.$data->product->findFirstImageProduct($data->productId), "image", array("style"=>"width:100px;"))',
			),
			array(
				'header'=>'Product',
				'name'=>'name',
				'type'=>'html',
				'value'=>'$data->product->name."<br />".
				"Last Update : ".$data->product->updateDateTime."<br />".
				"veiws : ".$data->product->viewed."<br />"
				//.$data->getBadgeStatus()
				',
			),
			array(
				'header'=>'Qty',
				'name'=>'quantity',
				'type'=>'html',
				'value'=>'number_format($data->product->quantity)',
			),
			array(
				'header'=>'Price',
				'name'=>'price',
				'type'=>'html',
				'value'=>'number_format($data->product->price, 2)',
			),
			array(
				'header'=>'Properties',
				'name'=>'weight',
				'type'=>'html',
				'value'=>'"Dimension : ".$data->product->length." x ".$data->product->width." x ".$data->product->height."<br />".
				"Weight : ".$data->product->weight."<br />"',
			),
			array(
				'class'=>'CButtonColumn',
				//'template'=>'{view} {update} {delete} {approve}',
				'template'=>'{view} {update} {delete} {option} {detail} {spec}',
				'buttons'=>array(
//					'approve'=>array(
//						'label'=>'<br><u>Approve</u>',
//						'url'=>'Yii::app()->createUrl("admin/product/update", array("id"=>$data->productId))'
//					),
					'update'=>array(
						'url'=>'Yii::app()->createUrl("backoffice/product/update?id=".$data->productId."&categoryId=".$data->categoryId)'
					),
					'option'=>array(
						'label'=>'<br><u>Option</u>',
						'url'=>'Yii::app()->createUrl("backoffice/productOptionGroup/index?productId=".$data->productId)'
					),
					'detail'=>array(
						'label'=>'<br><u>Detail</u>',
						'url'=>'Yii::app()->createUrl("backoffice/productSpecGroup/index?productId=".$data->productId."&type=1")'
					),
					'spec'=>array(
						'label'=>'<br><u>Spec</u>',
						'url'=>'Yii::app()->createUrl("backoffice/productSpecGroup/index?productId=".$data->productId."&type=2")'
					)
				),
			),
		),
	));
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Add New Product or Select Existing
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-6" style="border-right: 1px solid">
							<h3>Choose Product..</h3>
							<?php
							echo Select2::dropDownList("productId", "", Product::model()->findAllProductBySupplierId(User::model()->getSupplierId(Yii::app()->user->id)), array(
								'prompt'=>'-- เลือก Product --',
								'id'=>'productId',
								'style'=>'max-width:400px;min-width:300px',
								'select2Options'=>array(
									'maximumSelectionSize'=>1,
								),
							));
							?>
							<?php
							echo CHtml::button("Save Choose Category", array(
								'class'=>'btn btn-success btn-xs',
								'onclick'=>'saveChooseProduct()'))
							?>
						</div>
						<div class="col-lg-6">
							<h3>New Product</h3>
							<?php
							echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create?categoryId=' . $_GET["categoryId"]), array(
								'class'=>'btn btn-xs btn-primary'));
							?>
						</div>
					</div>
				</div>
			</div>
			<script>
				function saveChooseProduct()
				{
					$.ajax({
						type: "POST",
						dataType: "JSON",
						url: '<?php echo Yii::app()->createUrl("backoffice/product/saveCategory2ToProduct"); ?>',
						beforeSend: function () {
							if ($("#productId").val() == "")
							{
								alert("Please Choose Product");
								return false;
							}
						},
						data: {productId: $("#productId").val(), categoryId: <?php echo $_GET["categoryId"] ?>},
						success: function (data) {
							if (data.status)
							{
								$.fn.yiiGridView.update("product-grid");
							}

						}
					});
				}
			</script>
		</div>
	</div>
</div>