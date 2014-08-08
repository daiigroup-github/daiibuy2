<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="grid-view product">
        <div class="product-image col-lg-4 col-md-4 col-sm-4">
            <?php echo CHtml::image($data['image'], $data['title']); ?>
            <?php if($data['isQuickView']):?>
            <a href="<?php echo $data['url']; ?>" class="product-hover">
                <i class="icons icon-eye-1"></i> Quick View
            </a>
            <?php endif;?>
        </div>

        <div class="col-lg-8 col-md-8 col-sm-8 product-content no-padding" style="height: 290px;">
            <div class="product-info">
                <h5><?php echo CHtml::link($data['title'], $data['url']); ?></h5>
                <?php if (isset($data['pricePromotion'])): ?>
                    <span class="price"><del><?php echo number_format($data['price'], 2); ?></del><<?php echo number_format($data['pricePromotion'], 2); ?>/span>
                <?php else: ?>
                    <span class="price"><?php echo $data['price']; ?></span>
                <?php endif; ?>

                <?php if (isset($data['rating'])): ?>
                    <div class="rating-box">
                        <div class="rating readonly-rating" data-score="4"></div>
                        <span>3 Review(s)</span>
                    </div>
                <?php endif; ?>
                <p><?php echo $data['description']; ?></p>
            </div>


            <?php if (isset($data['buttons'])): ?>
                <div class="product-actions full-width">
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
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>