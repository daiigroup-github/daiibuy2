<?php
/* @var $this UserController */
/* @var $model User */
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
echo $form->textField($model, 'searchText', array(
	'size'=>32,
	'maxlength'=>32,
	'placeholder'=>'คำค้น เช่น ชื่อ อีเมล์ โทร แฟกซ์',
	'class'=>''));
?>
<?php
echo $form->dropdownList($model, 'status', array(
	1=>"ใช้งาน",
	0=>"ไม่ใช้งาน"), array(
	"prompt"=>"สถานะ",
	'class'=>'input-small'));
?>
<?php
//if(Yii::app()->user->userType == 4)
//{
echo $form->dropdownList($model, 'approved', array(
	1=>"อนุมัติ",
	0=>"ไม่อนุมัติ"), array(
	"prompt"=>"การอนุมัติ",
	'class'=>'input-small'));

echo $form->dropdownList($model, 'type', User::model()->getAllUserType(), array(
	"prompt"=>"เลือกประเภทสมาชิก",
	'class'=>'input-medium'));
//}
?>



<?php
echo CHtml::submitButton('Search', array(
	'class'=>'btn'));
?>

<?php $this->endWidget(); ?>