<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="grid-view product">
        <div class="product-image col-lg-4 col-md-4 col-sm-4">
            <?php //echo CHtml::link(CHtml::image(Yii::app()->baseUrl . $brandModel->image, $brandModel->title), $this->createUrl('category/index/id/' . $brandModel->brandModelId)); ?>
			<?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl . $brandModel->image, $brandModel->title), $this->createUrl('style/index/id/' . $brandModel->brandModelId)); ?>
        </div>

        <div class="col-lg-8 col-md-8 col-sm-8 product-content no-padding" style="height: 290px;">
            <div class="product-info">
<!--                <h5>--><?php //echo CHtml::link($brandModel->title, $this->createUrl('category/index/id/' . $brandModel->brandModelId)); ?><!--</h5>-->
                <h5><?php echo CHtml::link($brandModel->title, $this->createUrl('style/index/id/' . $brandModel->brandModelId)); ?></h5>

                <p><?php echo $brandModel->description; ?></p>
            </div>
        </div>
    </div>

</div>