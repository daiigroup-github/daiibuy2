<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array(
		'class'=>'form-search well'
	),
	'id'=>'search-form',
	));
?>
<div class="input-append">
	<?php
	echo $form->textField($model, 'searchText', array(
		'class'=>'input-medium search-query',
		'placeholder'=>'ชื่อ รายละเอียด'));

//	if(isset(Yii::app()->user->id) && Yii::app()->user->userType == 4)
//	{
//		echo $form->dropdownlist($model, "supplierId", User::model()->findAllSupplierApprovedArray(), array(
//			"prompt"=>"-- เลือก ผู้ผลิตสินค้า --"));
//	}

	echo $form->dropdownList($model, "status", Product::model()->getStatusArray(), array(
		'prompt'=>'-- เลือกสถานะ --'));

	echo CHtml::submitButton('Search', array(
		'class'=>'btn'));
	?>
</div>

<?php $this->endWidget(); ?>