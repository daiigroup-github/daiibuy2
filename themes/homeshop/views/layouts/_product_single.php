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
                    </table
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

    <!-- Product Tabs -->
    <?php
    //Prepare Tab
    $i = 1;
    $tabHeading = '';
    $tabContent = '';
    foreach ($product['tabs'] as $tab) {
        $title = $tab['title'];
        //$tabHeading .= "<a href=\"#tab$i\" class=\"button big\">$title</a> ";
        $tabHeading .= CHtml::link($tab['title'] . ' ', '#tab' . $i, array('class' => 'button big')) . ' ';
        $tabContent .= '<div id="tab' . $i . '">' . $tab['detail'] . '</div>';
        $i++;
    }
    ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="tabs">
                <div class="tab-heading">
                    <?php /*
					<a href="#tab1" class="button big">Description</a>
					<a href="#tab2" class="button big">Reviews</a>
					<a href="#tab3" class="button big">Comments</a>
                    */
                    ?>
                    <?php echo $tabHeading; ?>
                </div>

                <div class="page-content tab-content">
                    <?php /*
					<div id="tab1">
						Tab1
					</div>
					<div id="tab2">
						Tab2
					</div>
					<div id="tab3">
						Tab3
					</div>
                    */
                    ?>
                    <?php echo $tabContent; ?>
                </div>
            </div>
        </div>
    </div>

</div>
