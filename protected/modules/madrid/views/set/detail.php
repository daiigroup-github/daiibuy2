<?php $this->renderPartial('//layouts/_carousel_heading', array('title' => $product['title'])); ?>
<div id="product-single">

    <!-- Product -->
    <div class="product-single">

        <div class="row">

            <!-- Product Images Carousel -->
            <div class="col-lg-5 col-md-5 col-sm-5 product-single-image">

                <div id="product-slider">
                    <ul class="slides">
                        <li>
                            <img class="cloud-zoom" src="<?php echo $product['images'][0]; ?>"
                                 data-large="<?php echo $product['images'][0]; ?>" alt=""/>
                            <a class="fullscreen-button" href="<?php echo $product['images'][0]; ?>">
                                <div class="product-fullscreen">
                                    <i class="icons icon-resize-full-1"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div id="product-carousel">
                    <ul class="slides">
                        <?php foreach ($product['images'] as $image): ?>
                            <li>
                                <a class="fancybox" rel="product-images" href="<?php echo $image; ?>"></a>
                                <img src="<?php echo $image; ?>" data-large="<?php echo $image; ?>" alt=""/>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php if (sizeof($product['images']) > 4): ?>
                        <div class="product-arrows">
                            <div class="left-arrow">
                                <i class="icons icon-left-dir"></i>
                            </div>
                            <div class="right-arrow">
                                <i class="icons icon-right-dir"></i>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- /Product Images Carousel -->


            <div class="col-lg-7 col-md-7 col-sm-7 product-single-info">

                <h2><?php echo $product['title']; ?></h2>
                <?php
                /*
                <div class="rating-box">
                    <div class="rating readonly-rating" data-score="4"></div>
                    <span>3 Review(s)</span>
                </div>
                */
                ?>
                <table>
                    <tr>
                        <td>รหัสสินค้า</td>
                        <td><?php echo $product['code']; ?></td>
                    </tr>
                    <tr>
                        <td>ประเภท</td>
                        <td><a href="#"><?php echo $product['category']; ?></a></td>
                    </tr>
                    <tr>
                        <td>จำนวนคงเหลือ</td>
                        <td>
                            <span
                                class="<?php echo (isset($product['stock']) && $product['stock'] > 0) ? 'green' : 'red'; ?>"><?php echo (isset($product['stock']) && $product['stock'] > 0) ? 'In stock ' . $product['stock'] : 'Out of stock'; ?></span>
                        </td>
                    </tr>
                </table>

                <?php if (isset($product['dimension'])): ?>
                    <strong>Product Dimensions</strong>
                    <table>
                        <tr>
                            <td>กว้าง x ยาว x สูง</td>
                            <td>
                                <?php
                                $dimension = '';
                                foreach ($product['dimension'] as $v) {
                                    $dimension .= $v . ' x ';
                                }

                                echo substr($dimension, 0, -3);
                                ?>
                            </td>
                        </tr>
                    </table>
                <?php endif; ?>

                <span class="price">
					<?php if ($product['pricePromotion']): ?>
                        <del><?php echo $product['price']; ?></del> <?php echo $product['pricePromotion']; ?>
                    <?php else: ?>
                        <?php echo $product['price']; ?>
                    <?php endif; ?>
                    บาท
				</span>

                <table class="product-actions-single">
                    <tr>
                        <td>Color:</td>
                        <td>
                            <select class="chosen-select">
                                <option>Red +$25.00</option>
                                <option>Red +$25.00</option>
                                <option>Red +$25.00</option>
                                <option>Red +$25.00</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Quantity:</td>
                        <td>
                            <div class="numeric-input">
                                <input type="text" value="1">
                                <span class="arrow-up"><i class="icons icon-up-dir"></i></span>
                                <span class="arrow-down"><i class="icons icon-down-dir"></i></span>
                            </div>
                            <?php
                            /*
                            <a href="#">
                                <span class="add-to-cart">
                                    <span class="action-wrapper">
                                        <i class="icons icon-basket-2"></i>
                                        <span class="action-name">Add to cart</span>
                                    </span >
                                </span>
                            </a>
                            */
                            ?>
                        </td>
                    </tr>
                </table>

                <div class="product-actions">
								<span class="add-to-cart">
									<span class="action-wrapper">
										<i class="icons icon-basket-2"></i>
										<span class="action-name">Add to cart</span>
									</span>
								</span>
					<span class="add-to-favorites">
						<span class="action-wrapper">
							<i class="icons icon-heart-empty"></i>
							<span class="action-name">Add to wishlist</span>
						</span>
					</span>
                    <?php
                    /*
                        <span class="add-to-compare">
                            <span class="action-wrapper">
                                <i class="icons icon-docs"></i>
                                <span class="action-name">Add to compare</span>
                            </span>
                        </span>
                        <span class="green product-action">
                            <span class="action-wrapper">
                                <i class="icons icon-info"></i>
                                <span class="action-name">Ask a question</span>
                            </span>
                        </span>
                    */
                    ?>
                </div>
                <br/>
            </div>

        </div>

    </div>
    <!-- /Product -->

</div>
