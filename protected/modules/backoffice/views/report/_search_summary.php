<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array(
//		'class'=>'form-inline well'
	),
	'id'=>'search-form'
	));
?>
<div class="input-group">
	<span class="input-group-btn">
		<button class="btn btn-default" type="submit">Search</button>
	</span>
	<div class="row">
		<div class="col-lg-4">
			<?php
			echo $form->dropDownList($model, 'paymentYear', $model->findAllYearSalesArray(), array(
				"class"=>"form-control",
				"prompt"=>"-- เลือกทุกปี --",));
			?>
		</div>
		<div class="col-lg-4">
			<?php
			echo $form->dropDownList($model, 'paymentMonth', $model->findAllMonthSalesArray(), array(
				"class"=>"form-control",
				"prompt"=>"-- เลือกทุกเดือน --",));
			?>
		</div>
		<div class="col-lg-4">
			<?php
			echo $form->dropDownList($model, 'supplierId', Supplier::model()->findAllSupplierArray(), array(
				"class"=>"form-control",
				"prompt"=>"-- เลือกทุก Supplier --")
				);
			?>
		</div>
	</div>

</div>

<?php $this->endWidget(); ?>