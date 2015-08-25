<div id="product-slider">
    <ul class="slides">
        <li>
			<?php if(isset($images)): ?>
				<img class="cloud-zoom" src="<?php echo isset($images->image) ? Yii::app()->createUrl($images->image) : (isset($images[0]) ? $images[0] : "" ); ?>" data-large="<?php echo isset($images->image) ? Yii::app()->createUrl($images->image) : (isset($images[0]) ? $images[0] : "" ); ?>" alt="" />
				<a class="fullscreen-button" href="<?php echo isset($images->image) ? Yii::app()->createUrl($images->image) : (isset($images[0]) ? $images[0] : "" ); ?>">
					<div class="product-fullscreen">
						<i class="icons icon-resize-full-1"></i>
					</div>
				</a>
				<?php
			endif;
			?>
        </li>
    </ul>
</div>
<div id="product-carousel" >
    <ul class="slides">
		<?php foreach($images->images as $image): ?>
			<li>
				<a class="fancybox" rel="product-images" href="<?php echo $image->image; ?>"></a>
				<img src="<?php echo $image->image; ?>" data-large="<?php echo $image->image; ?>" alt="" id="imageThumbnail<?php echo $image->categoryImageId; ?>" />
			</li>
		<?php endforeach; ?>
    </ul>
	<?php if(sizeof($images->images) > 4): ?>
		<div class="product-arrows">
			<div class="left-arrow">
				<i class="icons icon-left-dir"></i>
			</div>
			<div class="right-arrow">
				<i class="icons icon-right-dir"></i>
			</div>
		</div>
	<?php endif; ?>
</div>