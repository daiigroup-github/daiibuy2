<?php
/* @var $this ProductController */

$this->breadcrumbs = array(
    'Product',
);
?>

<?php //$this->renderPartial('//layouts/_product_single', array('product' => $product)); ?>

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
                <?php
                /*
                <div class="rating-box">
                    <div class="rating readonly-rating" data-score="4"></div>
                    <span>3 Review(s)</span>
                </div>
                */
                ?>

                <?php $this->renderPartial('//layouts/_product_description', array('description' => $product['description'])); ?>

                <span class="price"></span>

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
                    <label for="h" class="col-sm-2 control-label">Height</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="h" id="h">
                            <option value="2.25">2.25 เมตร</option>
                            <option value="2.50">2.50 เมตร</option>
                            <option value="2.75">2.75 เมตร</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="h" class="col-sm-2 control-label">Length</label>
                    <div class="col-sm-9">
                        <div class="numeric-input full-width">
                            <input type="text" value="100" class="form-control" name="l" />
                            <span class="arrow-up"><i class="icons icon-up-dir"></i></span>
                            <span class="arrow-down"><i class="icons icon-down-dir"></i></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
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
", CClientScript::POS_READY);
?>

