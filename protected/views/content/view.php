<div class="row">

	<?php $this->renderPartial('//layouts/_ios_slider'); ?>

    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="carousel-heading no-margin">
            <h4><?php echo $model->title; ?></h4>
        </div>

        <div class="page-content">
			<?php if(isset($model->image)): ?>
	            <p><?php echo CHtml::image(Yii::app()->baseUrl . $model->image, $model->title); ?></p>
			<?php endif; ?>
			<?php echo $model->description; ?>
        </div>

    </div>

</div>