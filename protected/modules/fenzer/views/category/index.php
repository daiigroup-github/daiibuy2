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
                        'onSubmit' => 'js:return(false);'
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
                            <input type="text" value="100" class="form-control" name="l"/>
                            <span class="arrow-up"><i class="icons icon-up-dir"></i></span>
                            <span class="arrow-down"><i class="icons icon-down-dir"></i></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <?php echo CHtml::ajaxLink('<i class="fa fa-calculator"></i> Calculate', $this->createAbsoluteUrl('product/calculateProductItems'), array(
                            'dataType' => 'html',
                            'method' => 'POST',
                            'data' => 'js:$("#fenzerForm").serialize()',
                            'success' => 'js:function(data){
                                $("#showProduct").show();
                                $("#productItems").html(data);
                            }',
                        ), array(
                            'class' => 'btn btn-default',
                            'id' => 'calculateProductItems',
                        ));?>
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


</div>

<div class="page-content" id="showProduct">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php
            /**
             * เพิ่มรายการสินค้า
             */
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'productItemsForm',
                //'enableClientValidation' => true,
                //'clientOptions' => array('validateOnSubmit' => true,),
                'htmlOptions' => array(
                ),
            ));
            ?>
            <table class="table table-bordered fenzer-items">
                <tr>
                    <th>Code</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
                <tbody id="productItems"></tbody>
            </table>
            <?php $this->endWidget(); ?>
        </div>

        <?php
        /**
         * เพิ่มรายการสินค้า
         */
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'addProductItemForm',
            //'enableClientValidation' => true,
            //'clientOptions' => array('validateOnSubmit' => true,),
            'htmlOptions' => array(
            ),
        ));
        ?>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="alert alert-info">
                <div class="row">
                    <div class="col-md-5">
                        <select class="from-control" name="cat1" id="">
                            <option value="">เสา</option>
                            <option value="">แผ่น</option>
                            <option value="">ฐานราก</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select class="form-control" name="product" id="">
                            <option value="">product1</option>
                            <option value="">product2</option>
                            <option value="">product3</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <?php echo CHtml::ajaxLink('<i class="fa fa-plus"></i> เพิ่มรายการ', $this->createAbsoluteUrl('product/addProductItem'), array(
                            'dataType' => 'html',
                            'method' => 'POST',
                            'data' => 'js:$("#addProductForm").serialize()',
                            'success' => 'js:function(data){
                                $("#productItems").append($(data).hide().fadeIn(1000));
                                //$("#productItems").append(data);
                                //$(data).hide().appendTo("#productItems").fadeIn(1000);
                            }',
                        ), array(
                            'class' => 'form-control btn btn-default',
                            'id' => 'addProductItem',
                        ));?>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>

        <div class="col-lg-3 col-md-3 col-sm-3 col-md-offset-9">

            <div class="product-actions">
		        <span class="add-to-cart" id="addToCartFenzer">
                    <span class="action-wrapper">
					    <i class="fa fa-money"></i>
						<span class="action-name" >Check out</span>
					</span>
				</span>
            </div>
        </div>
    </div>
</div>

<?php
Yii::app()->clientScript->registerScript('catIndex', "
", CClientScript::POS_READY);
?>

