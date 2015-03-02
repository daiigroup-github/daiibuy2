<?php foreach($imageRow as $row):?>
<div class = "products-row row">

    <!--Carousel Heading -->
    <div class = "col-lg-12 col-md-12 col-sm-12">

        <div class = "carousel-heading">
            <h4><?php echo $row['title'];?></h4>
            <div class = "carousel-arrows">
                <i class = "icons icon-left-dir"></i>
                <i class = "icons icon-right-dir"></i>
            </div>
        </div>

    </div>
    <!--/Carousel Heading -->

    <!--Carousel -->
    <div class = "carousel owl-carousel-wrap col-lg-12 col-md-12 col-sm-12">

        <div class = "owl-carousel" data-max-items = "<?php echo isset($row['maxItems']) ? $row['maxItems'] : 4;?>">
            <?php $i=0;?>
            <?php foreach($row['images'] as $image): ?>
                <!--Slide -->
                <div>
                    <!--Carousel Item -->
                    <div class = "product">
                        <div class = "product-image">
                            <a href="<?php echo Yii::app()->baseUrl;?>/<?php echo $image;?>" class="fancybox" rel="gallery<?php echo $i;?>" title="">
                                <img src = "<?php echo Yii::app()->baseUrl;?>/<?php echo $image;?>" alt = "Product1">
                            </a>
                        </div>
                    </div>
                    <!--/Carousel Item -->
                </div>
                <!--/Slide -->
                <?php $i++;?>
            <?php endforeach; ?>
        </div>
    </div>
    <!--/Carousel -->

</div>
<?php endforeach;?>

<?php
Yii::app()->clientScript->registerScript('imageRow', "
    $('.fancybox').fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
");
?>