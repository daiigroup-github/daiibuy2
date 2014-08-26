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
            <h4><?php echo $product['title']; ?></h4>
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
                <?php $this->renderPartial('//layouts/_product_slider', array('images' => $product['images'])); ?>
            </div>
            <!-- /Product Images Carousel -->


            <div class="col-lg-7 col-md-7 col-sm-7 product-single-info">

                <h2><?php echo $product['title']; ?></h2>

                <?php $this->renderPartial('//layouts/_product_description', array('description' => $product['description'])); ?>

                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'fenzerForm',
                    //'enableClientValidation' => true,
                    //'clientOptions' => array('validateOnSubmit' => true,),
                    'htmlOptions' => array(
                        'class' => 'form-horizontal',
                        'role' => 'form',
                        'onSubmit'=>'js:return(false);'
                    ),
                ));
                ?>

                <div class="form-group">
                    <label for="h" class="col-sm-4 control-label">Booking Price</label>
                    <div class="col-sm-7">
                        <input type="text" value="100,000 บาท" class="form-control price" disabled />
                    </div>
                </div>

                <div class="form-group">
                    <label for="h" class="col-sm-4 control-label">Contact Price</label>
                    <div class="col-sm-7">
                        <input type="text" value="2,600,000 บาท" class="form-control price" disabled />
                    </div>
                </div>

                <div class="form-group">
                    <label for="h" class="col-sm-4 control-label">Color</label>
                    <div class="col-sm-7">
                        <select class="form-control" name="h" id="h">
                            <option value="1">Silver</option>
                            <option value="2">Blue</option>
                            <option value="3">White</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="h" class="col-sm-4 control-label">Amount</label>
                    <div class="col-sm-7">
                        <div class="numeric-input full-width">
                            <input type="text" value="1" class="form-control" name="l" />
                            <span class="arrow-up"><i class="icons icon-up-dir"></i></span>
                            <span class="arrow-down"><i class="icons icon-down-dir"></i></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <?php echo CHtml::ajaxButton('Search', $this->createAbsoluteUrl('product/showItems'), array(
                            'dataType'=>'json',
                            'method'=>'POST',
                            'data'=>'js:$("#fenzerForm").serialize()',
                            'success'=>'js:function(data){
                                var d = "<ul>";
                                d += "<li>Height : "+data.h+"</li>";
                                d += "<li>Length : "+data.l+"</li>";
                                d += "</ul>";

                                $("#items").html(d);
                            }',
                        ), array('class'=>'btn btn-default', 'id'=>'fenzerQuery'));?>
                    </div>
                </div>

                <?php $this->endWidget(); ?>

                <?php if (isset($product['actions'])): ?>
                    <div class="product-actions">
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
                        <?php
                        /*
                            <span class="add-to-compare">
                                <span class="action-wrapper">
                                    <i class="icons icon-docs"></i>
                                    <span class="action-name">Add to compare</span>
                                </span>
                            </span>
                            <span class="green product-action">
                                <span class="action-wrapper">
                                    <i class="icons icon-info"></i>
                                    <span class="action-name">Ask a question</span>
                                </span>
                            </span>
                        */
                        ?>
                    </div>
                <?php endif; ?>
                <br/>
            </div>

        </div>

    </div>
    <!-- /Product -->

    <!-- Product tabs -->
    <?php $this->renderPartial('//layouts/_product_tab', array('tabs' => $product['tabs'])); ?>

</div>

<?php
Yii::app()->clientScript->registerScript('catIndex', "
    $('#h').select2();
", CClientScript::POS_READY);
?>

