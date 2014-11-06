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
				<?php
				$this->renderPartial('//layouts/_product_slider', array(
					'images'=>$images));
				?>
            </div>
            <!-- /Product Images Carousel -->


            <div class="col-lg-7 col-md-7 col-sm-7 product-single-info">

                <h2><?php echo $category2->title; ?></h2>
				<?php
				/*
				  <div class="rating-box">
				  <div class="rating readonly-rating" data-score="4"></div>
				  <span>3 Review(s)</span>
				  </div>
				 */
				?>

                <table>
                    <tr>
                        <td colspan="2"><?php echo $category2->description; ?></td>
                    </tr>
                </table>

                <span class="price"></span>

				<?php
				$form = $this->beginWidget('CActiveForm', array(
					'id'=>'atechWindowForm',
					//'enableClientValidation' => true,
					//'clientOptions' => array('validateOnSubmit' => true,),
					'htmlOptions'=>array(
						'class'=>'form-horizontal',
						'role'=>'form',
						'onSubmit'=>'js:return(false);'
					),
				));
				?>

                <div class="form-group product-actions-single">
                    <label for="h" class="col-sm-2 control-label">Width</label>

                    <div class="col-sm-9">
						<?php
						echo CHtml::dropDownList('width', '', CHtml::listData($widthArray, 'width', 'width'), array(
							'class'=>'chosen-select-full-width',
							'prompt'=>'-- Please Select --'));
						?>
                    </div>
                </div>

                <div class="form-group product-actions-single">
                    <label for="h" class="col-sm-2 control-label">Height</label>

                    <div class="col-sm-9">
						<?php
						echo CHtml::dropDownList('height', '', CHtml::listData($heightArray, 'height', 'height'), array(
							'class'=>'chosen-select-full-width',
							'prompt'=>'-- Please Select --'));
						?>
                    </div>
                </div>

				<!--                <div class="form-group product-actions-single">
									<label for="h" class="col-sm-2 control-label">Color</label>

									<div class="col-sm-9">
				<?php
//						echo CHtml::dropDownList('Color', '', $colors, array(
//							'class'=>'chosen-select-full-width',
//							'prompt'=>'-- Please Select --'));
				?>
									</div>
								</div>-->

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
						<?php
						echo CHtml::ajaxButton('Search', $this->createAbsoluteUrl('product/searchProductItems'), array(
							'dataType'=>'html',
							'method'=>'POST',
							'data'=>'js:$("#atechWindowForm").serialize()',
							'beforeSend'=>'js:function(){$("#spinner").css("display","inline-block");}',
							'success'=>'js:function(data){
                                $("#productItems").html(data);
                                $("#showProduct").show();

                                $(".numeric-input").each(function(){
		                            var el = $(this);
		                            numericInput(el);
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

	                            $("#spinner").hide();
                            }',
							), array(
							'class'=>'btn btn-default',
							'id'=>'searchProductItems'
						));
						?>
                        <i class="fa fa-spinner fa-spin spinner" id="spinner"></i>
                    </div>
                </div>
				<?php echo CHtml::hiddenField('categoryId', $category2->categoryId); ?>
				<?php echo CHtml::hiddenField('category1Id', isset($_GET["category1Id"]) ? $_GET["category1Id"] : NULL); ?>

				<?php $this->endWidget(); ?>

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
                    <!--<th>สี</th>-->
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

