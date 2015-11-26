<?php
/* @var $this FurnitureGroupController */
/* @var $model FurnitureGroup */

$this->breadcrumbs = array(
	'Furniture Groups' => array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label' => 'List FurnitureGroup',
		'url' => array(
			'index')),
	array(
		'label' => 'Create FurnitureGroup',
		'url' => array(
			'create')),
);

//Yii::app()->clientScript->registerScript('search', "
//$('#search-form').submit(function(){
//$('#furniture-group-grid').yiiGridView('update', {
//data: $(this).serialize()
//});
//return false;
//});
//");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Furniture Groups
		<div class="pull-right">
			<?php
			echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl("create?categoryId=" . $_GET["categoryId"] . "&category2Id=" . $_GET["category2Id"]), array(
				'class' => 'btn btn-xs btn-primary'));
			?>
		</div>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-lg-12">
				<?php
				$this->renderPartial('_search', array(
					'model' => $model,
				));
				?>
			</div>
		</div>
	</div>

	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id' => 'furniture-group-grid',
		'dataProvider' => $model->search(),
		//'filter'=>$model,
		'itemsCssClass' => 'table table-striped table-bordered table-hover',
		'columns' => array(
			array(
				'class' => 'IndexColumn'),
			array(
				'class' => 'SortColumn'),
			/*
			  'furnitureGroupId',
			 */
			'categoryId',
			'title',
			'description:html',
			array(
				'name' => 'image',
				'type' => 'html',
				'value' => 'CHtml::image(Yii::app()->baseUrl.$data->image,"", array("style"=>"width:50px"))',
			),
			array(
				'name' => 'status',
				'value' => '$data->statusArray[$data->status]',
			),
			'createDateTime',
			/*
			  'updateDateTime',
			 */
			array(
				'class' => 'CButtonColumn',
				'template' => '{view} {update} {delete} {furniture}',
				'buttons' => array(
					'furniture' => array(
						'label' => '<u>Furniture Color</u>',
						'url' => 'Yii::app()->createUrl("backoffice/furniture/index?furnitureGroupId=".$data->furnitureGroupId)'
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
                    Add New Furniture Group or Select Existing
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6" style="border-right: 1px solid">
                            <h3>Choose Product..</h3>
                            <div class="form-group">
                                <div class="control-label col-lg-3">Furniture</div>
                                <div class="col-lg-9">
									<?php
//									throw new Exception(print_r($_GET["categoryId"], true));
									echo Select2::dropDownList("furnitureGroupId", "", FurnitureGroup::model()->findAllFunitureGroupArray($_GET["categoryId"]), array(
										'prompt' => ' --เลือก Furniture Set --',
										'id' => 'furnitureGroupId',
										'style' => 'max-width:400px;
	min-width:300px',
										'select2Options' => array(
											'maximumSelectionSize' => 1,
										),
									));
									?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
									<?php
									echo CHtml::button("Save Choosen Furniture Set", array(
										'class' => 'btn btn-success btn-xs col-lg-offset-3',
										'onclick' => 'saveChooseFurniture()'))
									?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <h3>New Product</h3>
							<?php
							echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl("create?categoryId=" . $_GET["categoryId"] . "&category2Id=" . $_GET["category2Id"]), array(
								'class' => 'btn btn-xs btn-primary'));
							?>
                        </div>
                    </div>
                </div>
            </div>
            <script>
				function saveChooseFurniture()
				{
					$.ajax({
						type: "POST",
						dataType: "JSON",
						url: '<?php echo Yii::app()->createUrl("backoffice/furnitureGroup/saveChoosenFurniture"); ?>',
						beforeSend: function () {
							if ($("#furnitureGroupId").val() == "")
							{
								alert("Please Choose Category");
								return false;
							}
//							alert($("#furnitureGroupId").val());
						},
						data: {furnitureGroupId: $("#furnitureGroupId").val(), categoryId: <?php echo $_GET["categoryId"] ?>, category2Id: <?php echo $_GET["category2Id"] ?>},
						success: function (data) {
							if (data.status)
							{
								$.fn.yiiGridView.update("furniture-group-grid");
							}
						}
					});
				}
			</script>
        </div>
    </div>
</div>


