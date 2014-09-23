<div id="product-single">

    <!-- Product -->
    <div class="product-single">

        <div class="row">

            <!-- Product Images Carousel -->
            <div class="col-lg-5 col-md-5 col-sm-5 product-single-image">
                <?php $this->renderPartial('//layouts/_product_slider', array('images' => $product['images'])); ?>
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

                <?php //if (isset($product['attributes'])) $this->renderPartial('//layouts/_product_attributes', array('attributes' => $product['attributes'])); ?>
                <?php //if (isset($product['description'])) $this->renderPartial('//layouts/_product_description', array('description' => $product['description'])); ?>

                <?php if (isset($product['attributes']) || isset($product['description'])): ?>
                    <table>
                        <?php
                        if (isset($product['attributes'])):
                            foreach ($product['attributes'] as $k => $v):
                                ?>
                                <tr>
                                    <td><?php echo $k; ?></td>
                                    <td><?php echo $v; ?></td>
                                </tr>
                            <?php
                            endforeach;
                        endif;
                        ?>

                        <?php
                        if (isset($product['description']))
                            echo '<tr><td colspan="2">' . $product['description'] . '</td></tr>';
                        ?>
                    </table>
                <?php endif; ?>

                <span class="price">
                <?php if (isset($product['price'])): ?>
                    <?php if ($product['pricePromotion']): ?>
                        <del><?php echo $product['price']; ?></del> <?php echo $product['pricePromotion']; ?>
                    <?php else: ?>
                        <?php echo $product['price']; ?>
                    <?php endif; ?>
                <?php endif; ?>
                บาท</span>

                <table class="product-actions-single">
                    <tr>
                        <td>Color:</td>
                        <td>
                            <select class="chosen-select-full-width">
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
                            <div class="numeric-input full-width">
                                <input type="text" value="1" class="form-control">
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
                </div>
                <br/>
            </div>

        </div>

    </div>
    <!-- /Product -->

    <!-- Product tabs -->
    <?php $this->renderPartial('//layouts/_product_tab', array('tabs' => $product['tabs'])); ?>

</div>
