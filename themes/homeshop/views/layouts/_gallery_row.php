<div class="products-row row">

    <!--Carousel Heading -->
    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="carousel-heading">
            <h4><?php echo $title; ?></h4>

            <div class="carousel-arrows">
                <i class="icons icon-left-dir"></i>
                <i class="icons icon-right-dir"></i>
            </div>
        </div>

    </div>
    <!--/Carousel Heading -->

    <!--Carousel -->
    <div class="carousel owl-carousel-wrap col-lg-12 col-md-12 col-sm-12">

        <div class="owl-carousel" data-max-items="<?php echo $maxItems; ?>">
            <?php foreach ($images as $image): ?>
                <!--Slide -->
                <div>
                    <!--Carousel Item -->
                    <div class="product">

                        <div class="product-image">
                            <img src="<?php echo Yii::app()->baseUrl.$image['url'];?>" />
                        </div>

                        <div class="product-info">
                            <h5><?php echo $image['title'];?></h5>
                        </div>

                    </div>
                    <!--/Carousel Item -->
                </div>
                <!--/Slide -->
            <?php endforeach; ?>
        </div>
    </div>
    <!--/Carousel -->

</div>
