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
		<div class="col-lg-3">
			<?php
			echo $form->textField($model, 'searchText', array(
				'class'=>'form-control',
				'placeholder'=>'คำค้น เช่น ชื่อ อีเมล์ โทร แฟกซ์'));
			?>
		</div>
		<div class="col-lg-3">
			<?php
			echo $form->dropdownList($model, 'status', array(
				1=>"ใช้งาน",
				0=>"ไม่ใช้งาน"), array(
				"prompt"=>"สถานะ",
				'class'=>'form-control'
			));
			?>
		</div>
		<div class="col-lg-3">
			<?php
			if(Yii::app()->user->userType == 4)
			{
				echo $form->dropdownList($model, 'approved', array(
					1=>"อนุมัติ",
					0=>"ไม่อนุมัติ"), array(
					"prompt"=>"การอนุมัติ",
					'class'=>'form-control'));
			}
			?>
		</div>
		<div class="col-lg-3">
			<?php
			if(Yii::app()->user->userType == 4)
			{
				echo $form->dropdownList($model, 'type', User::model()->getAllUserType(), array(
					"prompt"=>"เลือกประเภทสมาชิก",
					'class'=>'form-control'));
			}
			?>
		</div>
	</div>

</div>



<?php $this->endWidget(); ?>