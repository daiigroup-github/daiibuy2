<div id="product-single">

    <!-- Product -->


    <div class="row">

        <!-- Product Images Carousel -->
        <div class="col-lg-5 col-md-5 col-sm-5 product-single-image">
            <?php $this->renderPartial('//layouts/_product_slider', array('images' => $subCate)); ?>
        </div>
        <!-- /Product Images Carousel -->


        <div class="col-lg-7 col-md-7 col-sm-7 product-single-info">

            <h2><?php echo $subCate->title; ?></h2>
            <?php echo $subCate->description; ?>
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

            <?php // if (isset($product['attributes']) || isset($product['description'])): ?>
<!--                    <table>
            <?php
//                        if (isset($product['attributes'])):
//                            foreach ($product['attributes'] as $k => $v):
            ?>
                                <tr>
                                    <td><?php // echo $k;                                                     ?></td>
                                    <td><?php // echo $v;                                                     ?></td>
                                </tr>
            <?php
//                            endforeach;
//                        endif;
            ?>

            <?php
//                        if (isset($product['description']))
//                            echo '<tr><td colspan="2">' . $product['description'] . '</td></tr>';
            ?>
                    </table
            <?php // endif; ?>

                <span class="price">
            <?php // if (isset($product['price'])): ?>
            <?php // if ($product['pricePromotion']): ?>
                            <del><?php // echo $product['price'];                                                     ?></del> <?php // echo $product['pricePromotion'];                                                    ?>
            <?php // else: ?>
            <?php // echo $product['price']; ?>
            <?php // endif; ?>
                        บาท
            <?php // endif; ?>
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
                </table>-->

            <?php // if (isset($product['actions'])): ?>
            <!--                    <div class="product-actions">
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
                                    </span>-->
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
            <!--</div>-->
            <?php // endif; ?>
            <!--<br/>-->
        </div>

    </div>
    <?php
//    throw new Exception(print_r($subCate->categoryId, true));
    $categoryToProduct = Category2ToProduct::model()->findAll('category1Id = ' . $subCate->categoryId);

//    throw new Exception(print_r($categoryToProduct, true));
    ?>
    <div class="row sidebar-box-heading orange">
        <i class="icons <?php echo 'fa fa-file-o'; ?>"></i>
        <h4><?php echo "Brand :: ATECH " . $categoryToProduct[0]->brandModel->title; ?></h4>
    </div>

    <!-- /Product -->

    <!-- Product tabs -->
    <?php // $this->renderPartial('//layouts/_product_tab', array('tabs' => $product['tabs']));   ?>

</div>
