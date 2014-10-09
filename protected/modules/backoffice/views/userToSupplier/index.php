<?php
/* @var $this UserToSupplierController */
/* @var $model UserToSupplier */

$this->breadcrumbs = array(
	'User To Suppliers'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List UserToSupplier',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create UserToSupplier',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
$('#user-to-supplier-grid').yiiGridView('update', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage User To Suppliers
		<div class="pull-right">
			<?php
//			echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array(
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
	<h3><?php echo isset($model->supplier) ? $model->supplier->name : "-" ?></h3>
	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'user-to-supplier-grid',
		'dataProvider'=>$model->search(),
		'itemsCssClass'=>'table table-striped table-bordered table-hover',
		'columns'=>array(
			array(
				'class'=>'IndexColumn'),
			array(
				'name'=>'userId',
				'value'=>'isset($data->user)?$data->user->email:"-"'
			),
			'status',
//			'createDateTime',
//			'updateDateTime',
			array(
				'class'=>'CButtonColumn',
				'template'=>'{view} {update} {delete}',
				'buttons'=>array(
					'update'=>array(
						'url'=>'Yii::app()->createUrl("/backoffice/user/update?id=".$data->userId."&supplierId=".$data->supplierId)'
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
					Add New User or Select Existing
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-6" style="border-right: 1px solid">
							<h3>Choose Category..</h3>
							<?php
							echo Select2::dropDownList("userId", "", User::model()->findAllSupplierArray(true), array(
								'prompt'=>'-- เลือก User --',
								'id'=>'userId',
								'style'=>'max-width:400px;min-width:300px',
								'select2Options'=>array(
									'maximumSelectionSize'=>1,
								),
							));
							?>
							<?php
							echo CHtml::button("Save Choose User", array(
								'class'=>'btn btn-success btn-xs',
								'onclick'=>'saveChooseUser()'))
							?>
						</div>
						<div class="col-lg-6">
							<h3>New User</h3>
							<?php
							echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('/backoffice/user/create?supplierId=' . $_GET["supplierId"]), array(
								'class'=>'btn btn-xs btn-primary'));
							?>
						</div>
					</div>
				</div>
			</div>
			<script>
				function saveChooseUser()
				{
					$.ajax({
						type: "POST",
						dataType: "JSON",
						url: '<?php echo Yii::app()->createUrl("backoffice/user/saveUserToSupplier"); ?>',
						beforeSend: function () {
							if ($("#userId").val() == "")
							{
								alert("Please Choose User");
								return false;
							}
						},
						data: {userId: $("#userId").val(), supplierId: <?php echo $_GET["supplierId"] ?>},
						success: function (data) {
							if (data.status)
							{
								$.fn.yiiGridView.update("user-to-supplier-grid");
							}

						}
					});
				}
			</script>
		</div>
	</div>
</div>


