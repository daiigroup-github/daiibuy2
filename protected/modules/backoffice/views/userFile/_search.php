<?php
/* @var $this UserFileController */
/* @var $model UserFile */
/* @var $form CActiveForm */
?>


<?php
$form = $this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array(
		'class'=>'form-inline well'
	),
	));
?>

<?php
echo $form->textField($model, 'userFileName', array(
	'size'=>60,
	'maxlength'=>500,
	'placeholder'=>'ชื่อเอกสาร',
	'class'=>'input-medium'));
?>
<?php
echo $form->dropdownList($model, 'type', User::model()->getAllUserType(), array(
	'prompt'=>'เลือกประเภทสมาชิก',
	'class'=>'input-medium'));
?>
<?php
echo $form->dropdownList($model, 'status', array(
	1=>"ใช้งาน",
	0=>"ไม่ใช้งาน"), array(
	'prompt'=>'สถานะ',
	'class'=>'input-small'));
?>
<?php
echo CHtml::submitButton('Search', array(
	'class'=>'btn'));
?>

<?php $this->endWidget(); ?>