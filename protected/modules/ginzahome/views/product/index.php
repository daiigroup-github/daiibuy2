<?php
/* @var $this ProductController */

$this->breadcrumbs = array(
	'Product',
);
?>

<?php //$this->renderPartial('//layouts/_product_single', array('product' => $product)); ?>
<div class="row">
    <!-- Heading -->
    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="carousel-heading">
            <h4><?php echo $categoryToSub->category->title . ' :: ' . $categoryToSub->subCategory->title; ?></h4>
        </div>

    </div>
    <!-- /Heading -->
</div>

<div id="product-single">

    <!-- Product -->
    <div class="product-single">

        <div class="row">

            <!-- Product Images Carousel -->
            <div class="col-lg-5 col-md-5 col-sm-5 product-single-image">
				<?php
				$this->renderPartial('//layouts/_product_slider', array(
					'images'=>$images));
				?>
            </div>
            <!-- /Product Images Carousel -->


            <div class="col-lg-7 col-md-7 col-sm-7 product-single-info">

                <h2><?php echo $categoryToSub->category->title . ' :: ' . $categoryToSub->subCategory->title; ?></h2>

				<?php
				$this->renderPartial('//layouts/_product_description', array(
					'description'=>$description));
				?>

				<?php
				$form = $this->beginWidget('CActiveForm', array(
					'id'=>'ginzaHomeForm',
					//'enableClientValidation' => true,
					//'clientOptions' => array('validateOnSubmit' => true,),
					'htmlOptions'=>array(
						'class'=>'form-horizontal product-actions-single',
						'role'=>'form',
						'onSubmit'=>'js:return(false);'
					),
				));
				?>

                <div class="form-group">
                    <label for="h" class="col-sm-4 control-label">ราคาจอง</label>
                    <div class="col-sm-7">
                        <input type="text" value="<?php echo number_format($bookingPrice, 2); ?>" class="form-control price" disabled />
                    </div>
                </div>

                <div class="form-group">
                    <label for="h" class="col-sm-4 control-label">ราคา(รวมราคาจอง)</label>
                    <div class="col-sm-7">
                        <input type="text" value="<?php echo number_format($price, 2); ?>" class="form-control price" disabled />
                    </div>
                </div>

				<?php
				/*

				  <div class="form-group">
				  <label for="h" class="col-sm-4 control-label">Color</label>
				  <div class="col-sm-7">
				  <?php echo CHtml::dropDownList('h', '', array('Silver', 'Blue', 'White'), array('class'=>'chosen-select-full-width', 'prompt'=>'-- Select --'));?>
				  </div>
				  </div>
				 */
				?>

				<?php
				/**
				 * options
				 */
				if($productSortOrder1->productOptionGroups !== array()):
					foreach($productSortOrder1->productOptionGroups as $productOptionGroup):
//						throw new Exception(print_r($productOptionGroup->productOptions, true));
						?>
						<div class="form-group">
							<label for="productOption" class="col-sm-4 control-label"><?php echo $productOptionGroup->title; ?></label>
							<div class="col-sm-7">
								<?php
								echo CHtml::dropDownList("productOptionGroup[$productOptionGroup->productOptionGroupId]", '', CHtml::listData($productOptionGroup->productOptions, 'productOptionId', 'title'), array(
									'class'=>'form-control',
									'prompt'=>'-- Select --',
									'name'=>'productOption'
									)
								);

                                if($productOptionGroup->title == 'COLOR') {
                                    $domId = 'productOptionGroup_'.$productOptionGroup->productOptionGroupId;
                                    Yii::app()->clientScript->registerScript('changeColor', "
                                        var dom = $('#$domId');
                                        dom.on('change', function(){
                                            $('#imageThumbnail'+$(this).val()).trigger('click');
                                        });
                                    ");
                                }

								?>
							</div>
						</div>
						<?php
					endforeach;
				endif;
				?>

                <div class="form-group">
                    <label for="h" class="col-sm-4 control-label">จำนวน(หลัง)</label>
                    <div class="col-sm-7">
                        <div class="numeric-input full-width">
                            <input type="text" value="1" class="form-control" name="quantity" />
                            <span class="arrow-up"><i class="icons icon-up-dir"></i></span>
                            <span class="arrow-down"><i class="icons icon-down-dir"></i></span>
                        </div>
                    </div>
                </div>

                <div class="product-actions">
					<span class="add-to-cart" id="addToCartGinzaHome">
                        <span class="action-wrapper">
							<i class="icons fa fa-shopping-cart"></i>
							<span class="action-name" ><b>ใส่ตระกร้าสินค้า</b></span>
						</span>
					</span>
                </div>
				<?php echo CHtml::hiddenField('productId', $productSortOrder1->productId); ?>
				<?php $this->endWidget(); ?>


                <br/>
            </div>

        </div>

    </div>
    <!-- /Product -->

    <!-- Product tabs -->
	<?php
	if($tabs !== array())
		$this->renderPartial('_product_tab', array(
			'tabs'=>$tabs,
            'allPrice'=>$allPrice));
	?>

</div>

<?php
Yii::app()->clientScript->registerScript('catIndex', "
", CClientScript::POS_READY);
?>

