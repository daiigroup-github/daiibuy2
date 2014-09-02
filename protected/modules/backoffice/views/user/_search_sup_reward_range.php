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
if(isset($_GET["supplierId"]))
	echo $form->hiddenField($model, "supplierId", array(
		'value'=>$_GET["supplierId"]));
echo $form->textField($model, 'searchText', array(
	'size'=>32,
	'maxlength'=>32,
	'placeholder'=>'คำค้น เช่น  Min Max Point',
	'class'=>''));
?>



<?php
echo CHtml::submitButton('Search', array(
	'class'=>'btn'));
?>

<?php $this->endWidget(); ?>