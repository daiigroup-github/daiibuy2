<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
$this->breadcrumbs = array(
    $this->module->id,
);
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'Order-form',
    // Please note: When you enable ajax validation, make sure the corresponding
// controller action is handling ajax validation correctly.
// There is a call to performAjaxValidation() commented in generated controller code.
// See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'enctype' => 'multipart/form-data',
    ),
        ));
?>

<?php $this->renderPartial("_navbar"); ?>
<!-- WIZARD -->
<div class="myfile-main">
    <?php
    $this->renderPartial("_wizard_step", array(
        'model' => $model));
    ?>
    <!--STEP 1 Select Province-->
    <div class="row setup-content" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12 well">
                <div class="row">
                    <div class="col-md-4">
                        <div class="page-header select-province">
                            <h1>สร้าง My File</h1><small> กรุณากรอกข้อมูลตามด้านล่าง.</small>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <?php
                                echo $form->textField($model, 'title', array(
                                    'size' => 20,
                                    'maxlength' => 20,
                                    'class' => 'form-control',
                                    'placeholder' => 'กรุณากรอกชื่อ My File.'));
                                ?>
                                <?php echo $form->error($model, 'title'); ?>
                            </div>
                        </div>
                        <!--						<div>
                        <?php
//							echo CHtml::textField('title', $model->title, array(
//								'class'=>'form-control',
//								'id'=>'myfile_title',
//								'placeholder'=>'กรุณากรอกชื่อ My File.'
//							));
                        ?>
                                                                        </div>-->
                        <div style="margin-top: 15px">
                            <?php
                            echo CHtml::dropDownList('Order[provinceId]', $model->provinceId, CHtml::listData(Province::model()->findAll(), 'provinceId', 'provinceName'), array(
                                'class' => 'form-control',
                                'id' => 'selectProvince',
                                'prompt' => '--กรุณาเลือกจังหวัด--',
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="page-header select-province">
                        <h4>Step 1</h4>
                    </div>
                </div>

                <div class="row wizard-control">
                    <div class="col-md-4 col-sm-offset-1 text-center">
                        <a id="nextToStep1-2">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h2><b>Bathroom</b></h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-offset-1 text-center">
                        <a id="nextToStep2-1">
                            <div class="panel panel-warning"  >
                                <div class="panel-heading" style="background-color: #F65D20;color: white">
                                    <h2><b>Floor Tile</b></h2>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row wizard-control">
                    <div class="pull-right">
                        <button id="nextToStep2" class="btn btn-primary btn-lg hidden"> ต่อไป <i class="glyphicon glyphicon-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row setup-content" id="step-1-2">
        <div class="col-xs-12">
            <div class="col-md-12 well">
                <div class="row">
                    <?php $i = 0; ?>
                    <?php
                    echo CHtml::hiddenField("Order[createMyfileType]", "");
                    if ($model->status < 1) {
                        foreach ($categoryItems as $item):
                            //						$key = $value->name;
                            ?>
                            <?php
//                        throw new Exception(print_r($item, true));
                            $class = 'col-lg-3 col-md-3 col-sm-12';
                            //$class = ($i==0) ? 'col-lg-12 col-md-12 col-sm-12' : 'col-lg-4 col-md-4 col-sm-12';
                            //$class = 'col-lg-6 col-md-6 col-sm-12';
                            ?>
                            <div class="<?php echo $class; ?>">
                                <div class="blog-item" >
                                    <a class="chooseStyle" name="<?php echo $item['category2Id']; ?>"><?php
                                        echo CHtml::image($item['image'], $item['title'], array(
                                            "style" => "height:130px"));
                                        ?>
                                        <div class="button darkgrey" style="text-align: center;background-clip: border-box;color:black"><?php echo $item['title']; ?></div>
                                    </a>
                                    <?php
                                    /*
                                      <div class="product-actions blog-actions">
                                      <span class="product-action dark-blue current">
                                      <span class="action-wrapper">
                                      <i class="icons icon-doc-text"></i>
                                      <span class="action-name">Read more</span>
                                      </span>
                                      </span>
                                      </div>
                                     */
                                    ?>
                                </div>

                            </div>
                            <?php $i++; ?>
                            <?php
                        endforeach;
                    }
                    $field = OrderDetailTemplateField::model()->find('description = "cate2Id"');
                    ?>

                </div>
                <div class="row wizard-control">
                    <?php echo CHtml::hiddenField("OrderDetailValue[" . $field->orderDetailTemplateFieldId . "][value]"); ?>
                </div>

                <div class="row wizard-control">
                    <div class="pull-right">
                        <button id="nextToStep2" class="btn btn-primary btn-lg hidden"> ต่อไป <i class="glyphicon glyphicon-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--	Bathroom-->
    <div class="row setup-content" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12 well">
                <div class="row">
                    <div class="col-md-4 col-sm-offset-1 text-center">
                        <a id="uploadPlanMadrid">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h2><b>อัพโหลดแบบดีไซน์</b></h2>
                                </div>
                                <div class="panel-body">
                                    <h4><b>เพื่อส่ง Call Center <br>ประเมิณพื้นที่</b></h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-offset-1 text-center">
                        <a id="manualQuantityMadrid">
                            <div class="panel panel-warning" >
                                <div class="panel-heading" style="background-color: #F65D20;color: white">
                                    <h2><b>ใส่ปริมาณพื้นที่</b></h2>
                                </div>
                                <div class="panel-body">
                                    <h4><b>เพื่อประเมิณราคากระเบื้อง<br>และเปรียบเทียบราคา</b></h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php echo CHtml::hiddenField("Order[isTheme]", 1); ?>
                <div class="row wizard-control">
                    <div class="pull-right">
                        <button id="nextToStep2" class="btn btn-primary btn-lg hidden"> ต่อไป <i class="glyphicon glyphicon-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--	Floor Tiles-->
    <div class="row setup-content" id="step-2-1">
        <div class="col-xs-12">
            <div class="col-md-12 well">
                <div class="row">
                    <div class="col-md-4 col-sm-offset-1 text-center">
                        <a id="uploadPlanTile" >
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h2><b>อัพโหลดแบบดีไซน์</b></h2>
                                </div>
                                <div class="panel-body">
                                    <h4><b>เพื่อส่ง Call Center <br>ประเมิณพื้นที่</b></h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-offset-1 text-center">
                        <a id="manualQuantityTile">
                            <div class="panel panel-warning" >
                                <div class="panel-heading" style="background-color: #F65D20;color: white">
                                    <h2><b>ใส่ปริมาณพื้นที่</b></h2>
                                </div>
                                <div class="panel-body">
                                    <h4><b>เพื่อประเมิณราคากระเบื้อง<br>และเปรียบเทียบราคา</b></h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php echo CHtml::hiddenField("Order[isTheme]", 0); ?>
                <div class="row wizard-control">
                    <div class="pull-right">
                        <button id="nextToStep2" class="btn btn-primary btn-lg hidden"> ต่อไป <i class="glyphicon glyphicon-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--STEP 2 upload plan-->
    <div class="row setup-content" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12 well text-left">
                <div class="row">
                    <div class="page-header myfile-fenzer-header" >
                        <h1>อัพโหลดแบบแปลน</h1><small> กรุณาอัพโหลดแบบแปลนที่ต้องการให้ประเมินราคา.</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="upload_plan">
                        <?php // $this->renderPartial('_upload_plan', array('model'=>$model));             ?>

                        <div class="row">
                            <div class="col-sm-7">

                                <div class="form-group">
                                    รูปแปลน : <input name="OrderFile[0]" type="file" class="file" data-show-upload="false">
                                </div>
                                <div class="form-group">
                                    รูปด้าน 1 : <input name="OrderFile[1]" type="file" class="file" data-show-upload="false">
                                </div>
                                <div class="form-group">
                                    รูปด้าน 2 : <input name="OrderFile[2]" type="file" class="file" data-show-upload="false">
                                </div>
                                <div class="form-group">
                                    รูปด้าน 3 : <input name="OrderFile[3]" type="file" class="file" data-show-upload="false">
                                </div>
                                <div class="form-group">
                                    รูปด้าน 4 : <input name="OrderFile[4]" type="file" class="file" data-show-upload="false">
                                </div>
                                <div class="form-group">
                                    รูปด้าน 5 : <input name="OrderFile[5]" type="file" class="file" data-show-upload="false">
                                </div>
                                <div class="form-group">
                                    รูปด้าน 6 : <input name="OrderFile[6]" type="file" class="file" data-show-upload="false">
                                </div>
                                <div class="form-group">
                                    รูปด้าน 7 : <input name="OrderFile[7]" type="file" class="file" data-show-upload="false">
                                </div>
                                <div class="form-group">
                                    รูปด้าน 8 : <input name="OrderFile[8]" type="file" class="file" data-show-upload="false">
                                </div>
                                <div class="form-group">
                                    รูปด้าน 9 : <input name="OrderFile[9]" type="file" class="file" data-show-upload="false">
                                </div>
                                <div class="form-group">
                                    รูปด้าน 10 : <input name="OrderFile[10]" type="file" class="file" data-show-upload="false">
                                </div>

                                <?php ?>
                            </div>
                            <div class="col-sm-5">
                                <div class="panel panel-info">
                                    <div class="panel-heading text-left">
                                        <h4><b><i class="glyphicon glyphicon-exclamation-sign"></i> หมายเหตุ</b></h4>
                                    </div>
                                    <div class="panel-body">
                                        <small><b>1.หลังจากลูกค้าอัพโหลดแบบ รอ 3 วันทำการ เพื่อทำการประเมินราคา <br>
                                                2.ขนาดที่ลูกค้าได้รับจากการประเมินราคาใน www.daiibuy.com จะเป็นขนาดมาตรฐานจากโรงงานเท่านั้น โดยจะมีการปรับขนาดหน้าต่าง ให้ใกล้เคียงกับขนาดมารฐาน<br>
                                                3.หากลูกค้าต้องการสั่งซื้อขนาดอื่นๆ นอกเหนือจากขนาดมารฐาน<br>
                                                โปรดติดต่อบริษัท ไดอิ กรุ๊ป จำกัด มหาชน โทร. 02-9383464</b></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
//                        throw new Exception(print_r($orderDetailTemplateField, true));
//                        foreach ($orderDetailTemplateField as $field):
                        $field = OrderDetailTemplateField::model()->find('title = "comment"');
                        ?>
                        <div class="row">
                            <div class="col-lg-1 control-label">
                                <?php echo $field->description; ?>
                            </div>
                            <div class="col-lg-9l">
                                <?php
                                echo CHtml::textArea("OrderDetailValue[" . $field->orderDetailTemplateFieldId . "][value]", "", array(
                                    'class' => 'form-control',
                                    'rows' => 5))
                                ?>
                            </div>
                        </div>

                        <div class="row wizard-control">

                            <?php
                            echo CHtml::submitButton('Create', array(
                                'class' => 'btn btn-primary',
                                'onclick' => 'return checkComment()'));
                            ?>
                        </div>
                        <?php ?>

                    </div>
                </div>
                <!--				<div class="row wizard-control">-->
                <!--					<div class="pull-right">
                                                        <button id="commitUpload" class="btn btn-success btn-lg"><i class="glyphicon glyphicon-ok"></i> ส่งข้อมูล</button>
                                                        </div>-->
                <!--					<div class="pull-left">
                                                                <button id="backToStep1" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-chevron-left"></i> ย้อนกลับ</button>
                                                        </div>
                                                        <div class="pull-right">
                                                                <button id="nextToStep3" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-chevron-right"></i> ต่อไป</button>
                                                        </div>-->
                <!--</div>-->
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-3-1">
        <div class="col-xs-12">
            <div class="carousel-heading no-margin">
                <b><h4>รอ Call Center ประเมิณราคา</h4></b>
            </div>
            <div class="col-md-12 well">
                <div class="row text-center">
                    <div style="margin-top: 2%">
                        <?php $i = 0; ?>
                        <?php foreach ($model->orderFiles as $orderFile): ?>
                            <div class='col-lg-6 col-md-6 col-sm-12'>
                                <div class="blog-item">
                                    <?php
                                    echo CHtml::image(Yii::app()->baseUrl . $orderFile->filePath, '', array(
                                        'style' => 'width:300px;height:300px'));
                                    ?>
                                    <div class="blue button center-block" style="text-align: center;background-clip: border-box;color: white;width:300px;"><?php echo $i == 0 ? "แบบแปลน" : "ด้านข้าง " . $i; ?></div>
                                </div>
                            </div>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="row">

                    <?php foreach ($orderDetailTemplateField as $field): ?>
                        <div class="col-lg-1 control-label"><?php echo $field->description; ?></div>
                        <div class="col-lg-11">
                            <?php
//                            throw new Exception(print_r($orderDetailTemplateField, true));
                            if (isset($model->orderId)):
                                $orderDetail = OrderDetail::model()->find("orderId = :orderId", array(
                                    ":orderId" => $model->orderId));

                                if (isset($orderDetail)) {
                                    $fieldValue = OrderDetailValue::model()->find("orderDetailId = " . $orderDetail->orderDetailId . " AND orderDetailTemplateFieldId = " . $field->orderDetailTemplateFieldId);
//                                    throw new Exception(print_r($fieldValue, true));
                                    if (isset($fieldValue->value) && $fieldValue == "")
                                        echo $fieldValue->value;
                                }
                            endif;
                            ?>
                        </div>
                    <?php endforeach; ?>

                </div>

            </div>
        </div>
    </div>

    <div class="row setup-content" id="step-4">
        <div class="col-xs-3">
            <?php
//            throw new Exception(print_r($model->category2Id, true));
//            $themes = UserFavourite::model()->findAllThemeByUserId(Yii::app()->user->id);
//            $sets = UserFavourite::model()->findAllThemeByUserId(Yii::app()->user->id, FALSE);
            ?>
            <div class="row sidebar-box red ">
                <div class="col-sm-12">
                    <div class="sidebar-box-heading">
                        <i class="fa fa-heart"></i>
                        <h4>Theme</h4>
                    </div>
                    <div class="sidebar-box-content" id="themeResult">
                        <!--                        <ul>
                        <?php
//                            foreach ($themes as $theme):
//                                if($theme->category2Id == ) {
                        ?>
                                                        <li><a href="#"  onclick="loadThemeItem(<?php // echo $theme->category2Id;                                                                                            ?>,<?php // echo "'" . Yii::app()->baseUrl . "'"                                                                                            ?>, <?php // echo isset($model->orderId) ? $model->orderId : 0                                                                                            ?>)"><?php // echo $theme->category2->title;                                                                                            ?></li></a>
                        <?php
//                                }
//                            endforeach;
                        ?>
                                                </ul>-->
                    </div>
                </div>
            </div>
            <div class="row sidebar-box orange ">
                <div class="col-sm-12">
                    <div class="sidebar-box-heading">
                        <i class="fa fa-heart"></i>
                        <h4>Sanitary Set</h4>
                    </div>
                    <div class="sidebar-box-content" id="setResult">
                        <!--                        <ul>
                        <?php // foreach ($sets as $set):      ?>
                                                        <li><a href="#" onclick="loadSetItem(<?php // echo $set->category2Id;                                                                                              ?>,<?php // echo "'" . Yii::app()->baseUrl . "'"                                                                                              ?>)"><?php // echo $set->category2->title;                                                                                              ?></li></a>
                        <?php // endforeach;       ?>
                                                </ul>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-9">
            <div class="row sidebar-box blue ">
                <div class="col-md-12 <?php echo ($this->action->id == "create") ? " hide" : "" ?>" id="item-table">
                    <?php
                    $this->renderPartial("_theme", array(
                        'model' => $model));
                    ?>
                </div>
                <div id="sanitary-item" class="hide">

                </div>
            </div>
            <div class="row <?php echo ($this->action->id == "create") ? " hide" : "" ?>" id="action-button">
                <div class="col-md-12 wizard-control">
                    <?php if (!$model->isNewRecord && $this->action->id == "view"): ?>
                        <a class="btn btn-warning btn-lg col-lg-offset-3" onclick="<?php echo ($model->isTheme == 1) ? "updatePrice()" : "updateSetPrice(" . count($model->orderItems) . ")" ?>"><i class="glyphicon glyphicon-refresh"></i> อัพเดทราคา</a>
                    <?php endif; ?>
                    <button id="nextToStep5" class="btn btn-primary btn-lg pull-right"><i class="glyphicon glyphicon-chevron-right"></i> ต่อไปเลย</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row setup-content" id="step-4-1">
        <div class="col-xs-3">
            <?php
//            throw new Exception(print_r($model->category2Id, true));
//            $themes = UserFavourite::model()->findAllThemeByUserId(Yii::app()->user->id);
//            $sets = UserFavourite::model()->findAllThemeByUserId(Yii::app()->user->id, FALSE);
            ?>
            <div class="row sidebar-box red ">
                <div class="col-sm-12">
                    <div class="sidebar-box-heading">
                        <i class="fa fa-heart"></i>
                        <h4>Tiles</h4>
                    </div>
                    <div class="sidebar-box-content" id="productsFavResult">
                        <!--                        <ul>
                        <?php
//                            foreach ($themes as $theme):
//                                if($theme->category2Id == ) {
                        ?>
                                                        <li><a href="#"  onclick="loadThemeItem(<?php // echo $theme->category2Id;                                                                                            ?>,<?php // echo "'" . Yii::app()->baseUrl . "'"                                                                                            ?>, <?php // echo isset($model->orderId) ? $model->orderId : 0                                                                                            ?>)"><?php // echo $theme->category2->title;                                                                                            ?></li></a>
                        <?php
//                                }
//                            endforeach;
                        ?>
                                                </ul>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-9">
            <div class="row sidebar-box blue ">
<!--                <div class="col-md-12 <?php echo ($this->action->id == "create") ? " hide" : "" ?>" id="product-fav-table">
                <?php ?>
                </div>-->
                <div id="product-fav-item" class="hide">

                </div>
            </div>
            <div class="row <?php echo ($this->action->id == "create") ? " hide" : "" ?>" id="action-button-tiles">
                <div class="col-md-12 wizard-control">
                    <?php if (!$model->isNewRecord && $this->action->id == "view"): ?>
                        <a class="btn btn-warning btn-lg col-lg-offset-3" onclick="<?php echo ($model->isTheme) ? "updatePrice()" : "updateSetPrice(" . count($model->orderItems) . ")" ?>"><i class="glyphicon glyphicon-refresh"></i> อัพเดทราคา</a>
                    <?php endif; ?>
                    <button id="nextToStep5tile" class="btn btn-primary btn-lg pull-right"><i class="glyphicon glyphicon-chevron-right"></i> ต่อไปเลย</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row setup-content" id="step-5">
        <div class="col-xs-12">
            <div class="col-md-12 well">
                <div class="row sidebar-box" id="confirm_content">
                    <div class="col-xs-12">
                        <div class="sidebar-box-heading">
                            <i class="fa fa-list"></i>
                            <h4>ยืนยันรายการสินค้า <?php echo $model->title; ?></h4>
                        </div>
                        <div class="row sidebox-content ">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <?php if ($model->isTheme): ?>
                                                        <th>ลำดับ</th>
                                                        <th>รายละเอียดรายการที่ชอบ</th>
                                                        <th style="width: 10%;text-align: center">พื้นที่จาก การประเมิณ</th>
                                                        <th>หน่วย</th>
                                                        <th>รหัส</th>
                                                        <th>รายละเอียดสินค้า</th>
                                                        <th>หน่วย</th>
                                                        <th>จำนวน/หน่วย</th>
                                                        <th style="width: 10%;text-align: center">ปริมาณจาก การประเมิณพื้นที่</th>
                                                        <th>ปริมาณแก้ไข</th>
                                                        <th>ราคารวม</th>
                                                    <?php else: ?>
                                                        <th>Product Image</th>
                                                        <th>Code</th>
                                                        <th>Title/Category</th>
                                                        <th>Price</th>
                                                        <th>Quantiry</th>
                                                        <th>Total</th>
                                                    <?php endif; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($model->orderItems as $item):
                                                    ?>
                                                    <?php if ($model->isTheme): ?>
                                                        <tr id="orderItem<?php echo strtolower($item->groupName); ?>">
                                                            <td><?php echo $i; ?></td>
                                                            <td style="text-align:center"><?php echo $item->groupName ?></td>
                                                            <td style="text-align: center"><?php echo $item->area; ?><?php echo CHtml::hiddenField("supplierArea" . strtolower($item->groupName), $item->area); ?></td>
                                                            <td>ตร.เมตร</td>
                                                            <td id="productCode<?php echo strtolower($item->groupName) ?>" class="text-info" id="productCode"><?php echo isset($item->product) ? $item->product->code : ""; ?></td>
                                                            <td id="productName<?php echo strtolower($item->groupName) ?>"><?php echo isset($item->product) ? $item->product->name : ""; ?></td>
                                                            <td id="productUnits<?php echo strtolower($item->groupName) ?>"><?php echo isset($item->product) ? $item->product->productUnits : ""; ?></td>
                                                            <?php
                                                            $productArea = isset($item->product) ? ($item->product->width * $item->product->height) / 10000 : 0;
                                                            $estimateQuantity = $productArea * $item->area;
                                                            ?>

                                                            <td  style="text-align: center" id="productArea<?php echo strtolower($item->groupName) ?>">
                                                                <?php echo $productArea; ?>
                                                            </td>
                                                            <td style="text-align: center" id="estimateAreaQuantity<?php echo strtolower($item->groupName) ?>"><?php echo $estimateQuantity ?></td>
                                                            <td id="quantity<?php echo strtolower($item->groupName) ?>"><?php
                                                                echo $item->quantity;
                                                                ?></td>
                                                            <td id="price<?php echo strtolower($item->groupName) ?>"><?php echo isset($item->product) ? number_format($item->quantity * $item->product->price) : 0 ?></td>
                                                        </tr>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td><?php
                                                                echo (isset($item->product->productImagesSort) && count($item->product->productImagesSort)) ? CHtml::image(isset($item->product) ? Yii::app()->baseUrl . $item->product->productImagesSort[0]->image : "", "", array(
                                                                            'style' => "width:200px")) : "";
                                                                ?></td>
                                                            <td><?php echo $item->product->code; ?></td>
                                                            <td><?php echo $item->product->name; ?></td>
                                                            <td style="color:red"><?php echo number_format($item->product->price, 2); ?>

                                                                <?php echo CHtml::hiddenField("OrderItems[$item->orderItemsId][productId]", $item->productId) ?>
                                                                <?php echo CHtml::hiddenField("OrderItems[$item->orderItemsId][price]", $item->product->price) ?>
                                                            </td>
                                                            <td style="width: 20%">
                                                                <div class="row"><div class="col-md-12"><?php echo number_format($item->quantity, 0); ?></div></div>
                                                            </td>
                                                            <td><?php echo number_format($item->quantity * $item->product->price, 0) ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                    <?php
                                                    $i++;
                                                endforeach;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row wizard-control">
                    <div class="pull-right">
                        <?php if (!$model->isRequestSpacialProject && $model->type == 1): ?>
                            <a id="backToStep3" class="btn btn-primary btn-lg" href="<?php echo Yii::app()->createUrl("/myfile/madrid/backTo3/id/$model->orderId") ?>"><i class="glyphicon glyphicon-chevron-left"></i> ย้อนกลับ</a>
                        <?php endif; ?>
                        <a id="" class="btn btn-success btn-lg" href="<?php echo Yii::app()->createUrl("/myfile/madrid/finish/id/$model->orderId") ?>"><i class="glyphicon glyphicon-ok"></i> เสร็จสิ้น</a>
                        <a id="" class="btn btn-danger btn-lg" href="<?php echo Yii::app()->createUrl("/myfile/atechWindow/duplicateMyfile/id/$model->orderId") ?>"><i class="glyphicon glyphicon-plus"></i> สร้างสำเนา</a>
                        <?php if ($model->type < 3): ?>
                            <a class="btn btn-warning btn-lg" href="<?php echo Yii::app()->createUrl("/myfile/madrid/addToCart/id/$model->orderId") ?>"><i class="glyphicon glyphicon-shopping-cart"></i> ใส่ตระกร้า</a>
                        <?php endif; ?>
                        <?php if (!$model->isRequestSpacialProject): ?>
                            <?php if (Yii::app()->user->userType == 2): ?>
                                <a id="requestSpecial" class="btn btn-info btn-lg" href="<?php echo Yii::app()->createUrl("/myfile/madrid/requestSpacialProject/id/$model->orderId") ?>"><i class="glyphicon glyphicon-share"></i> Request Special Project</a>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if ($model->userSpacialProject[0]->status == 1): ?>
                                <span class="btn btn-danger btn-xs">Sending Request Spacial Project</span>
                            <?php elseif ($model->userSpacialProject[0]->status == 2): ?>
                                <span class="btn btn-success btn-xs">อนุมัติคำขอ Spacial Project</span>
                            <?php elseif ($model->userSpacialProject[0]->status == 3): ?>
                                <a id="requestSpecial" class="btn btn-danger btn-lg" href="<?php echo Yii::app()->createUrl("/myfile/madrid/requestSpacialProject/id/$model->orderId") ?>"> ไม่อนุมัติคำขอ Spacial Project -<i class="glyphicon glyphicon-share"></i> Request อีกครั้ง</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



<!--********old code-->
<!--<div class="form">

<?php
//	$form = $this->beginWidget('CActiveForm', array(
//		'id'=>'order-create-form',
// Please note: When you enable ajax validation, make sure the corresponding
// controller action is handling ajax validation correctly.
// See class documentation of CActiveForm for details on this,
// you need to use the performAjaxValidation()-method described there.
//		'enableAjaxValidation'=>false,
//	));
?>
        <p class="note">Fields with <span class="required">*</span> are required.</p>

<?php // echo $form->errorSummary($model);                                                    ?>

        <div class="row">
<?php // echo $form->labelEx($model, 'supplierId');              ?>
<?php // echo $form->textField($model, 'supplierId');              ?>
<?php // echo $form->error($model, 'supplierId');                                             ?>
        </div>

        <div class="row">
<?php // echo $form->labelEx($model, 'type');               ?>
<?php // echo $form->textField($model, 'type');              ?>
<?php // echo $form->error($model, 'type');                                             ?>
        </div>

        <div class="row">
<?php // echo $form->labelEx($model, 'status');               ?>
<?php // echo $form->textField($model, 'status');             ?>
<?php // echo $form->error($model, 'status');                                             ?>
        </div>

        <div class="row">
<?php // echo $form->labelEx($model, 'title');               ?>
<?php // echo $form->textField($model, 'title');            ?>
<?php // echo $form->error($model, 'title');                                              ?>
        </div>


        <div class="row buttons">
<?php // echo CHtml::submitButton('Submit');                                                      ?>
        </div>

<?php // $this->endWidget();                                                      ?>

</div>-->
<!-- form -->

<?php $this->endWidget(); ?>
