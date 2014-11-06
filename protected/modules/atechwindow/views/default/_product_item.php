<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="grid-view product">
        <div class="product-image col-lg-4 col-md-4 col-sm-4">
			<?php echo CHtml::link(CHtml::image(Yii::app()->createUrl($category->image), $category->title), $this->createUrl('category/index?id=' . $category->categoryId . (isset($category1Id) ? "&category1Id=" . $category1Id : ""))); ?>
        </div>

        <div class="col-lg-8 col-md-8 col-sm-8 product-content no-padding" style="height: 290px;">
            <div class="product-info">
                <h5><?php echo CHtml::link($category->title, $this->createUrl('category/index?id=' . $category->categoryId . (isset($category1Id) ? "&category1Id=" . $category1Id : ""))); ?></h5>

                <p><?php echo $category->description; ?></p>
            </div>
        </div>
    </div>

</div>