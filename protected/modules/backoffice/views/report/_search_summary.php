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
		'class'=>'form-inline well'
	),
	'id'=>'search-form'
	));
?>

<?php
echo $form->dropDownList($model, 'paymentYear', $model->findAllYearSalesArray(), array(
	"class"=>"input-large",
	"prompt"=>"--เลือกปี--",));
?>
<?php
echo $form->dropDownList($model, 'paymentMonth', $model->findAllMonthSalesArray(), array(
	"class"=>"input-large",
	"prompt"=>"--เลือกเดือน--",));
?>
<!--&nbsp;-->
<?php
//echo $form->textField($model, 'orderStatusid', array(
//	'class' => 'input-small'));
?>
<!--&nbsp;-->
<?php
//echo $form->textField($model, 'dealerId', array(
//	'size' => 20,
//	'maxlength' => 20,
//	'class' => 'input-small'));
?>
&nbsp;
<?php
echo CHtml::submitButton('Search', array(
	'class'=>'btn'));
?>
</div>

<?php $this->endWidget(); ?>