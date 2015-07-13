<?php
$this->breadcrumbs = array(
    'Product',
);
?>

<div class="row">
    <div style="">
        <?php if (count($category2ToProducts) > 0) { ?>
            <div class="tabs">

                <div class="tab-heading">
                    <?php
//                $i = 1;
                    foreach ($category2ToProducts as $cate2ToProduct) {

                        $cate1h = Category::model()->findByPk($cate2ToProduct->category1Id);
                        if (isset($cate1h)):
//                    throw new Exception(print_r($cate2h->title . ", " . $cate2h->categoryId, true));
//                    echo $cate2->title;
                            echo CHtml::link($cate1h->title . ' ', '#' . $cate1h->categoryId, array(
                                'class' => 'button small'));
                            ?>
                            <?php
//                    $i++;
//                    echo CHtml::link("History" . ' ', '#' . 2, array(
//                        'class' => 'button big'));
                        endif;
                    }
                    ?>
                </div>
                <div class="page-content tab-content">
                    <?php
                    foreach ($category2ToProducts as $cate2ToProduct) {

                        $cate1c = Category::model()->findByPk($cate2ToProduct->category1Id);
//                    throw new Exception(print_r($cate2c->categoryId, true));
                        if (isset($cate1c)):
                            ?>
                            <div id="<?php echo $cate1c->categoryId; ?>" class="row-fluid">
                                <?php // $i = 0;     ?>
                                <?php // foreach($myfileArray as $myfile):   ?>
                                <!--<div class='col-lg-3 col-md-3 col-sm-12'>-->
                                <?php $this->renderPartial('//layouts/_product_single_atech', array('subCate' => $cate1c, 'colors' => $colors, 'brandId' => $cate2ToProduct->brandId)); ?>
                                <!--</div>-->
                                <!--<div class='col-lg-12'>-->
                                <?php // echo $subCate->title;     ?>
                                <!--                        <div class="blog-item">
                                                            <a class="btn <?php // echo ($myfile->status == 1) ? "btn-success" : "btn-primary"                                                                                                                  ?> col-md-12"  href="<?php // echo Yii::app()->createUrl('/index.php/myfile/madrid/view/id/' . $myfile->orderId);                                                                                                                  ?>">
                                                                <h3><?php // echo $myfile->title;                                                                                                                ?><?php // if($myfile->status == 1):                                                                                                                ?><i class="fa fa-comments pull-left"></i><?php // endif;                                                                                                                ?>
                                <?php // if (isset($myfile->userSpacialProject[0]) && $myfile->userSpacialProject[0]->status == 1):      ?>
                                                                        <span class="label label-danger">R</span>
                                <?php // elseif (isset($myfile->userSpacialProject[0]) && $myfile->userSpacialProject[0]->status == 2):      ?>
                                                                        <span class="label label-danger">S</span>
                                <?php // endif;      ?>
                                                                </h3>
                                                                <p>วันที่สร้าง :<?php // echo $this->dateThai($myfile->createDateTime, 3, TRUE);                                                                                                                  ?></p>
                                                                <p>วันที่แก้ไข :<?php // echo $this->dateThai($myfile->updateDateTime, 2, TRUE)                                                                                                                  ?></p>
                                                                <p>จังหวัดที่ส่ง : <?php // echo Province::model()->findByPk($myfile->provinceId)->provinceName;                                                                                                                  ?></p>
                                                            </a>
                                                        </div>-->
                                <!--</div>-->
                                <?php // $i++;   ?>
                                <?php // endforeach;  ?>
                            </div>
                            <?php
                        endif;
                    }
                    ?>
                    <!--<div id="2">-->
                    <?php // $i = 0;     ?>
                    <?php // foreach($myfileHistoryArray as $myfile):   ?>
                    <!--<div class='col-lg-3 col-md-3 col-sm-12'>-->
                    <!--<div class="blog-item">-->
                            <!--<a class="btn <?php // echo ($myfile->status == 1) ? "btn-success" : "btn-primary"                                                                                                                  ?> col-md-12"  href="<?php // echo Yii::app()->createUrl('/index.php/myfile/madrid/view/id/' . $myfile->orderId);                                                                                                                  ?>">-->
                                    <!--<h3><?php // echo $myfile->title;                                                                                                                  ?><?php // if($myfile->status == 1):                                                                                                                  ?><i class="fa fa-comments pull-left"></i><?php // endif;                                                                                                                  ?></h3>-->
                                    <!--<p>วันที่สร้าง :<?php // echo $this->dateThai($myfile->createDateTime, 3, TRUE);                                                                                                                  ?></p>-->
                                    <!--<p>วันที่แก้ไข :<?php // echo $this->dateThai($myfile->updateDateTime, 2, TRUE)                                                                                                                  ?></p>-->
                                    <!--<p>จังหวัดที่ส่ง : <?php // echo Province::model()->findByPk($myfile->provinceId)->provinceName;                                                                                                                  ?></p>-->
                    <!--</a>-->
                    <!--</div>-->
                    <!--</div>-->
                    <?php // $i++;     ?>
                    <?php // endforeach;   ?>
                    <!--</div>-->
                </div>
            </div>
            <?php
        }else {
            ?>
            <div class="tabs">
                <h2>--- ไม่พบข้อมูลสินค้า ---</h2>
            </div>
        <?php }
        ?>
    </div>
</div>


<!--<div id="product-single">

     Product 
    <div class="product-single">

        <div class="row">

             Product Images Carousel 
            <div class="col-lg-5 col-md-5 col-sm-5 product-single-image">-->
<?php
//				$this->renderPartial('//layouts/_product_slider', array(
//					'images'=>$images));
?>
<!--</div>-->
<!-- /Product Images Carousel -->




<!--</div>-->
<!--
    </div>
     /Product 

     Product tabs 


</div>

<div class="page-content" id="showProduct">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <table class="table table-bordered atechwindow-items">
                <tr>
                    <th>รุ่น</th>
                    <th>รหัสสินค้า</th>
                    <th>รายละเอียด</th>
                    <th>ขนาด(มิลลิเมตร)</th>
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
</div>-->

<?php
Yii::app()->clientScript->registerScript('catIndex', "
", CClientScript::POS_READY);
?>

