<?php
$this->pageHeader = 'การจัดการ Supplier Discount Range';
$this->breadcrumbs = array(
	'Users'=>Yii::app()->createUrl("admin/user"),
	'Supplier Discount Range'
);
?>
<h3>Supplier : <?php echo $model->supplier->firstname . " " . $model->supplier->lastname; ?></h3>
<?php
Yii::app()->clientScript->registerScript('search', "
$('#search-form').submit(function(){
	$('#range-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
//$this->renderPartial("_search_sup_reward_range", array("model" => $model));
?>
<div class="btn-toolbar">
	<div class="btn-group">
		<?php
		if(isset(yii::app()->user->id))
		//if(User::model()->findByPk(Yii::app()->user->id)->type == 6)
		//{
		//        echo CHtml::link('<i class="icon-plus-sign icon-white"></i> เพิ่ม Distributor', array(
		//                'user/create'), array(
		//                'class'=>'btn btn-primary'));
		//}
		//else
			if(User::model()->findByPk(Yii::app()->user->id)->type != 6)
			{
				echo CHtml::link('<i class="icon-plus-sign icon-white"></i> เพิ่ม Supplier Discount Range', array(
					'createSupplierDiscountRange?supplierId=' . $_GET["supplierId"]), array(
					'class'=>'btn btn-primary'));
			}
		?>
	</div>
</div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'range-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass'=>'table table-striped table-bordered',
	'columns'=>array(
//		'supplierId',
		'min',
		'max',
		'percentDiscount',
		'status',
		/*
		  'updateDateTime',
		 */
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update} {delete}',
			'buttons'=>array(
				'update'=>array(
					'url'=>'array("updateSupplierDiscountRange","id"=>$data->primaryKey)',
				),
				'delete'=>array(
					'url'=>'array("deleteSupplierDiscountRange","id"=>$data->primaryKey)',
					'onclick'=>'return confirm("Do you want to delete")'
				)
			)
		),
	),
));
