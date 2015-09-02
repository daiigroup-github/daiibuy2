    <div class="blog-item">

        <a href="<?php echo Yii::app()->createUrl($supplier['url']); ?>"><?php echo CHtml::image(Yii::app()->baseUrl . $supplier['logo']); ?></a>

        <div class="blog-info" style="min-height: 200px;">
            <h3>
                <a href="<?php echo Yii::app()->createUrl($supplier['url']); ?>"><?php echo $supplier['name']; ?></a>
            </h3>

            <p><?php echo $supplier['description']; ?></p>
        </div>

    </div>

