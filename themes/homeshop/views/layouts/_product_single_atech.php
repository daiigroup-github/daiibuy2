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
                                    <td><?php // echo $k;                                                                                                                                                     ?></td>
                                    <td><?php // echo $v;                                                                                                                                                     ?></td>
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
                            <del><?php // echo $product['price'];                                                                                                                                                     ?></del> <?php // echo $product['pricePromotion'];                                                                                                                                                    ?>
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
    $categoryToProducts = Category2ToProduct::model()->findAll('category1Id = ' . $subCate->categoryId . ' and brandId = ' . $brandId);

//    throw new Exception(print_r($categoryToProduct, true));
    ?>
    <div class="row sidebar-box-heading orange">
        <i class="icons <?php echo 'fa fa-file-o'; ?>"></i>
        <h4><?php echo "Brand :: ATECH " . $categoryToProducts[0]->brandModel->title; ?></h4>
    </div>

    <!-- /Product -->
    <div class="row sidebar-box-content">
        <table class="table-hover table">
            <thead>
                <tr>
                    <!--<th>ประเภท</th>-->
                    <th>สี</th>
                    <th>รุ่น</th>
                    <th>ขนาด กว้าง x สูง (ซ.ม.)</th>
                    <th>ราคา</th>
                    <th>จำนวน</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($categoryToProducts as $categoryToProduct):
                    $category2 = Category::model()->findByPk($categoryToProduct->category2Id);
                    $price = ($categoryToProduct->product->calProductPromotionPrice() != 0) ? $categoryToProduct->product->calProductPromotionPrice() : $categoryToProduct->product->calProductPrice();
                    ?>
                    <tr>
    <!--                        <td>
                        <?php // echo $category2->title; ?>
                        </td>-->
                        <td>
                            <?php
                            //                            throw new Exception(print_r($categoryToProduct->product->productOptionGroups[0]->productOptions[0]->title, true));
//                            echo isset($categoryToProduct->product->productOptionGroups[0]) ? CHtml::dropDownList(get_class($categoryToProduct->product->productOptionGroups[0]) . '[' . $categoryToProduct->product->productOptionGroups[0]->productOptionGroupId . ']', '', CHtml::listData($categoryToProduct->product->productOptionGroups[0]->productOptions, 'productOptionId', 'title'), array(
//                                        'class' => 'chosen-select-full-width', 'id' => 'c' . $categoryToProduct->product->productId)) : "none";
                            echo Chtml::textField('color', isset($categoryToProduct->product->productOptionGroups[0]->productOptions[0]) ? $categoryToProduct->product->productOptionGroups[0]->productOptions[0]->title : "WHITE", array('id' => 'c' . $categoryToProduct->product->productId, 'disabled' => true,
                                'data-productoptionid' => isset($categoryToProduct->product->productOptionGroups[0]->productOptions[0]) ? $categoryToProduct->product->productOptionGroups[0]->productOptions[0]->productOptionId : "NONE"));
                            ?>
                        </td>
                        <td>
                            <?php echo $categoryToProduct->brand->title; ?>
                        </td>
                        <td>
                            <?php
                            echo (isset($categoryToProduct->product->width) && isset($categoryToProduct->product->height)) ? number_format($categoryToProduct->product->width, 0) . " x " . number_format($categoryToProduct->product->height, 0) : 'NONE';
                            ?>
                        </td>
                        <td><?php echo number_format($price, 2); ?></td>
                        <td>
                            <div class="numeric-input full-width">
                                <input type="text" value="1" id="<?php echo $categoryToProduct->product->productId ?>" name="qty[<?php echo $categoryToProduct->product->productId ?>]"/>
                                <span class="arrow-up"><i class="icons icon-up-dir"></i></span>
                                <span class="arrow-down"><i class="icons icon-down-dir"></i></span>
                            </div>
                        </td>
                        <td><a class="btn btn-primary btn-md addToCart" id="b<?php echo $categoryToProduct->productId; ?>" data-productid="<?php echo $categoryToProduct->product->productId; ?>"><i class="fa fa-shopping-cart"></i>เพิ่มลงตระกร้า</a>
    <!--                            <a class="btn btn-success btn-xs" href="<?php // echo Yii::app()->createUrl("/atechwindow/category/viewOtherProduct?id=" . $category2ToProduct->id);                                                                    ?>">ดูรายการอื่นๆ</a>-->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Product tabs -->
    <?php // $this->renderPartial('//layouts/_product_tab', array('tabs' => $product['tabs']));          ?>

</div>
