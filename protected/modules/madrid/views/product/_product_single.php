<div id="product-single">

    <!-- Product -->
    <div class="product-single">

        <div class="row">

            <!-- Product Images Carousel -->
            <div class="col-lg-5 col-md-5 col-sm-5 product-single-image">
                <?php $this->renderPartial('//layouts/_product_slider', array('images' => $images)); ?>
            </div>
            <!-- /Product Images Carousel -->


            <div class="col-lg-7 col-md-7 col-sm-7 product-single-info">

                <h2><?php echo $productModel->name; ?></h2>
                <?php
                /*
                <div class="rating-box">
                    <div class="rating readonly-rating" data-score="4"></div>
                    <span>3 Review(s)</span>
                </div>
                */
                ?>

                <?php //if (isset($product['attributes'])) $this->renderPartial('//layouts/_product_attributes', array('attributes' => $product['attributes'])); ?>
                <?php //if (isset($product['description'])) $this->renderPartial('//layouts/_product_description', array('description' => $product['description'])); ?>

                <?php /*
                foreach ($productModel->productSpecGroups as $productSpecGroup) {
                    if ($productSpecGroup->productSpecs !== []) {
                        echo '<h3>' . $productSpecGroup->title . '</h3>';

                        echo '<table>';
                        foreach ($productSpecGroup->productSpecs as $productSpec) {
                            echo '<tr>';
                            echo '<td>' . $productSpec->title . '</td>';
                            echo '<td>' . $productSpec->description . '</td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                    }
                }*/
                ?>

                <?php foreach ($productModel->productSpecGroupsTypeSpecs as $productSpecGroupsTypeSpec): ?>
                    <?php if ($productSpecGroupsTypeSpec->productSpecs !== []): ?>
                        <h3><?php echo $productSpecGroupsTypeSpec->title; ?></h3>
                        <table>
                            <?php foreach ($productSpecGroupsTypeSpec->productSpecs as $productSpec): ?>
                                <tr>
                                    <td><?php echo $productSpec->title; ?></td>
                                    <td><?php echo $productSpec->description; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>
                <?php endforeach; ?>

                <span class="price">
                    <?php if ($productModel->calProductPromotionPrice() > 0): ?>
                        <del><?php echo $productModel->calProductPrice(); ?></del> <?php echo $productModel->calProductPromotionPrice(); ?>
                    <?php else: ?>
                        <?php echo $productModel->calProductPrice(); ?>
                    <?php endif; ?>
                    บาท
                </span>


                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'productOptionForm',
                    //'enableClientValidation' => true,
                    //'clientOptions' => array('validateOnSubmit' => true,),
                    'htmlOptions' => array('class' => '', 'role' => 'form'),
                ));
                ?>
                <table class="product-actions-single">
                    <?php if ($productModel->productOptionGroups !== []): ?>
                        <?php foreach ($productModel->productOptionGroups as $productOptionGroup): ?>
                            <?php if ($productOptionGroup->productOptions !== []): ?>
                                <tr>
                                    <td><?php echo $productOptionGroup->title; ?></td>
                                    <td>
                                        <?php echo CHtml::dropDownList(get_class($productOptionGroup) . '[' . $productOptionGroup->productOptionGroupId . ']', '', CHtml::listData($productOptionGroup->productOptions, 'productOptionId', 'title'), array('class' => 'chosen-select-full-width')); ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <tr>
                        <td>Quantity:</td>
                        <td>
                            <div class="numeric-input full-width">
                                <input type="text" value="1" class="form-control" name="qty">
                                <span class="arrow-up"><i class="icons icon-up-dir"></i></span>
                                <span class="arrow-down"><i class="icons icon-down-dir"></i></span>
                            </div>
                        </td>
                    </tr>
                </table>
                <?php echo CHtml::hiddenField('productId', $productModel->productId); ?>
                <?php $this->endWidget(); ?>


                <div class="product-actions">
			        <span class="add-to-cart">
                        <span class="action-wrapper">
							<i class="icons icon-basket-2"></i>
							<span class="action-name">Add to cart</span>
						</span>
					</span>
                </div>
                <br/>
            </div>

        </div>

    </div>
    <!-- /Product -->

    <!-- Product tabs -->
    <?php if ($descriptionTabs !== []) $this->renderPartial('//layouts/_product_tab', array('tabs' => $descriptionTabs)); ?>

</div>

<?php
/*
Yii::app()->clientScript->registerScript('addToCart', "
    $('.add-to-cart').click(function(){
    $.ajax({
        url : '".$this->createUrl('product/addToCart')."',
        type : 'POST',
        dataType : 'JSON',
        data : $('#productOptionForm').serialize(),
        success : function(data){
            //alert success message
        },
    });
    });
");
*/
