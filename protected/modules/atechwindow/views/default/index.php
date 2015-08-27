<?php
$this->breadcrumbs = array(
    'Product',
);
?>

<div class="row">
    <div class="col-md-12">
        <div class="tab-heading">
            <?php foreach ($buttons as $button) {
                echo $button;
            }
            ?>
        </div>

        <div class="page-content tab-content">
            <?php $this->renderPartial('//layouts/_product_single_atech', array('subCate' => $category2ToProduct->category, 'colors' => $colors, 'brandId' => $brandId)); ?>
        </div>
    </div>
</div>

<?php /*
<div class="row">
    <div style="">
        <?php if (count($category2ToProducts) > 0) { ?>
            <div class="tabs">

                <div class="tab-heading">
                    <?php
                    foreach ($category2ToProducts as $cate2ToProduct) {

                        $cate1h = Category::model()->findByPk($cate2ToProduct->category1Id);
                        if (isset($cate1h)):
                            echo CHtml::link($cate1h->title . ' ', '#' . $cate1h->categoryId, array(
                                'class' => 'button small'));
                            ?>
                            <?php
/
                        endif;
                    }
                    ?>
                </div>
                <div class="page-content tab-content">
                    <?php
                    foreach ($category2ToProducts as $cate2ToProduct) {

                        $cate1c = Category::model()->findByPk($cate2ToProduct->category1Id);
                        if (isset($cate1c)):
                            ?>
                            <div id="<?php echo $cate1c->categoryId; ?>" class="row-fluid">
                                <?php $this->renderPartial('//layouts/_product_single_atech', array('subCate' => $cate1c, 'colors' => $colors, 'brandId' => $cate2ToProduct->brandId)); ?>
                            </div>
                            <?php
                        endif;
                    }
                    ?>

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
*/
?>
<?php
Yii::app()->clientScript->registerScript('catIndex', "
", CClientScript::POS_READY);
?>

