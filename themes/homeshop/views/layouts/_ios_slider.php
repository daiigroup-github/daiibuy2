<!-- Slider -->
<div class = "iosSlider">
	<div class = "slider">
		<?php
		$i = 1;
		$slide = Content::model()->find("type = 0 AND parentId = 0");
		?>
		<?php
		if(isset($slide) && count($slide->childs) > 0):
			$child = Content::model()->findAll("parentId = " . $slide->contentId);
			foreach($child as $item):
				?>
				<div class = "item" id = "item<?php echo $i; ?>">

					<div class = "">
						<div class = "bg">
							<?php
							echo CHtml::image(Yii::app()->baseUrl . $item->image, $item->title, array(
								'style'=>'width:100%'));
							?>
						</div>
					</div>

					<div class = "text">

						<div class = "bg"></div>

						<div class = "title">
							<h2><strong><?php echo $item->title ?></strong></h2>
						</div>

						<div class = "desc">
							<h3><?php echo $item->description; ?></h3>
							<!--<span>From <span class="price">$960.00</span></span>-->
						</div>

						<!--						<div class = "button">
													<a class="button big red" href="#">Buy Now</a>
												</div>-->

					</div>

				</div>
				<?php
				$i++;
			endforeach;
		endif;
		?>
		<!--		<div class = "item" id = "item1">

					<div class = "image">
						<div class = "bg"></div>
					</div>

					<div class = "text">

						<div class = "bg"></div>

						<div class = "title">
							<h2><strong>Lorem Ipsum Dolor</strong></h2>
						</div>

						<div class = "desc">
							<h3>All the power in your hands!</h3>
							<span>From <span class="price">$960.00</span></span>
						</div>

						<div class = "button">
							<a class="button big red" href="#">Buy Now</a>
						</div>

					</div>

				</div>

				<div class = "item" id = "item2">

					<div class = "image">
						<div class = "bg"></div>
					</div>

					<div class = "text">

						<div class = "bg"></div>

						<div class = "title">
							<h2><strong>The New Studio<br>Original Headphones</strong></h2>
						</div>

						<div class = "desc">
							<h3>Lorem ipsum dolor</h3>
							<span>From <span class="price">$399.00</span></span>
						</div>

						<div class = "button">
							<a class="button big red" href="#">Buy Now</a>
						</div>

					</div>

				</div>

				<div class = "item" id = "item3">

					<div class = "image">
						<div class = "bg"></div>
					</div>

					<div class = "text">

						<div class = "bg"></div>

						<div class = "title">
							<h2>The New <strong>Laptop</strong></h2>
						</div>

						<div class = "desc">
							<h3>All the power in your hands!</h3>
							<span>From <span class="price">$960.00</span></span>
						</div>

						<div class = "button">
							<a class="button big red" href="#">Buy Now</a>
						</div>

					</div>

				</div>-->

	</div>

	<div class = 'prevButton'></div>

	<div class = 'nextButton'></div>

</div>
<!-- /Slider -->