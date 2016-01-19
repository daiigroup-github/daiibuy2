<h2 class="blue text-center" id="myModalLabel">ข้อตกลงและเงื่อนไข ตรวจรับงานงวดที่ <?php echo $period ?></h2>
<div class="col-md-12">
    <!--						<div class="sidebar-box-heading">
                                <i class="fa fa-tdst"></i>
                                <h4>ข้อตกลงและเงื่อนไข <?php // echo $model->title;                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ?></h4>
                            </div>-->
    <div class="row sidebox-content ">
        <?php
        if (isset($conditionOrder)):
            ?>
            <div class="col-md-12" >
                <div class="form-group">
                    <div class="control-label col-md-2">
                        เลขที่ใบสั่งซื้อสินค้า
                    </div>
                    <div class="col-md-10">
                        <h4><?php echo $conditionOrder->orderNo; ?></h4>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <?php
                        echo CHtml::image(Yii::app()->baseUrl . $conditionOrder->orders[0]->orderItems[0]->product->productImagesSort[0]->image, "", array(
                            'style' => 'width:500px'))
                        ?>
                    </div>
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-11">
                        เนื่องจากบางบริษัทได้เข้าดำเนินการสำรวจผังตามใบสั่งซื้อของลูกค้าไปแล้วนั้น ทางบริษัทเห็นว่า สามารถเข้าดำเนินการก่อสร้างขั้นตอไปได้<br>
                        ผู้สั่งซื้อกรุณาตรวจสอบรายละเอียด และแบบและสัญญาให้ครบถ้วน ตามรายการด้านล่าง

                        <table class="table table-bordered table-condensed ">
                            <?php
                            $sendWorks = OrderGroupSendWork::model()->findAll("orderGroupId = $conditionOrder->orderGroupId ORDER BY seq ASC");
                            foreach ($sendWorks as $sendWork):
                                ?>
                                <tr>
                                    <td style="width:50%"><?php echo $sendWork->title; ?> </td><td><a href="<?php echo Yii::app()->baseUrl . $sendWork->image; ?>" class="fancybox"><span class="label label-primary">View Attech File</span></a></td>
                                </tr>
                            <?php endforeach; ?>
    <!--						<tr>
    <td style="width:50%">Layout Approve </td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
    </tr>
    <tr>
    <td>ผลสำรวจ</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
    </tr>
    <tr>
    <td>ใบรับงานสำรวจ</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
    </tr>-->
                        </table>

                    </div>
                </div>
            <?php endif; ?>
            <!--			<div class="row">
                            <div class="col-md-11">
                                2. ก่อนสังซื้องวดต่อไป ผู้สั่งซื้อต้องอ่านแล้วทำความเข้าใจ รายละเอียดแบบและสัญญาให้ครบถ้วนตามรายการด้านล่างดังนี้
                                <table class="table table-bordered table-condensed ">
                                    <tr>
                                        <td style="width:50%">แบบผังพื้น</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
                                    </tr>
                                    <tr>
                                        <td>แบบรูปด้าน</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
                                    </tr>
                                    <tr>
                                        <td>แบบรูปตัด</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
                                    </tr><tr>
                                        <td>แบบงานระบบไฟฟ้า</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
                                    </tr><tr>
                                        <td>แบบงานระบบสุขาภิบาล</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
                                    </tr><tr>
                                        <td>สัญญาซื้อขาย</td><td><a href="" class=""><span class="label label-primary">View Attech File</span></a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>-->
            <div class="row hide"  id="changHouseDetail">
                <div class="col-md-12" >
                    <div class="row">
                        <div class="col-md-12">
                            ก่อนสั่งซื้องวดต่อไป ลูกค้าสามารถปรับเปลี่ยนรายละเอียดบ้านได้โดย
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td> </td>
                                <td>สามารถปรับเปลี่ยน Series ของบ้านจาก Light / C / E / SL ได้ โดยคิดมูลค่าตามจริงของบ้านหลังนั้นๆ</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>สามารถปรับเปลี่ยนสีของบ้าน Silver / Oak Brown / Earth Tone ได้โดยไม่เสียค่าใช้จ่ายเพิ่ม</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>สามารถปรับเปลี่ยน Size ของบ้านได้ โดยคิดมูลค่าตามจริงของบ้านหลังนั้นๆ</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:red">ซึ่งหลังจากนี้แล้วทางบริษัทฯจะเข้าดำเนินการก่อสร้างตามรายละเอียดที่ลูกค้ายืนยัน ลูกค้าจะไม่สามารถปรับเปลี่ยนใดๆ ได้อีก</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row hide" id="changHouseDetail2">
                <div class="col-md-12">
                    <form id="payForm2"  method="POST" class='form-horizontal' action="<?php echo Yii::app()->createUrl("/checkout/step/myfileGinzaStep?orderGroupId=" . $child1->orderGroupId); ?>">
                        รายละเอียดบ้านตามที่ลูกค้าเลือกปัจจุบัน <?php echo count($child1->supPay) > 0 ? "<span style='color:red'> (ไม่สามารถเปลี่ยนแปลงรายการสินค้าได้เนื่องจากลูกค้าได้ชำระงวดที่ 2 ไปแล้วบางส่วน)</span>" : ""; ?>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>ชนิดบ้าน </td>
                                    <td><?php
                                        //																						throw new Exception(print_r(count($child1->supPay), true));
                                        //
										//
										$isChangeHome = 1;
                                        if (isset($child1->parentId))
                                            $oldChild1 = OrderGroup::model()->findByPk($child1->parentId);

