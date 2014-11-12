<?php
foreach($models as $model):
	$price = ($model->product->calProductPromotionPrice() != 0) ? $model->product->calProductPromotionPrice() : $model->product->calProductPrice();
	?>
	<div class="col-lg-12 col-md-12 col-sm-12">
		<div class="grid-view product">
			<div class="product-image col-lg-4 col-md-4 col-sm-4">
				<?php echo CHtml::link(isset($model->product->productImages[0]) ? CHtml::image(Yii::app()->createUrl($model->product->productImages[0]->image), $model->product->name) : "", $this->createUrl('category/index?id=' . $model->category2Id . (isset($category1Id) ? "&category1Id=" . $model->category1Id : ""))); ?>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8 product-content no-padding" style="height: 290px;">
				<div class="product-info">
					<h5><?php echo CHtml::link($model->product->name, $this->createUrl('category/index?id=' . $model->category2Id . (isset($category1Id) ? "&category1Id=" . $model->category1Id : ""))); ?></h5>

					<p><?php echo $model->product->description; ?></p>
					<p>ราคา : <?php echo number_format($price); ?> บาท</p>
					<p class="col-lg-8">จำนวน : <?php
						echo CHtml::numberField("qty[" . $model->productId . "]", 1, array(
							'id'=>$model->productId))
						?></p>
				</div>
				<p>
					<!--<a class='button orange addToCart' 'data-productid==>$model->productId></a>-->
					<?php
					echo CHtml::link("<i class='icons icon-basket-2'></i>ADD TO CART", "#", array(
						'class'=>'button orange addToCart',
						'data-productid'=>$model->productId))
					?>
				</p>

			</div>
		</div>

	</div>
<?php endforeach; ?>