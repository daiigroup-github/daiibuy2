<div id="product-slider<?php echo isset($images->categoryId) ? $images->categoryId : "" ?>">
    <ul class="slides">
        <li>
			<?php
			if(isset($images)):
				?>
				<img class="cloud-zoom" src="<?php echo isset($images->image) ? Yii::app()->createUrl($images->image) : (isset($images[0]) ? Yii::app()->baseUrl . $images[0] : "" ); ?>" data-large="<?php echo isset($images->image) ? Yii::app()->createUrl($images->image) : (isset($images[0]) ? Yii::app()->baseUrl . $images[0] : "" ); ?>" alt="" />
				<a class="fullscreen-button" href="<?php echo isset($images->image) ? Yii::app()->createUrl(Yii::app()->baseUrl . $images->image) : (isset($images[0]) ? Yii::app()->baseUrl . $images[0] : "" ); ?>">
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
<div id="product-carousel<?php echo isset($images->categoryId) ? $images->categoryId : "" ?>" >
    <ul class="slides">
		<?php if(isset($images->categoryId)): ?>
			<li>
				<a class="fancybox" rel="product-images" href="<?php echo isset($images->categoryId) ? Yii::app()->baseUrl . $images->image : ""; ?>"></a>
				<img src="<?php echo Yii::app()->baseUrl . $images->image; ?>" data-large="<?php echo Yii::app()->baseUrl . $images->image; ?>" alt="" id="imageThumbnail<?php echo isset($images->categoryId) ? $images->categoryId : "" ?>" />
			</li>
			<?php foreach($images->images as $image): ?>
				<li>
					<a class="fancybox" rel="product-images" href="<?php echo Yii::app()->baseUrl . $image->image; ?>"></a>
					<img src="<?php echo Yii::app()->baseUrl . $image->image; ?>" data-large="<?php echo Yii::app()->baseUrl . $image->image; ?>" alt="" id="imageThumbnail<?php echo $image->categoryImageId; ?>" />
				</li>
				<?php
			endforeach;
			?>
		<?php else: ?>
			<?php foreach($images as $id=> $image): ?>
				<li>
					<a class="fancybox" rel="product-images" href="<?php echo Yii::app()->baseUrl . $image; ?>"></a>
					<img src="<?php echo Yii::app()->baseUrl . $image; ?>" data-large="<?php echo Yii::app()->baseUrl . $image; ?>" alt="" id="imageThumbnail<?php echo $id; ?>" />
				</li>
				<?php
			endforeach;
			?>
		<?php endif; ?>

    </ul>
	<?php
	if(isset($images->categoryId)):
		if(sizeof($images->images) > 4):
			?>
			<div class="product-arrows">
				<div class="left-arrow">
					<i class="icons icon-left-dir"></i>
				</div>
				<div class="right-arrow">
					<i class="icons icon-right-dir"></i>
				</div>
			</div>
		<?php endif; ?>
	<?php else: ?>
		<?php if(sizeof($images) > 4):
			?>
			<div class="product-arrows">
				<div class="left-arrow">
					<i class="icons icon-left-dir"></i>
				</div>
				<div class="right-arrow">
					<i class="icons icon-right-dir"></i>
				</div>
			</div>
		<?php endif; ?>
	<?php endif; ?>
</div>
<?php
if(isset($images->categoryId)):
	Yii::app()->clientScript->registerScript("slider$images->categoryId", "
		$('#product-carousel$images->categoryId').flexslider({
		animation: 'slide',
		controlNav: false,
		animationLoop: false,
		directionNav: false,
		slideshow: false,
		itemWidth: 80,
		itemMargin: 0,
		start: function (slider) {
			setActive($('#product-carousel$images->categoryId li:first-child img'));
			slider.find('.right-arrow').click(function () {
				slider.flexAnimate(slider.getTarget('next'));
			});

			slider.find('.left-arrow').click(function () {
				slider.flexAnimate(slider.getTarget('prev'));
			});

			slider.find('img').click(function () {
				var large = $(this).attr('data-large');
				setActive($(this));
				$('#product-slider$images->categoryId img').fadeOut(300, changeImg(large, $('#product-slider$images->categoryId img')));
				$('#product-slider$images->categoryId a.fullscreen-button').attr('href', large);
			});

			function changeImg(large, element) {
				var element = element;
				var large = large;
				setTimeout(function () {
					startF()
				}, 300);
				function startF() {
					element.attr('src', large)
					element.attr('data-large', large)
					element.fadeIn(300);
				}

			}

			function setActive(el) {
				var element = el;
				$('#product-carousel$images->categoryId img').removeClass('active-item');
				element.addClass('active-item');
			}

		}

	});



	/* FullScreen Button */
	$('a.fullscreen-button').click(function (e) {
		e.preventDefault();
		var target = $(this).attr('href');
		$('#product-carousel$images->categoryId a.fancybox[href=\"' + target + '\"]').trigger('click');
	});


	/* Cloud Zoom */
	$('.cloud-zoom').imagezoomsl({
		zoomrange: [3, 3]
	});


	/* FancyBox */
	$('.fancybox').fancybox();
	 ");
endif;
?>
