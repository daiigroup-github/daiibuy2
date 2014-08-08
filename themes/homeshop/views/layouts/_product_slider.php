<div id="product-slider">
    <ul class="slides">
        <li>
            <img class="cloud-zoom" src="<?php echo $images[0];?>" data-large="<?php echo $images[0];?>" alt="" />
            <a class="fullscreen-button" href="<?php echo $images[0];?>">
                <div class="product-fullscreen">
                    <i class="icons icon-resize-full-1"></i>
                </div>
            </a>
        </li>
    </ul>
</div>
<div id="product-carousel">
    <ul class="slides">
        <?php foreach($images as $image):?>
            <li>
                <a class="fancybox" rel="product-images" href="<?php echo $image;?>"></a>
                <img src="<?php echo $image;?>" data-large="<?php echo $image;?>" alt=""/>
            </li>
        <?php endforeach;?>
    </ul>
    <?php if(sizeof($images) > 4):?>
        <div class="product-arrows">
            <div class="left-arrow">
                <i class="icons icon-left-dir"></i>
            </div>
            <div class="right-arrow">
                <i class="icons icon-right-dir"></i>
            </div>
        </div>
    <?php endif;?>
</div>