<div class="row">

    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="carousel-heading no-margin">
            <h4><?php echo $model->title; ?></h4>
        </div>

        <div class="page-content">
            <?php if (isset($model->image)): ?>
    <!--                <p><?php echo CHtml::image(Yii::app()->baseUrl . $model->image, $model->title); ?></p>-->
                <embed src="<?= Yii::app()->baseUrl . $model->image ?>" width="100%" height="1000"></embed>
            <?php endif; ?>
            <?php echo $model->description; ?>
        </div>

    </div>

</div>