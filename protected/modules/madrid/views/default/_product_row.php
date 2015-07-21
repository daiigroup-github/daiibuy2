<div class="products-row row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="carousel-heading">
            <h4><?php echo $title; ?></h4>
            <div class="carousel-arrows">
                <?php if (isset($moreUrl)): ?>
                    <a href="<?php echo $moreUrl; ?>"><i class="icons icon-th-3"></i></a>
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
            <?php
            foreach ($items as $item):
//                throw new Exception(print_r($items, true));
                ?>
                <!--Slide -->
                <div>
                    <!--Carousel Item -->
                    <div class="product">
                        <div class="product-image">
                            <?php if ($item['promotionPrice'] > 0): ?>
                                <span class="product-tag">Sale</span>
                            <?php endif; ?>
                            <img src="<?php echo isset($item['images'][0]->image) ? Yii::app()->baseUrl . $item['images'][0]->image : ''; ?>" alt="Product1">
                            <a href="<?php echo $item['url']; ?>" class="product-hover">
                                <i class="icons icon-eye-1"></i> Quick View
                            </a>
                        </div>
                        <div class="product-info" style="height: 140px;">
                            <h5><a href="<?php echo $item['url']; ?>"><?php echo $item['name']; ?></a></h5>
                            <?php if ($item['promotionPrice'] > 0) { ?>
                                <span >ราคา <del><?php echo number_format($item['price'], 2); ?></del> บาท</span><br>
                                <span class="price">พิเศษ <?php echo number_format($item['promotionPrice'], 2); ?> บาท</span>
                            <?php } else { ?>
                                <span class="price">ราคา <?php echo number_format($item['price'], 2); ?> บาท</span>
                            <?php } ?>
                            <!-- <div class = "rating readonly-rating" data-score = "4"></div> -->
                            <input type="hidden" value="1" id=" <?php echo $item['productId']; ?>" name="qty[<?php echo $item['productId']; ?>]"/>
                        </div>


                        <div class="product-actions">
                            <span class="add-to-cart"  data-productid="<?php echo $item['productId']; ?>">
                                <span class="action-wrapper">
                                    <i class="icons icon-basket-2"></i>
                                    <span class="action-name">Add To Cart</span>
                                </span>
                            </span>
                            <?php
                            $cate2ToProduct = Category2ToProduct::model()->find('brandId = 4 AND productId = ' . $item['productId']);
                            if (isset($cate2ToProduct->category2Id)):
                                if ($cate2ToProduct->type == 1 && $cate2ToProduct->category2Id <> 87):
                                    ?>
                                    <span class="add-to-favorites" id="<?php echo $item['productId']; ?>" onclick='<?php echo $cate2ToProduct->type == 1 ? "addFavouriteProduct(" . Yii::app()->user->id . ", " . $item['productId'] . ', "' . Yii::app()->baseUrl . '");' : "addFavourite(" . Yii::app()->user->id . ", " . $cate2ToProduct->category2Id . ", '" . Yii::app()->baseUrl . "', 2);"; ?>'>
                                        <span class="action-wrapper">
                                            <i class="icons fa fa-heart-o"></i>
                                            <span class="action-name">Add to My File</span>
                                        </span>
                                    </span>

                                    <?php
                                endif;
                            endif;
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
                        <?php
//                        throw new Exception(print_r($cate2ToProduct, true));
                        ?>
                        <!--                            <div class="product-actions" >
                        <?php
                        //
//                            $icon = 'fa fa-heart-o';
//                            $name = 'Add to wishlist';
                        ?>
                                                        <span class="add-to-wishlist" id="<?php // echo $item['productId'];                              ?>" onclick="addFavourite(<?php // echo Yii::app()->user->id                              ?>,<?php // echo $cate2ToProduct->category2Id;                              ?>, '<?php echo Yii::app()->baseUrl; ?>', true)">
                                                            <span class="action-wrapper">
                                                                <i class="icons fa fa-heart-o"></i>
                                                                <span class="action-name">Add to wishlist</span>
                                                            </span>
                                                        </span>-->
                        <?php /*
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
                          <span class="add-to-compare">
                          <span class="action-wrapper">
                          <i class="icons icon-docs"></i>
                          <span class="action-name">Add to Compare</span>
                          </span>
                          </span>
                         */
                        ?>
                        <!--</div>-->
                        <?php // endif;  ?>

                    </div>
                    <!--/Carousel Item -->
                </div>
                <!--/Slide -->
            <?php endforeach; ?>
        </div>
    </div>
    <!--/Carousel -->

</div>

<?php
/*
  Yii::app()->clientScript->registerScript('addToCart', "
  $('.add-to-cart').live('click', function(){
  var pid = $(this).attr('id');
  $.ajax({
  type : 'POST',
  url : '".Yii::app()->createUrl('cart/addToCart')."',
  dataType : 'json',
  data : {productId:pid},
  beforeSend : function(){
  //spinning
  alert(pid);
  },
  success : function(data){
  //success
  alert(data.result);
  },
  fail : function(){
  //fail
  },
  });
  });
  ");
 */
?>