//throw new Exception(print_r($oldChild1, true));



                                        if (count($child1->supPay) > 0 || count($oldChild1->supPay) > 0) {
                                            $isChangeHome = 0;

                                            if (isset($child1->supPay[0]) || isset($oldChild1->supPay[0])) {
                                                if (isset($child1->supPay[0])) {
                                                    $model = $child1;
                                                } else {
                                                    $model = $oldChild1;
                                                }
                                                echo CHtml::hiddenField("orderGroupId", $model->supPay[0]->orderGroupId);
                                                echo CHtml::hiddenField("period", 2);
                                                $productId = isset($model->orders[0]->orderItems[0]->productId) ? $model->orders[0]->orderItems[0]->productId : $model->supPay[0]->orders[0]->orderItems[0]->productId;
//		throw new Exception(print_r($isChangeHome, true));
                                                if (isset($productId)) {
                                                    $category2ToProducts = Category2ToProduct::model()->findAll("productId = " . $productId . ' order by productId DESC');
                                                } else {
                                                    throw new Exception(print_r($productId, true));
                                                }
                                                $category2ToProduct = isset($category2ToProducts[1]) ? $category2ToProducts[1] : $category2ToProducts[0];
                                                if (isset($category2ToProduct)) {
                                                    $cate2subCate = CategoryToSub::model()->find('subCategoryId = ' . $category2ToProduct->category1Id);
                                                } else {
                                                    throw new Exception(print_r($category2ToProduct, true));
                                                }
                                            }
                                        } else {

                                            echo CHtml::hiddenField("orderGroupId", $model->orderGroupId);
                                            echo CHtml::hiddenField("period", 2);
                                            $category2ToProducts = Category2ToProduct::model()->findAll("productId = " . $model->orders[0]->orderItems[0]->productId . ' order by productId DESC');
//                                                                                throw new Exception(print_r($category2ToProducts[1]->category1Id,true));
                                            $category2ToProduct = isset($category2ToProducts[1]) ? $category2ToProducts[1] : $category2ToProducts[0];
                                            //                                                                                throw new Exception(print_r($category2ToProduct->category1Id,true));
                                            if (isset($category2ToProduct)) {
                                                $cate2subCate = CategoryToSub::model()->find('subCategoryId = ' . $category2ToProduct->category1Id);
                                            } else {
                                                throw new Exception(print_r($category2ToProduct, true));
                                            }
                                        }
                                        if ($isChangeHome == 1) {

                                            echo CHtml::dropDownList("brandModelId", $category2ToProduct->brandModelId, CHtml::listData($brandModels, "brandModelId", "title"), array(
                                                'prompt' => '-- เลือกแบบบ้าน --',
                                                'id' => 'brandModelId',
                                                'ajax' => array(
                                                    'type' => 'POST',
                                                    'data' => array(
                                                        'brandModelId' => 'js:this.value'),
                                                    'url' => $this->createUrl('/myfile/ginzaHome/findStyle'),
                                                    'success' => 'js:function(data){

										//$("#sameAddress").prop("disabled", true);
										$("#styleId").html(data);
										//$("#billingAmphur").prop("disabled", false);
										//$("#billingDistrict").html("");
										//$("#billingDistrict").prop("disabled", true);
										 }'))
                                            );
                                        } else {
                                            //											throw new Exception(print_r($productId, true));
                                            if (!isset($category2ToProduct)) {
                                                throw new Exception(print_r($oldChild1, true));
                                            }
                                            echo CHtml::hiddenField("brandModelId", $category2ToProduct->brandModelId);
                                            echo CHtml::dropDownList("brandModelId", $category2ToProduct->brandModelId, CHtml::listData($brandModels, "brandModelId", "title"), array(
                                                'prompt' => '-- เลือกแบบบ้าน --',
                                                'id' => 'brandModelId',
                                                'disabled' => 'true',
                                                'ajax' => array(
                                                    'type' => 'POST',
                                                    'data' => array(
                                                        'brandModelId' => 'js:this.value'),
                                                    'url' => $this->createUrl('/myfile/ginzaHome/findStyle'),
                                                    'success' => 'js:function(data){

										//$("#sameAddress").prop("disabled", true);
										$("#styleId").html(data);
										//$("#billingAmphur").prop("disabled", false);
										//$("#billingDistrict").html("");
										//$("#billingDistrict").prop("disabled", true);
										 }'))
                                            );
                                        }
                                        ?></td>
                                </tr>
                                <tr>
                                    <td>รูปแบบ</td>
                                    <td><?php
//                                                                                throw new Exception(print_r($category2ToProduct->category1Id,true));
                                        if ($isChangeHome == 1) {
                                            echo CHtml::dropDownList("styleId", isset($model->orders[0]->orderItems[0]->styleId) ? $model->orders[0]->orderItems[0]->styleId : $cate2subCate->categoryId, ModelToCategory1::model()->findAllCatArrayFromBrandModelId($category2ToProduct->brandModelId), array(
                                                'prompt' => '-- เลือก Style --',
                                                'id' => 'styleId'
                                                ,
                                                'ajax' => array(
                                                    'type' => 'POST',
                                                    'data' => array(
                                                        'categoryId' => 'js:this.value',
                                                        'brandModelId' => 'js:$("#brandModelId").val()'),
                                                    'url' => $this->createUrl('/myfile/ginzaHome/findHouseModel'),
                                                    'success' => 'js:function(data){

										//$("#sameAddress").prop("disabled", true);
										$("#category1Id").html(data);
										//$("#billingAmphur").prop("disabled", false);
										//$("#billingDistrict").html("");
										//$("#billingDistrict").prop("disabled", true);
										 }')
                                            ));
                                        } else {
                                            echo CHtml::hiddenField("styleId", isset($model->orders[0]->orderItems[0]->styleId) ? $model->orders[0]->orderItems[0]->styleId : $cate2subCate->categoryId);
                                            echo CHtml::dropDownList("styleId", isset($model->orders[0]->orderItems[0]->styleId) ? $model->orders[0]->orderItems[0]->styleId : $cate2subCate->categoryId, ModelToCategory1::model()->findAllCatArrayFromBrandModelId($category2ToProduct->brandModelId), array(
                                                'prompt' => '-- เลือก Style --',
                                                'disabled' => 'true',
                                                'id' => 'styleId'
                                                ,
                                                'ajax' => array(
                                                    'type' => 'POST',
                                                    'data' => array(
                                                        'categoryId' => 'js:this.value',
                                                        'brandModelId' => 'js:$("#brandModelId").val()'),
                                                    'url' => $this->createUrl('/myfile/ginzaHome/findHouseModel'),
                                                    'success' => 'js:function(data){

										//$("#sameAddress").prop("disabled", true);
										$("#category1Id").html(data);
										//$("#billingAmphur").prop("disabled", false);
										//$("#billingDistrict").html("");
										//$("#billingDistrict").prop("disabled", true);
										 }')
                                            ));
                                        }
                                        ?></td>
                                </tr>
                                <tr>
                                    <td>แบบบ้าน</td>
                                    <td><?php
                                        //										if (isset($model->orders[0]->orderItems[0]->styleId))
                                        //throw new Exception(print_r($category2ToProduct->category1Id, true));
                                        if ($isChangeHome == 1) {
                                            echo CHtml::dropDownList("category1Id", $category2ToProduct->category1Id, CategoryToSub::model()->findSubCatArrayByBrandModelIdAndCategoryId($category2ToProduct->brandModelId, isset($model->orders[0]->orderItems[0]->styleId) ? $model->orders[0]->orderItems[0]->styleId : $cate2subCate->categoryId), array(
                                                'prompt' => '-- เลือกแบบบ้าน --',
                                                'ajax' => array(
                                                    'type' => 'POST',
                                                    'data' => array(
                                                        'category1Id' => 'js:this.value',
                                                        'brandModelId' => 'js:$("#brandModelId").val()'),
                                                    'url' => $this->createUrl('/myfile/ginzaHome/findHouseSeries'),
                                                    'success' => 'js:function(data){

										//$("#sameAddress").prop("disabled", true);
										$("#category2Id").html(data);
										//$("#billingAmphur").prop("disabled", false);
										//$("#billingDistrict").html("");
										//$("#billingDistrict").prop("disabled", true);
										 }')));
                                        } else {
                                            echo CHtml::hiddenField("category1Id", $category2ToProduct->category1Id);
                                            echo CHtml::dropDownList("category1Id", $category2ToProduct->category1Id, CategoryToSub::model()->findSubCatArrayByBrandModelIdAndCategoryId($category2ToProduct->brandModelId, isset($model->orders[0]->orderItems[0]->styleId) ? $model->orders[0]->orderItems[0]->styleId : $cate2subCate->categoryId), array(
                                                'prompt' => '-- เลือกแบบบ้าน --',
                                                'disabled' => 'true',
                                                'ajax' => array(
                                                    'type' => 'POST',
                                                    'data' => array(
                                                        'category1Id' => 'js:this.value',
                                                        'brandModelId' => 'js:$("#brandModelId").val()'),
                                                    'url' => $this->createUrl('/myfile/ginzaHome/findHouseSeries'),
                                                    'success' => 'js:function(data){

										//$("#sameAddress").prop("disabled", true);
										$("#category2Id").html(data);
										//$("#billingAmphur").prop("disabled", false);
										//$("#billingDistrict").html("");
										//$("#billingDistrict").prop("disabled", true);
										 }')));
                                        }
                                        ?></td>
                                </tr>
                                <tr>
                                    <td>ซีรีส์</td>
                                    <td>
                                        <?php
                                        if ($isChangeHome == 1) {
                                            echo CHtml::dropDownList("category2Id", $category2ToProduct->category2Id, CategoryToSub::model()->findSubCatArrayByBrandModelIdAndCategoryId($category2ToProduct->brandModelId, $category2ToProduct->category1Id), array(
                                                'prompt' => '-- เลือกแบบบ้าน --',
                                                'ajax' => array(
                                                    'type' => 'POST',
                                                    'data' => array(
                                                        'category2Id' => 'js:this.value',
                                                        'category1Id' => 'js:$("#category1Id").val()',
                                                        'brandModelId' => 'js:$("#brandModelId").val()'),
                                                    'url' => $this->createUrl('/myfile/ginzaHome/findHouseColor'),
                                                    'success' => 'js:function(data){

										//$("#sameAddress").prop("disabled", true);
										$("#productOptionId").html(data);
										//$("#billingAmphur").prop("disabled", false);
										//$("#billingDistrict").html("");
										//$("#billingDistrict").prop("disabled", true);
										 }')));
                                        } else {
                                            echo CHtml::hiddenField("category2Id", $category2ToProduct->category2Id);
                                            echo CHtml::dropDownList("category2Id", $category2ToProduct->category2Id, CategoryToSub::model()->findSubCatArrayByBrandModelIdAndCategoryId($category2ToProduct->brandModelId, $category2ToProduct->category1Id), array(
                                                'prompt' => '-- เลือกแบบบ้าน --',
                                                'disabled' => 'true',
                                                'ajax' => array(
                                                    'type' => 'POST',
                                                    'data' => array(
                                                        'category2Id' => 'js:this.value',
                                                        'category1Id' => 'js:$("#category1Id").val()',
                                                        'brandModelId' => 'js:$("#brandModelId").val()'),
                                                    'url' => $this->createUrl('/myfile/ginzaHome/findHouseColor'),
                                                    'success' => 'js:function(data){

										//$("#sameAddress").prop("disabled", true);
										$("#productOptionId").html(data);
										//$("#billingAmphur").prop("disabled", false);
										//$("#billingDistrict").html("");
										//$("#billingDistrict").prop("disabled", true);
										 }')));
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>สี</td>
                                    <td><?php
//                                                                                throw new Exception(print_r($model->orders[0]->orderItems[0],true));
                                        if ($isChangeHome == 1) {
//											throw new Exception(print_r($child1, true));
                                            echo CHtml::dropDownList("productOptionId", $model->orders[0]->orderItems[0]->productOptionId, CHtml::listData($model->orders[0]->orderItems[0]->product->productOptionGroups[0]->productOptions, "productOptionId", "title"), array(
                                                'prompt' => '-- เลือกสี --'));
                                        } else {
                                            if (isset($model->orders[0]->orderItems[0]->product->productOptionGroups[0]->productOptions))
                                                echo CHtml::dropDownList("productOptionId", $model->orders[0]->orderItems[0]->productOptionId, CHtml::listData($model->orders[0]->orderItems[0]->product->productOptionGroups[0]->productOptions, "productOptionId", "title"), array(
                                                    'prompt' => '-- เลือกสี --',
                                                    'disabled' => 'true'));
                                        }
                                        ?></td>
                                </tr>
                                <tr>
                                    <td>จังหวัด</td>
                                    <td><?php
                                        if ($isChangeHome == 1) {
                                            echo CHtml::dropDownList("provinceId", $model->shippingProvinceId, Province::model()->findAllProvinceArray(), array(
                                                'prompt' => '-- เลือกจังหวัด --'));
                                        } else {
                                            echo CHtml::dropDownList("provinceId", $model->shippingProvinceId, Province::model()->findAllProvinceArray(), array(
                                                'prompt' => '-- เลือกจังหวัด --',
                                                'disabled' => 'true'));
                                        }
                                        ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="row hide table table-bordered" id="period2" >
                            <thead>
                                <tr style="background-color: blue">
                                    <th>งวด</th>
                                    <th>รายการ</th>
                                    <th>ราคา</th>
                                    <th>ยอดชำระ</th>
                                </tr>
                            </thead>
                            <tbody>
                                        <?php
                                        echo CHtml::hiddenField("orderGroupId", $oldChild1->orderGroupId);
                                        echo CHtml::hiddenField("period", 2);
                                        foreach ($child1->orders as $item):
                                            ?>
                                    <tr style="color:black">
                                        <td  style="font-size:24px"><span style="margin-top:50px">งวดที่ 2</span></td>
                                        <td>
                                            <?php
                                            echo "<span style='font-size:24px'> " . $item->orderItems[0]->product->name . "</span> <br>" . $this->getOrderPeriodText(3);
                                            ?>
                                        </td>
                                        <td style="font-size:24px">
    <?php
    echo "ยอดชำระ " . number_format($child1->totalIncVAT);
    $sumSup = 0;
    //	throw new Exception(print_r($child1->supNotPays, true));
    if (count($child1->supPay) > 0):
        ?>
                                                <p style='color:green'>ชำระแล้ว</p>
                                                <?php
                                                foreach ($child1->supPay as $sup) {
                                                    $sumSup +=$sup->totalIncVAT;
                                                    echo "<p style='color:green'>" . number_format($sup->totalIncVAT, 2) . "</p>";
                                                }
                                            endif;
                                            $sumSupNotPay = 0;
                                            if (count($child1->supNotPays) > 0):
                                                ?>
                                                <p style='color:red'>รอยืนยันชำระ</p>
        <?php
        foreach ($child1->supNotPays as $supNotPay) {
            $sumSupNotPay +=$supNotPay->totalIncVAT;
            echo "<p style='color:red'>" . number_format($supNotPay->totalIncVAT, 2) . " " . CHtml::link("ยืนยัน", Yii::app()->createUrl("/myfile/order/view/id/" . $supNotPay->orderGroupId), array(
                'class' => 'btn btn-success',
                'target' => '_blank')) . "</p>";
        }
    endif;
    ?>
                                        </td>
                                        <td>
                                    <?php
                                    echo CHtml::numberField("payValue", $child1->totalIncVAT - $sumSup - $sumSupNotPay, array(
                                        'class' => 'input-form text-right',
                                        'style' => 'border:2px solid black;color:blue;font-size:24px;width:250px',
                                        'max' => $child1->totalIncVAT - $sumSup - $sumSupNotPay))
                                    ?>
                                            <!--<a onclick="backToStep2()" class="btn btn-success">Back</a>-->
                                            <?php
//											echo CHtml::link("ชำระเงิน", "", array(
//												'class'=>'btn btn-primary',
//												'onclick'=>"pay(2)"));
                                            ?>
                                        </td>
                                    </tr>
                                        <?php endforeach; ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            กรณีผู้สั่งซื้อ อนุมัติรายการทั้งหมดแล้ว ถือว่าผู้สั่งซื้อยอมรับเงื่อนไขที่เป็นไปตามรายละเอียดในสัญญาและถือเป็นการทำสัญญาซื้อขายกับบริษัทแล้ว
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center" style="font-weight: bold;color: black">
                            ข้าพเจ้าได้อ่านและทำความเข้าใจรายละเอียดตามข้อตกลงและเงื่อนไขข้างต้นดีแล้ว<br>
                                        <?php echo CHtml::radioButton("accept", TRUE) ?>
                            <label class="radio-label" for="accept">ยอมรับ</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row hide" id="submit2">
    <div class="col-lg-12 text-center">
        <a onclick="backToStep3()" class="btn btn-success">Back</a>
                                        <?php
                                        echo CHtml::link('ยอมรับ และ ชำระเงิน', "", array(
                                            'class' => 'btn btn-primary',
                                            'onClick' => 'goToStepSplit(2)'));
                                        ?>
    </div>
</div>
<div class="row hide" id="submit3">
    <div class="col-lg-12 text-center">
        <a onclick="backToStep3()" class="btn btn-success">Back</a>
                                        <?php
                                        echo CHtml::link('Accept', "", array(
                                            'class' => 'btn btn-primary',
                                            'onClick' => 'goToStepSplit(3)'));
                                        ?>
    </div>
</div>
<div class="row hide" id="submit4">
    <div class="col-lg-12 text-center">
        <a onclick="backToStep3()" class="btn btn-success">Back</a>
<?php
echo CHtml::link('Accept', "", array(
    'class' => 'btn btn-primary',
    'onClick' => 'goToStepSplit(4)'));
?>
    </div>
</div>