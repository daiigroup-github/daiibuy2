<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
$this->breadcrumbs = array(
    $this->module->id,
);
?>


<div class="row">
    <!-- Heading -->
    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="carousel-heading">
            <h4>My Files Fenzer : Create My File</h4>
            <div class="pull-right">
                <a class="col-lg-6 col-md-6 col-sm-6 glyphicon glyphicon-chevron-left button" onclick="javascript:history.back();"></a>
                <a class="col-lg-6 col-md-6 col-sm-6 glyphicon glyphicon-chevron-right button" onclick="javascript:history.forward();"></a>
            </div>
        </div>

    </div>
    <!-- /Heading -->
</div>
<div class="row" >
    <ul class="nav nav-tabs" role="tablist" >
        <li class="active orange"><a href="<?php echo Yii::app()->request->baseUrl . "/index.php/myfile/fenzer/"; ?>"><h5 >ไฟล์ของฉัน</h5></a></li>
        <li class="green"><a href="<?php echo Yii::app()->request->baseUrl . "/index.php/myfile/fenzer/create"; ?>"><h5 >+ สร้างใหม่</h5></a></li>
    </ul>
</div>
<!-- WIZARD -->
<div class="myfile-main">
    <div class="row form-group hidden">
        <div class="col-xs-12">
            <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                <li><a href="#step-1">
                        <h4 class="list-group-item-heading">Step 1</h4>
                        <p class="list-group-item-text">First step description</p>
                    </a></li>
                <li><a href="#step-2">
                        <h4 class="list-group-item-heading">Step 2</h4>
                        <p class="list-group-item-text">Second step description</p>
                    </a></li>
                <li class="active"><a href="#step-3">
                        <h4 class="list-group-item-heading">Step 3</h4>
                        <p class="list-group-item-text">Third step description</p>
                    </a></li>
                <li><a href="#step-4">
                        <h4 class="list-group-item-heading">Step 3</h4>
                        <p class="list-group-item-text">Third step description</p>
                    </a></li>
            </ul>
        </div>
    </div>
    <div class="row setup-content" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12 well text-center">
                <div class="row text-left">
                    ประเมินราคา
                </div>
                <div class="row">
                    <div class="col-md-6">
                        Height : <?php
                        echo CHtml::textField('height', $productResult['height'], array(
                            'id' => 'height_input',
                            'class' => 'input-lg',
                            'disabled' => true,));
                        ?>
                        เมตร
                    </div>
                    <div class="col-md-6 pull-left">
                        Length : <?php
                        echo CHtml::textField('length', $productResult['length'], array(
                            'id' => 'length_input',
                            'class' => 'input-lg',
                        ));
                        ?>
                        เมตร
                    </div>
                </div>
                <div class="row" id="order_list">
                    <div id="result_content" class="content-result">
                        <div class="row" >
                            <div class="col-xs-12">
                                <form id="editTableForm">
                                    <table id="editTable" class="table table-hover edit-table" style="background-color: #DDD" name="<?php echo $productResult['categoryId']; ?>">
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>รายละเอียด</th>
                                                <th>หน่วย</th>
                                                <th class="edit-table-qty" >จำนวน</th>
                                                <th>ราคา/หน่วย</th>
                                                <th>ราคา(บาท)</th>
                                                <th class="edit-table-price">ประเมิณราคา/เมตร(ไม่รวมเข็ม)</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <?php foreach ($productResult['items'] as $item): ?>
                                                <tr>
                                                    <td><?php echo $item->code; ?></td>
                                                    <td><?php echo $item->name; ?></td>
                                                    <td><?php echo $item->productUnits; ?></td>
                                                    <td><?php echo CHtml::textField('productItems[' . $item->productId . '][quantity]', $item->quantity, array('class' => 'edit-table-qty-input')); ?></td>
                                                    <td><?php echo FenzerController::formatMoney($item->price / intval($item->quantity), true); ?></td>
                                                    <td><?php echo FenzerController::formatMoney($item->price, true); ?></td>
                                                    <td><?php echo FenzerController::formatMoney(($item->price / $item->quantity) / 3, true); ?></td>
                                                    <td><button id="deleteRow" class="btn btn-danger">remove</button></td>
                                                </tr>
                                            <?php endforeach; ?>

<!--			<tr>
                                <td><?php
                                            // echo CHtml::dropDownList('productId', 'selectedCode',
