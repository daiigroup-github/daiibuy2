<div class="products-row row">

    <!--Carousel Heading -->
    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="carousel-heading">
            <h4><?php echo $title; ?></h4>

            <div class="carousel-arrows">
                <?php if (isset($moreUrl)): ?>
                    <a href="<?php echo Yii::app()->createUrl($moreUrl); ?>"><i class="icons icon-th-3"></i></a>
                <?php endif; ?>
                <i class="icons icon-left-dir"></i>
                <i class="icons icon-right-dir"></i>
            </div>
        </div>

    </div>
    <!--/Carousel Heading -->

    <!--Carousel -->
    <div class="carousel owl-carousel-wrap col-lg-12 col-md-12 col-sm-12">

        <div class="owl-carousel" data-max-items="<?php echo $maxItems; ?>">

            <!--Slide -->
            <div>
                <!--Carousel Item -->
                <div class="product">

                    <div class="product-image">
                        <span class="product-tag">Sale</span>
                        <img src="themes/homeshop/assets/img/products/sample4.jpg" alt="Product1">
                        <a href="<?php echo Yii::app()->createUrl('product/1'); ?>" class="product-hover">
                            <i class="icons icon-eye-1"></i> Quick View
                        </a>
                    </div>

                    <div class="product-info">
                        <h5><a href="<?php echo Yii::app()->createUrl('product/1'); ?>">Lorem ipsum dolor sit amet</a>
                        </h5>
                        <span class="price">$281.00</span>
                        <!-- <div class = "rating readonly-rating" data-score = "4"></div> -->
                    </div>

                    <div class="product-actions">
						<span class="add-to-cart">
							<span class="action-wrapper">
								<i class="icons icon-basket-2"></i>
								<span class="action-name">Add to cart</span>
							</span>
						</span>
                        <?php
                        /*
						<span class = "add-to-favorites">
							<span class = "action-wrapper">
								<i class = "icons icon-heart-empty"></i>
								<span class = "action-name">Add to wishlist</span>
							</span>
						</span>
						<span class = "add-to-compare">
							<span class = "action-wrapper">
								<i class = "icons icon-docs"></i>
								<span class = "action-name">Add to Compare</span>
							</span>
						</span>
						*/
                        ?>
                    </div>

                </div>
                <!--/Carousel Item -->
            </div>
            <!--/Slide -->

            <?php for ($i = 0; $i < 7; $i++): ?>
                <!--Slide -->
                <div>
                    <!--Carousel Item -->
                    <div class="product">

                        <div class="product-image">
                            <img src="themes/homeshop/assets/img/products/sample5.jpg" alt="Product1">
                            <a href="<?php echo Yii::app()->createUrl('product/' . $i); ?>" class="product-hover">
                                <i class="icons icon-eye-1"></i> Quick View
                            </a>
                        </div>

                        <div class="product-info">
                            <h5><a href="<?php echo Yii::app()->createUrl('product/1'); ?>">Lorem ipsum dolor sit
                                    amet</a></h5>
                            <span class="price">$281.00</span>
                            <!-- <div class = "rating readonly-rating" data-score = "4"></div> -->
                        </div>

                        <div class="product-actions">
							<span class="add-to-cart">
								<span class="action-wrapper">
									<i class="icons icon-basket-2"></i>
									<span class="action-name">Add to cart</span>
								</span>
							</span>
                            <?php
                            /*
                            <span class = "add-to-favorites">

                                <span class = "action-wrapper">
                                    <i class = "icons icon-heart-empty"></i>
                                    <span class = "action-name">Add to wishlist</span>
                                </span>
                            </span>

                            <span class = "add-to-compare">
                                <span class = "action-wrapper">
                                    <i class = "icons icon-docs"></i>
                                    <span class = "action-name">Add to Compare</span>
                                </span>
                            </span>
                            */
                            ?>
                        </div>

                    </div>
                    <!--/Carousel Item -->
                </div>
                <!--/Slide -->
            <?php endfor; ?>
        </div>
    </div>
    <!--/Carousel -->

</div>
