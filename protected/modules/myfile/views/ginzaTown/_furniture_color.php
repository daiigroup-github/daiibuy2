<?php foreach($furnitures as $furniture): ?>
	<div class="col-lg-6 text-center">
		<img src="<?php echo Yii::app()->baseUrl . $furniture->image; ?>" style="width: 70%" /><br>
		<input type="radio" name="furnitureId" id="furniture<?php echo $furniture->furnitureId ?>" value="<?php echo $furniture->furnitureId ?>"  <?php echo (isset($model->fur[0]) && $model->fur[0]->furnitureId == $furniture->furnitureId) ? " checked " : " " ?>/>
		<label class="radio-label" for="furniture<?php echo $furniture->furnitureId ?>"> <?php echo $furniture->title; ?></label>
	</div>
<?php endforeach; ?>

<div class="row wizard-control">
	<div class="pull-right">
		<!--<a id="backToStep3" class="btn btn-primary btn-lg" href="<?php // echo Yii::app()->createUrl("/myfile/madrid/backTo3/id/$model->orderGroupId")                 ?>"><i class="glyphicon glyphicon-chevron-left"></i> ย้อนกลับ</a>-->
		<a id="furniture2Back" class="btn btn-primary btn-lg" ><i class="glyphicon glyphicon-chevron-left"></i> กลับ</a>
		<a id="furniture2Next" class="btn btn-success btn-lg" ><i class="glyphicon glyphicon-chevron-right"></i> ต่อไป</a>
	</div>
</div>