<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
    $this->module->id,
);
?>
<div class="row">
    <!-- Heading -->
    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="carousel-heading">
            <h4 class="pull-left">My Files Atech Window</h4>

            <?php /*
            <div class="pull-right">
                <a class="col-lg-6 col-md-6 col-sm-6 glyphicon glyphicon-chevron-left button" onclick="javascript:history.back();"></a>
                <a class="col-lg-6 col-md-6 col-sm-6 glyphicon glyphicon-chevron-right button" onclick="javascript:history.forward();"></a>
            </div>
            */ ?>
        </div>
    </div>
    <!-- /Heading -->
</div>

<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills" role="tablist">
            <li class="active green">
                <a href="<?php echo Yii::app()->request->baseUrl . "/index.php/myfile/atechWindow/index"; ?>">
                    <h5 style="color: white;">ไฟล์ของฉัน</h5></a></li>
            <li class="orange">
                <a href="<?php echo Yii::app()->request->baseUrl . "/index.php/myfile/atechWindow/create"; ?>">
                    <h5 style="color: white;">+ สร้างใหม่</h5></a></li>
        </ul>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-md-12">
        <div class="tabs">
            <div class="tab-heading">
                <?php
                echo CHtml::link("Inbox" . ' ', '#tab' . 1, array(
                    'class' => 'button big'));
                ?>
                <?php
                echo CHtml::link("History" . ' ', '#tab' . 2, array(
                    'class' => 'button big'));
                ?>
            </div>
            <div class="page-content tab-content">
                <div id="tab1">
                    <div class="row">
                        <?php $i = 0; ?>
                        <?php foreach ($myfileArray as $myfile): ?>
                            <div class='col-lg-3 col-md-3 col-sm-12'>
                                <div class="blog-item">
                                    <a style="" class="btn <?php echo ($myfile->status == 1) ? "btn-success" : "btn-primary" ?> col-md-12" href="<?php echo Yii::app()->createUrl('/index.php/myfile/atechWindow/view/id/' . $myfile->orderId); ?>">
                                        <h3><?php echo $myfile->title; ?><?php if ($myfile->status == 1): ?>
                                                <i class="fa fa-comments pull-left"></i><?php endif; ?>
                                            <?php if (isset($myfile->userSpacialProject[0]) && $myfile->userSpacialProject[0]->status == 1): ?>
                                                <span class="label label-danger">R</span>
                                            <?php elseif (isset($myfile->userSpacialProject[0]) && $myfile->userSpacialProject[0]->status == 2): ?>
                                                <span class="label label-danger">S</span>
                                            <?php endif; ?>
                                        </h3>

                                        <p>วันที่สร้าง
                                            :<?php echo $this->dateThai($myfile->createDateTime, 3, TRUE); ?></p>

                                        <p>วันที่แก้ไข
                                            :<?php echo $this->dateThai($myfile->updateDateTime, 2, TRUE) ?></p>

                                        <p>จังหวัดที่ส่ง
                                            : <?php echo Province::model()->findByPk($myfile->provinceId)->provinceName; ?></p>
                                    </a>
                                </div>
                            </div>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div id="tab2">
                    <div class="row">
                        <?php $i = 0; ?>
                        <?php foreach ($myfileHistoryArray as $myfile): ?>
                            <div class='col-lg-3 col-md-3 col-sm-12'>
                                <div class="blog-item">
                                    <a style="" class="btn <?php echo ($myfile->status == 1) ? "btn-success" : "btn-primary" ?> col-md-12" href="<?php echo Yii::app()->createUrl('/index.php/myfile/atechWindow/view/id/' . $myfile->orderId); ?>">
                                        <h3><?php echo $myfile->title; ?><?php if ($myfile->status == 1): ?>
                                                <i class="fa fa-comments pull-left"></i><?php endif; ?></h3>

                                        <p>วันที่สร้าง
                                            :<?php echo $this->dateThai($myfile->createDateTime, 3, TRUE); ?></p>

                                        <p>วันที่แก้ไข
                                            :<?php echo $this->dateThai($myfile->updateDateTime, 2, TRUE) ?></p>

                                        <p>จังหวัดที่ส่ง
                                            : <?php echo Province::model()->findByPk($myfile->provinceId)->provinceName; ?></p>
                                    </a>
                                </div>
                            </div>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>