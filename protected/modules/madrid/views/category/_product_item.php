<?php
/*
  $data = [
  'id'=>'',
  'image'=>'',
  'url'=>'',
  'title'=>'',
  'price'=>'',
  'pricePromotion'=>'',
  'buttons'=>[
  'cart',
  'favorites',
  'compare',
  ],
  ];
 */
$image = '';
if (isset($data->productImages)) {
    foreach ($data->productImagesSort as $productImage) {
        $image = $productImage->image;
        break;
    }
}
?>
<!-- Product Item -->
<div
    class="<?php echo ($this->id == 'category') ? 'col-lg-4 col-md-4 col-sm-4' : 'col-lg-3 col-md-3 col-sm-4'; ?> product">

    <div class="product-image">
        <?php if (isset($data->productPromotion)): ?>
            <span class="product-tag">Sale</span>
        <?php endif; ?>
        <?php echo CHtml::image(Yii::app()->baseUrl . $image); ?>
        <?php /*
          <a href="<?php echo $this->createUrl('product/index/id/'.$data['productId']); ?>" class="product-hover">
          <i class="icons icon-eye-1"></i> Quick View
          </a>
         */
        ?>
    </div>

    <div class="product-info">
        <h5>
            <a href="<?php echo $this->createUrl('product/index/id/' . $data['productId']); ?>"><?php echo mb_substr($data['name'], 0, 29, 'utf8'); ?></a>
        </h5>


        <?php if ($data->noPerBox <> 0): ?>
            <span>ราคา <?php echo number_format($data->price / $data->noPerBox, 2); ?> บาท / แผ่น</span><br>
        <?php endif; ?>
        <?php if ($data->area <> 0): ?>
            <span>ราคา <?php echo number_format($data->price * (1 / $data->area), 2); ?> บาท / ตร.ม.</span><br>
        <?php endif; ?>
        <?php if ($data->noPerBox <> 0): ?>
            <span>จำนวน <?php echo number_format($data->noPerBox, 2); ?> แผ่น / <?php echo $data->productUnits; ?></span><br>
        <?php endif; ?>
        <?php if (isset($data->quantity)): ?>
            <span>Stock <?php echo $data->quantity; ?> <?php echo $data->productUnits; ?></span><br>
        <?php endif; ?>

        <?php if (isset($data['price'])): ?>
            <?php if (isset($data->productPromotion)): ?>
                <span >ราคา <del><?php echo number_format($data->price, 2); ?></del> บาท / <?php echo $data->productUnits; ?></span><br>
                <span class="price"> ราคาพิเศษ <?php echo number_format($data->productPromotion->price, 2); ?> บาท / <?php echo $data->productUnits; ?></span>
            <?php else: ?>
                <span class="price">ราคา <?php echo number_format($data->price, 2); ?> บาท / <?php echo $data->productUnits; ?></span>
            <?php endif; ?>
        <?php endif; ?>

    </div>

    <div class="product-actions">
        <span class="add-to-cart" data-productid="<?php echo $data['productId']; ?>">
            <span class="action-wrapper">
                <i class="icons icon-basket-2"></i>
                <span class="action-name">Add to cart</span>
            </span>
        </span>
        <?php if (!Yii::app()->user->isGuest): ?>
            <div class="product-actions" id="<?php echo $data['productId']; ?>" onclick="addFavouriteProduct(<?php echo Yii::app()->user->id ?>,<?php echo $data['productId'] ?>, '<?php echo Yii::app()->baseUrl; ?>', true)">
                <span class="add-to-favorites">
                    <span class="action-wrapper">
                        <i class="icons fa fa-heart-o"></i>
                        <span class="action-name">Add to wishlist</span>
                    </span>
                </span>
            </div>
        <?php endif; ?>
    </div>

</div>
<!-- Product Item -->