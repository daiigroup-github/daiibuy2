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
if(isset($data->productImages))
{
	foreach($data->productImagesSort as $productImage)
	{
		$image = $productImage->image;
		break;
	}
}
?>
<!-- Product Item -->
<div
    class="<?php echo ($this->id == 'category') ? 'col-lg-4 col-md-4 col-sm-4' : 'col-lg-3 col-md-3 col-sm-4'; ?> product">

    <div class="product-image">
		<?php if(isset($data->productPromotion)): ?>
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
		<?php if(isset($data['price'])): ?>
			<?php if(isset($data->productPromotion)): ?>
				<span class="price"><del><?php echo number_format($data->price, 2); ?></del><?php echo number_format($data->productPromotion->price, 2); ?></span>
			<?php else: ?>
				<span class="price">ราคา <?php echo number_format($data->price, 2); ?> บาท</span>
			<?php endif; ?>
		<?php endif; ?>
    </div>

    <div class="product-actions">
        <span class="add-to-cart" id="<?php echo $data['productId']; ?>">
			<span class="action-wrapper">
                <i class="icons icon-basket-2"></i>
                <span class="action-name">Add to cart</span>
			</span>
		</span>
    </div>

</div>
<!-- Product Item -->