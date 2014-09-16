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
                    'id' => 'atechWindowForm',
                    //'enableClientValidation' => true,
                    //'clientOptions' => array('validateOnSubmit' => true,),
                    'htmlOptions' => array(
                        'class' => 'form-horizontal',
                        'role' => 'form',
                        'onSubmit' => 'js:return(false);'
                    ),
                ));
                ?>

                <?php foreach ($product['options'] as $option): ?>
                    <div class="form-group">
                        <label for="h" class="col-sm-2 control-label"><?php echo $option['title']; ?></label>

                        <div class="col-sm-9">
                            <?php
                            //$form->dropDownList();
                            echo CHtml::dropDownList($option['title'], '', $option['items'], array('class' => 'form-control'));
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <?php echo CHtml::ajaxButton('Search', $this->createAbsoluteUrl('product/searchProductItems'), array(
                            'dataType' => 'html',
                            'method' => 'POST',
                            'data' => 'js:$("#atechWindowForm").serialize()',
                            'success' => 'js:function(data){
                                $("#productItems").html(data);
                                $("#showProduct").show();

                                $(".numeric-input").each(function(){
		                            var el = $(this);
		                            numericInput(el);
                                    alert("aaaa");
	                            });

	                            /* Numeric Input */
	                            function numericInput(el){
		                            var element = el;
		                            var input = $(element).find("input");

		                            $(element).find(".arrow-up").click(function(){
			                            var value = parseInt(input.val());
			                            input.val(value+1);
		                            });

		                            $(element).find(".arrow-down").click(function(){
			                            var value = parseInt(input.val());

                                        if(value-1 < 0)
                                        input.val(0);
                                    else
			                        input.val(value-1);
		                            });

		                            input.keypress(function(e){

			                        var value = parseInt(String.fromCharCode(e.which));
			                        if(isNaN(value)){
				                        e.preventDefault();
			                        }

		                        });

	                            }
                            }',
                        ), array(
                            'class' => 'btn btn-default',
                            'id' => 'searchProductItems'
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
            <table class="table table-bordered atechwindow-items">
                <tr>
                    <th>รุ่น</th>
                    <th>รหัสสินค้า</th>
                    <th>รายละเอียด</th>
                    <th>ขนาด</th>
                    <th>สี</th>
                    <th>ราคา</th>
                    <th>Qty</th>
                    <th>Actions</th>
                </tr>
                <tbody id="productItems"></tbody>
            </table>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-md-offset-9">

            <div class="product-actions">
		        <span class="add-to-cart">
                    <span class="action-wrapper">
					    <i class="fa fa-shopping-cart"></i>
						<span class="action-name">View cart</span>
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

