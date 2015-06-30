<?php $this->renderPartial("_navbar"); ?>

<div class="myfile-main">
	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id'=>'furniture-form',
		'enableAjaxValidation'=>false,
		'action'=>Yii::app()->createUrl("/checkout/step/myfileFurnitureStep?orderGroupId=" . $_GET["id"]),
		'htmlOptions'=>array(
			'enctype'=>'multipart/form-data',
			'class'=>'form-horizontal',
		),
	));
	?>
	<?php
	$this->renderPartial("_wizard_step_fur", array(
		'model'=>$model));
	?>
	<div class="row setup-content" id="step1">
		<?php foreach($furnitureGroups as $furnitureGroup): ?>
			<div class="col-lg-6 text-center">
				<img src="<?php echo Yii::app()->baseUrl . $furnitureGroup->image; ?>" style="width: 70%" />
				<input type="radio" name="furnitureGroupId" id="furnitureGroup<?php echo $furnitureGroup->furnitureGroupId ?>" value="<?php echo $furnitureGroup->furnitureGroupId ?>" />
				<label class="radio-label" for="furnitureGroup<?php echo $furnitureGroup->furnitureGroupId ?>"> <?php echo $furnitureGroup->title; ?></label>
			</div>
		<?php endforeach; ?>
		<div class="row wizard-control">
			<div class="pull-right">
				<!--<a id="backToStep3" class="btn btn-primary btn-lg" href="<?php // echo Yii::app()->createUrl("/myfile/madrid/backTo3/id/$model->orderGroupId")                       ?>"><i class="glyphicon glyphicon-chevron-left"></i> ย้อนกลับ</a>-->
				<a id="furniture1Next" class="btn btn-success btn-lg" ><i class="glyphicon glyphicon-chevron-right"></i> ต่อไป</a>
			</div>
		</div>
	</div>
	<div class="row setup-content" id="step2">

	</div>
	<div class="row setup-content" id="step3">

	</div>
	<div class="row setup-content" id="step4">
		<?php $this->renderPartial("_furniture_condition") ?>
	</div>

	<?php $this->endWidget(); ?>
</div>