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
                    'images' => $product['images']));
                ?>
            </div>
            <!-- /Product Images Carousel -->


            <div class="col-lg-7 col-md-7 col-sm-7 product-single-info">

                <h2><?php echo $categoryModel->title; ?></h2>

                <table>
                    <tr>
                        <td colspan="2"><?php echo $categoryModel->description; ?></td>
                    </tr>
                </table>

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
                if (isset($_GET["id"]))
                    echo CHtml::hiddenField("categoryId", $_GET["id"]);
                ?>

                <div class="form-group product-actions-single">
                    <label for="h" class="col-sm-3 control-label">ความสูงรั้ว</label>

                    <div class="col-sm-8">
                        <?php
                        echo CHtml::dropDownList('categoryH', '', CHtml::listData($categoryModel->fenzerSubCategorys, 'categoryId', 'title'), array(
                            'class' => 'chosen-select-full-width',
                            'prompt' => '-- Select --'));
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="h" class="col-sm-3 control-label">ความยาว</label>

                    <div class="col-sm-8">
                        <div class="numeric-input full-width">
                            <input type="text" value="100" class="form-control" name="l"/>
                            <span class="arrow-up"><i class="icons icon-up-dir"></i></span>
                            <span class="arrow-down"><i class="icons icon-down-dir"></i></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <?php
                        echo CHtml::ajaxLink('<i class="fa fa-calculator"></i> คำนวณ', $this->createAbsoluteUrl('product/calculateProductItems'), array(
                            'dataType' => 'html',
                            'method' => 'POST',
                            'data' => 'js:$("#fenzerForm").serialize()',
                            'beforeSend' => 'js:function(){if($("#categoryH").val()==""){alert("Please Select Height");return false;}else{$("#spinner").css("display","inline-block");}}',
                            'success' => 'js:function(data){
                                $("#showProduct").show();
                                $("#productItems").html(data);

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
                            'class' => 'btn btn-default',
                            'id' => 'calculateProductItems',
                        ));
                        ?>

                        <i class="fa fa-spinner fa-spin spinner" id="spinner"></i>
                    </div>
                </div>

                <?php echo CHtml::hiddenField('categoryId', $categoryModel->categoryId); ?>
                <?php $this->endWidget(); ?>

                <?php if (isset($product['actions'])): ?>
                    <div class="product-actions">
                        <span class="add-to-cart">
                            <span class="action-wrapper">
                                <i class="icons icon-basket-2"></i>
                                <span class="action-name">ใส่ตะกร้า</span>
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
                'htmlOptions' => array(),
            ));
            ?>
            <table class="table table-bordered fenzer-items">
                <tr>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>ราคาต่อหน่วย</th>
                    <th>ปริมาณ</th>
                    <th>ราคารวม</th>
                    <th></th>
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
            'htmlOptions' => array(),
        ));
        ?>
        <?php
        /*
          <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="alert alert-info">
          <div class="row">
          <div class="col-md-4">
          <?php echo CHtml::dropDownList('productId', '', $fenzerArray, array('class'=>'chosen-select-full-width'));?>
          </div>

          <div class="col-md-4">
          <div class="numeric-input full-width">
          <input type="text" value="1" class="form-control" name="qty"/>
          <span class="arrow-up"><i class="icons icon-up-dir"></i></span>
          <span class="arrow-down"><i class="icons icon-down-dir"></i></span>
          </div>
          </div>

          <div class="col-md-4">
          <?php echo CHtml::ajaxLink('<i class="fa fa-plus"></i> เพิ่มรายการ', $this->createAbsoluteUrl('product/addProductItem'), array(
          'dataType' => 'html',
          'method' => 'POST',
          'data' => 'js:$("#addProductItemForm").serialize()',
          'success' => 'js:function(data){
          $("#productItems").append($(data).hide().fadeIn(1000));
          //$("#productItems").append(data);
          //$(data).hide().appendTo("#productItems").fadeIn(1000);

          $(".numeric-input").each(function(){
          var el = $(this);
          numericInput(el);
          });

          // Numeric Input
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
          'class' => 'form-control btn btn-primary',
          'id' => 'addProductItem',
          ));?>
          </div>
          </div>
          </div>
          </div>
         */
        ?>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <table class="table table-bordered fenzer-add-items">
                <tbody id="">
                <td><?php
                    echo CHtml::dropDownList('productId', '', $fenzerArray, array(
                        'class' => 'chosen-select-full-width'));
                    ?></td>
                <td><div class="numeric-input full-width">
                        <input type="text" value="1" class="form-control" name="qty"/>
                        <span class="arrow-up"><i class="icons icon-up-dir"></i></span>
                        <span class="arrow-down"><i class="icons icon-down-dir"></i></span>
                    </div></td>
                <td>
                    <?php
                    echo CHtml::ajaxLink('<i class="fa fa-plus"></i> เพิ่มรายการ', $this->createAbsoluteUrl('product/addProductItem'), array(
                        'dataType' => 'html',
                        'method' => 'POST',
                        'data' => 'js:$("#addProductItemForm").serialize()',
                        'success' => 'js:function(data){
                                $("#productItems").append($(data).hide().fadeIn(1000));
                                //$("#productItems").append(data);
                                //$(data).hide().appendTo("#productItems").fadeIn(1000);

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
                            }',
                    ), array(
                        'class' => 'form-control btn btn-primary',
                        'id' => 'addProductItem',
                    ));
                    ?>
                </td>
                </tbody>
            </table>
        </div>
        <?php $this->endWidget(); ?>

        <div class="col-lg-3 col-md-3 col-sm-3 col-md-offset-9">

            <div class="product-actions">
                <span class="add-to-cart" id="addToCartFenzer">
                    <span class="action-wrapper">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="action-name">หยิบใส่ตะกร้า</span>
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

