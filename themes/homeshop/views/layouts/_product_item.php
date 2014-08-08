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
?>
<!-- Product Item -->
<div
    class="<?php echo ($this->id == 'category') ? 'col-lg-4 col-md-4 col-sm-4' : 'col-lg-3 col-md-3 col-sm-4'; ?> product">

    <div class="product-image">
        <?php //<img src="img/products/sample1.jpg" alt="Product1">?>
        <?php echo CHtml::image($data['image'], $data['title']); ?>
        <?php if($data['isQuickView']):?>
        <a href="<?php echo $data['url']; ?>" class="product-hover">
            <i class="icons icon-eye-1"></i> Quick View
        </a>
        <?php endif;?>
    </div>

    <div class="product-info">
        <h5><a href="<?php echo $data['url']; ?>"><?php echo $data['title']; ?></a></h5>
        <?php if (isset($data['price'])): ?>
            <?php if (isset($data['pricePromotion'])): ?>
                <span class="price"><del><?php echo number_format($data['price'], 2); ?></del><<?php echo number_format($data['pricePromotion'], 2); ?>/span>
            <?php else: ?>
                <span class="price"><?php echo number_format($data['price'], 2); ?></span>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <?php if (isset($data['buttons'])): ?>
        <div class="product-actions">
            <?php
            foreach ($data['buttons'] as $button):
                switch ($button) {
                    case 'cart':
                        $icon = 'icon-basket-2';
                        $name = 'Add to cart';
                        break;

                    case 'favorites':
                        $icon = 'icon-heart-empty';
                        $name = 'Add to wishlist';
                        break;

                    case 'compare':
                        $icon = 'icon-docs';
                        $name = 'Add to compare';
                        break;
                }
                ?>
                <span class="add-to-<?php echo $button; ?>">
			<span class="action-wrapper">
				<i class="icons <?php echo $icon; ?>"></i>
				<span class="action-name"><?php echo $name; ?></span>
			</span>
		</span>
            <?php endforeach; ?>
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
        </div>
    <?php endif; ?>

</div>
<!-- Product Item -->