//					CHtml::listData(Product::model()->findAll('supplierId ='. 176 .' AND Status = 1'), 'productId', 'code'),
//					array('id'=>'itemCode',
//						'prompt'=>'เลือกรหัส',
//						'ajax'=>array(
//									'type'=>'POST',
//									'url'=>CController::createUrl('fenzer/addNewProductItem'), //url to call.
////									'update'=>'#height_content', //selector to update
//									'dataType'=>'html',
//									'data'=>array(
//										"productId"=>"js:this.value",
//										"categoryId"=>$productResult['categoryId']),
//										"length"=>0,
//									'success'=>'js:function(data){
//										alert("Yo");
//										$("#result_content").html(data);
//									}',
//								),
//					));
                                            ?></td>
                                <td><?php // echo '';  ?></td>
                                <td><?php // echo '';  ?></td>
                                <td><?php // echo CHtml::textField('quantity', '',array('id'=>'qty','style'=>'width:100px;text-align:Right;'));  ?></td>
                                <td><?php // echo '';  ?></td>
                                <td><?php // echo '';  ?></td>
                                <td><?php // echo '';  ?></td>
                        </tr>-->
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-1">
                                เพิ่มสินค้า
                            </div>
                            <div class="col-sm-3">
                                <form id="addItem" action="#">

                                    <?php
                                    echo CHtml::dropDownList('productId', 'selectedCode', CHtml::listData(Product::model()->findAll('supplierId =' . 176 . ' AND Status = 1'), 'productId', 'code'), array('class' => 'form-control',
                                        'id' => 'itemCode',
                                        'prompt' => 'เลือกรหัสสินค้า',
                                        'style' => 'text-align: center;',
                                    ));
                                    ?>

                                    <?php
//					echo count($productResult['items'])." <br>";
//					foreach($productResult['items'] as $item){
//						echo $item->name ." <br>";
//					}
                                    ?>

                                </form>
                            </div>
                            <div class="col-sm-3">
                                <!--<button id="addItemButton" class="btn btn-block btn-info">เพิ่มสินค้า</button>-->
                                <?php
                                echo CHtml::button('เพิ่มสินค้า', array('class' => 'btn btn-info',
                                    'ajax' => array(
                                        'type' => 'POST',
                                        'url' => CController::createUrl('fenzer/addNewProductItem'),
                                        'dataType' => 'html',
                                        'data' => 'js:$("#addItem").serialize()',
                                        'success' => 'js:function(data){
					$("#editTable").append(data);
				}',
                                    ),
                                ));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row wizard-control">
                    <div class="col-lg-10 text-center">
                        <button id="calculatePrice" class="btn btn-warning btn-lg">อัพเดทราคา</button>
                    </div>
                    <div class="pull-right">
                        <button id="nextToStep4Edit" name="<?php echo $productResult['orderId']; ?>" class="btn btn-primary btn-lg">ต่อไป</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-4">
        <div class="col-xs-12">
            <div class="col-md-12 well text-center">
                <div class="row" id="confirm_content"></div>
                <div class="row wizard-control">
                    <div class="pull-right">
                        <button id="backToStep3" class="btn btn-primary btn-lg">ย้อนกลับ</button>
                        <button id="finish" class="btn btn-success btn-lg">เสร็จสิ้น</button>
                        <button id="addToCart" class="btn btn-warning btn-lg">ใส่ตระกร้า</button>
                        <button id="requestSpecial" class="btn btn-info btn-lg">Request Special Project</button>
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

<?php // echo $form->errorSummary($model);        ?>

        <div class="row">
<?php // echo $form->labelEx($model, 'supplierId');    ?>
<?php // echo $form->textField($model, 'supplierId');    ?>
<?php // echo $form->error($model, 'supplierId');        ?>
        </div>

        <div class="row">
<?php // echo $form->labelEx($model, 'type');     ?>
<?php // echo $form->textField($model, 'type');    ?>
<?php // echo $form->error($model, 'type');        ?>
        </div>

        <div class="row">
<?php // echo $form->labelEx($model, 'status');     ?>
<?php // echo $form->textField($model, 'status');    ?>
<?php // echo $form->error($model, 'status');        ?>
        </div>

        <div class="row">
<?php // echo $form->labelEx($model, 'title');     ?>
<?php // echo $form->textField($model, 'title');    ?>
<?php // echo $form->error($model, 'title');        ?>
        </div>


        <div class="row buttons">
<?php // echo CHtml::submitButton('Submit');         ?>
        </div>

<?php // $this->endWidget();         ?>

</div>-->
<!-- form -->

