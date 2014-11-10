<div class="row">
	<div class="col-md-12">
		<?php echo $model->title; ?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<?php echo CHtml::image(Yii::app()->baseUrl . $model->image, $model->title); ?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<?php echo $model->description; ?>
	</div>
</div>