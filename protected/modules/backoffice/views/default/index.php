<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
	$this->module->id,
);
?>
<h1><?php // echo $this->uniqueId . '/' . $this->action->id;                                ?></h1>

<h1 class="text-primary text-center">ระบบการจัดการหลังบ้าน DAIIBUY 2</h1>
<div class="panel panel-default">
	<div class="panel-heading">
		ภาพรวมระบบ
	</div>
	<div class="panel-body">
		<span class="col-sm-2"></span>
		<?php
		echo CHtml::image(Yii::app()->baseUrl . "/images/system/system_flow.png", "", array(
			'class'=>'col-sm-7'))
		?>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		Product Level
	</div>
	<div class="panel-body">
		<?php
		echo CHtml::image(Yii::app()->baseUrl . "/images/system/product_level.png", "", array(
			'class'=>'col-sm-12'))
		?>
	</div>
</div>
