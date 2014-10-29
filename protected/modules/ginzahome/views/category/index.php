<?php
/* @var $this ProductController */

$this->breadcrumbs = array(
    'Product',
);
?>
<div class="row">
    <!-- Heading -->
    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="carousel-heading">
            <h4><?php echo $brandModel->title; ?></h4>
        </div>

    </div>
    <!-- /Heading -->
</div>

<div class="page-content">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">

            <?php foreach ($brandModel->categorys as $category):?>
                <div class="page-header"><h1><?php echo $category->title;?> :: Spec.</h1></div>

                <table class="table table-bordered text-center ginzahome-compare">
                    <tr>
                        <td>Type</td>
                        <?php foreach($category->subCategorys as $subCategory):?>
                        <td><?php echo $subCategory->title;?></td>
                        <?php endforeach;?>
                    </tr>

                    <tr>
                        <td>ราคา</td>

                        <?php foreach($category->subCategorys as $subCategory):?>
                        <td>
                            <span class="price">
                                <?php echo Product::model()->ginzaPriceByCategory1IdAndCategory2Id($category->categoryId, $subCategory->categoryId);;?>
                            </span><br />
                            <a class="btn btn-primary form-control" href="<?php echo $this->createUrl('product/index/c/'.$category->categoryId.'/c2/'.$subCategory->categoryId);?>">เลือก</a>
                        </td>
                        <?php endforeach;?>
                    </tr>
                </table>
            <?php endforeach;?>

            <div class="page-header"><h1>Ginza 188 :: Spec.</h1></div>

            <table class="table table-bordered text-center ginzahome-compare">
                <tr>
                    <td>Type</td>
                    <td>C</td>
                    <td>E</td>
                    <td>SL</td>
                </tr>
                <tr>
                    <td>ราคา</td>
                    <td><span style="font-size: 1.2em;font-weight: bolder;color:red;">2,650,000 บาท</span><br />
                        <a class="btn btn-primary form-control" href="<?php echo $this->createUrl('product/index/id/1');?>">เลือก</a>
                    </td>
                    <td><span style="font-size: 1.2em;font-weight: bolder;color:red;">2,950,000 บาท</span><br />
                        <a class="btn btn-primary form-control" href="<?php echo $this->createUrl('product/index/id/1');?>">เลือก</a>
                    </td>
                    <td><span style="font-size: 1.2em;font-weight: bolder;color:red;">3,600,000 บาท</span><br />
                        <a class="btn btn-primary form-control" href="<?php echo $this->createUrl('product/index/id/1');?>">เลือก</a>
                    </td>
                </tr>
                <tr>
                    <td>สี</td>
                    <td colspan="3">
                        <div class="row">
                            <div class="col-md-4">
                                <?php echo  CHtml::image(Yii::app()->baseUrl.'/images/ginzahome/1floor.jpg');?>
                            </div>
                            <div class="col-md-4">
                                <?php echo  CHtml::image(Yii::app()->baseUrl.'/images/ginzahome/1floor.jpg');?>
                            </div>
                            <div class="col-md-4">
                                <?php echo  CHtml::image(Yii::app()->baseUrl.'/images/ginzahome/1floor.jpg');?>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>ห้องต่างๆ</td>
                    <td colspan="3">3 ห้องนอน / 3 ห้องน้ำ / 1 ห้องครัว / 1 ห้องนั่งเล่น / 1 ที่จอดรถ</td>
                </tr>
                <tr>
                    <td>พื้นชั้นล่าง</td>
                    <td>กระเบื้องแกรนิโต้ Nano</td>
                    <td colspan="2">กระเบื้องแกรนิโต้ Super white nano พร้อมบัวเชิงผนังไม้เต็ง</td>
                </tr>
                <tr>
                    <td>พื้นชั้นบน</td>
                    <td>ลามิเนต 8 มม.</td>
                    <td>ลามิเนต 12 มม.</td>
                    <td>Engineering Wood</td>
                </tr>
                <tr>
                    <td>วอลเปเปอร์</td>
                    <td>-</td>
                    <td colspan="2">ภายในยกเว้นห้องครัวและห้องน้ำ</td>
                </tr>
            </table>

            <hr />

            <div class="page-header"><h1>Ginza 269 :: Spec.</h1></div>

            <table class="table table-bordered text-center ginzahome-compare">
                <tr>
                    <td style="width: 13%;">Type</td>
                    <td style="width: 29%;">C</td>
                    <td style="width: 29%;">E</td>
                    <td style="width: 29%;">SL</td>
                </tr>
                <tr>
                    <td>ราคา</td>
                    <td><span style="font-size: 1.2em;font-weight: bolder;color:red;">2,650,000 บาท</span><br />
                        <button class="btn btn-primary form-control">เลือก</button>
                    </td>
                    <td><span style="font-size: 1.2em;font-weight: bolder;color:red;">2,950,000</span><br />
                        <button class="btn btn-primary form-control">เลือก</button>
                    </td>
                    <td><span style="font-size: 1.2em;font-weight: bolder;color:red;">3,600,000</span><br />
                        <button class="btn btn-primary form-control">เลือก</button>
                    </td>
                </tr>
                <tr>
                    <td>สี</td>
                    <td colspan="3">
                        <div class="row">
                            <div class="col-md-4">
                                <?php echo  CHtml::image(Yii::app()->baseUrl.'/images/ginzahome/1floor.jpg');?>
                            </div>
                            <div class="col-md-4">
                                <?php echo  CHtml::image(Yii::app()->baseUrl.'/images/ginzahome/1floor.jpg');?>
                            </div>
                            <div class="col-md-4">
                                <?php echo  CHtml::image(Yii::app()->baseUrl.'/images/ginzahome/1floor.jpg');?>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>ห้องต่างๆ</td>
                    <td colspan="3">3 ห้องนอน / 3 ห้องน้ำ / 1 ห้องครัว / 1 ห้องนั่งเล่น / 1 ที่จอดรถ</td>
                </tr>
                <tr>
                    <td>พื้นชั้นล่าง</td>
                    <td>กระเบื้องแกรนิโต้ Nano</td>
                    <td colspan="2">กระเบื้องแกรนิโต้ Super white nano พร้อมบัวเชิงผนังไม้เต็ง</td>
                </tr>
                <tr>
                    <td>พื้นชั้นบน</td>
                    <td>ลามิเนต 8 มม.</td>
                    <td>ลามิเนต 12 มม.</td>
                    <td>Engineering Wood</td>
                </tr>
                <tr>
                    <td>วอลเปเปอร์</td>
                    <td>-</td>
                    <td colspan="2">ภายในยกเว้นห้องครัวและห้องน้ำ</td>
                </tr>
            </table>
        </div>
    </div>
</div>


<?php
Yii::app()->clientScript->registerScript('catIndex', "
", CClientScript::POS_READY);
?>

