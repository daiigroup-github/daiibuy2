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
                        <?php echo CHtml::ajaxButton('Search', $this->createAbsoluteUrl('product/showItems'), array(
                            'dataType' => 'json',
                            'method' => 'POST',
                            'data' => 'js:$("#fenzerForm").serialize()',
                            'success' => 'js:function(data){
                                var d = "<ul>";
                                d += "<li>Height : "+data.h+"</li>";
                                d += "<li>Length : "+data.l+"</li>";
                                d += "</ul>";

                                $("#items").html(d);
                            }',
                        ), array(
                            'class' => 'btn btn-default',
                            'id' => 'fenzerQuery'
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

<div class="page-content">
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
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?php echo $item['model']; ?></td>
                        <td><?php echo $item['code']; ?></td>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo $item['size']; ?></td>
                        <td><?php echo $item['color']; ?></td>
                        <td><?php echo number_format($item['price'] * $item['qty'], 2); ?></td>
                        <td>
                            <div class="numeric-input full-width">
                                <input type="text" value="<?php echo $item['qty']; ?>" name="l"/>
                                <span class="arrow-up"><i class="icons icon-up-dir"></i></span>
                                <span class="arrow-down"><i class="icons icon-down-dir"></i></span>
                            </div>
                        </td>
                        <td class="text-center">
                            <a href="#" class="btn btn-info btn-xs"><i class="fa fa-shopping-cart"></i></a>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-ban"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<?php
Yii::app()->clientScript->registerScript('catIndex', "
", CClientScript::POS_READY);
?>

