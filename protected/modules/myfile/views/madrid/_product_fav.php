<h3>ตารางประเมินราคา <?php echo $model->title; ?></h3>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-hover">
            <thead>
                <tr class="text-center">
                    <th rowspan="2" style="text-align:center">ลำดับ</th>
                    <th rowspan="2" style="text-align:center">รายละเอียดสินค้า</th>
                    <?php // if($this->action->id == "view" || $model->status == 1): ?>

<!--						<th style="width: 10%;text-align: center">พื้นที่จาก การประเมิณ</th>
                                                <th>หน่วย</th>-->
                    <?php // endif; ?>
                    <th rowspan="2" style="text-align:center">รหัส</th>
                    <th rowspan="2" style="text-align:center">หน่วย</th>
                    <th rowspan="2" style="text-align:center">จำนวน/หน่วย</th>
                    <th colspan="2" style="text-align:center">ขนาดพื้นที่</th>
                    <?php if ($this->action->id == "view" || $model->status == 1): ?>
                        <th rowspan="2" style="width: 10%;text-align: center">ปริมาณจาก การประเมิณพื้นที่</th>
                        <th rowspan="2" style="text-align:center">ปริมาณแก้ไข</th>
                    <?php else: ?>
                        <th rowspan="2" style="text-align:center">ระบุจำนวน</th>
                    <?php endif; ?>
                    <th rowspan="2" style="text-align:center">ราคารวม</th>
                </tr>
                <tr>
                    <th rowspan="2"  style="text-align:center">พื้นที่</th>
                    <th rowspan="2"  style="text-align:center">หน่วย</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                if (1 == 2):
                    ?>
                    <tr id="orderItem">
                        <td><?php echo $i; ?></td>
                        <td style="text-align:center"></td>
                        <td style="text-align: center"><?php echo $model->area; ?><?php echo CHtml::hiddenField("supplierArea" . strtolower($model->groupName), $model->area); ?></td>
                        <td>ตร.เมตร</td>
                        <td id="productCode<?php echo strtolower($model->groupName) ?>" class="text-info" id="productCode"><?php echo isset($model->product) ? $model->product->code : ""; ?></td>
                        <td id="productName<?php echo strtolower($model->groupName) ?>"><?php echo isset($model->product) ? $model->product->name : ""; ?></td>
                        <td id="productUnits<?php echo strtolower($model->groupName) ?>"><?php echo isset($model->product) ? $model->product->productUnits : ""; ?></td>
                        <?php
                        echo CHtml::hiddenField("OrderItems[" . $model->orderItemsId . "][price]", isset($model->product) ? $model->product->price : "", array(
                            'id' => "priceHidden" . strtolower($model->groupName)));
                        ?>
                        <?php
                        echo CHtml::hiddenField("OrderItems[" . $model->orderItemsId . "][productId]", isset($model->product) ? $model->product->productId : "", array(
                            'id' => "productId" . strtolower($model->groupName)));
                        ?>
                        <?php
                        $productArea = isset($model->product) ? ($model->product->width * $model->product->height) / 10000 : 0;
                        $estimateQuantity = $productArea * $model->area;
                        ?>

                        <td  style="text-align: center" id="productArea<?php echo strtolower($model->groupName) ?>">
                            <?php echo $productArea; ?>
                        </td>
                        <td style="text-align: center" id="estimateAreaQuantity<?php echo strtolower($model->groupName) ?>"><?php echo $estimateQuantity ?></td>
                        <td id="quantity<?php echo strtolower($model->groupName) ?>"><?php
                            echo CHtml::numberField("OrderItems[" . $model->orderItemsId . "][quantity]", $model->quantity, array(
                                'min' => 0,
                                //													'class'=>'hide',
                                'id' => 'quantityText_' . strtolower($model->groupName)));
                            ?></td>
                        <td id="price<?php echo strtolower($model->groupName) ?>"><?php echo isset($model->product) ? number_format($model->quantity * $model->product->price) : 0 ?></td>
                    </tr>
                <?php endif; ?>
                <?php if (1 == 2): ?>
                    <tr>
                        <td><?php
                            echo (isset($model->product->productImagesSort) && count($model->product->productImagesSort)) ? CHtml::image(Yii::app()->baseUrl . $model->product->productImagesSort[0]->image, "", array(
                                        'style' => 'width:200px')) : "";
                            ?></td>
                        <td><?php echo $model->product->code; ?></td>
                        <td><?php echo $model->product->name; ?></td>
                        <td style="color:red"><?php echo number_format($model->product->price, 2); ?>
                            <?php // echo CHtml::hiddenField("Order[createMyfileType]", 3) ?>
                            <?php echo CHtml::hiddenField("OrderItems[$model->orderItemsId][productId]", $model->productId) ?>
                            <?php
                            echo CHtml::hiddenField("OrderItems[$model->orderItemsId][price]", $model->product->price, array(
                                'id' => 'priceHidden_' . $i))
                            ?>
                        </td>
                        <td style="width: 20%">
                            <div class="row"><div class="col-md-12"><?php
                                    echo CHtml::numberField("OrderItems[$model->orderItemsId][quantity]", $model->quantity, array(
                                        "id" => "quantityText_" . $i))
                                    ?></div></div>
                        </td>
                        <?php if ($this->action->id == "view"): ?>
                            <td id="total<?php echo $i; ?>"><?php echo number_format($model->product->price * $model->quantity, 0) ?></td>
                        <?php endif; ?>
                    </tr>
                <?php endif; ?>
                <?php
                if (1 == 1) {
//                    echo CHtml::hiddenField("Order[createMyfileType]", 3);



                    $productArea = isset($product) ? ($product->width * $product->height) / 10000 : 0;
                    $estimateQuantity = ($product->area == 0) ? 0 : $productArea * $product->area;
                    ?>
                    <tr id="orderItem">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $product->name; ?></td>
                        <?php if ($this->action->id == "view" || $model->status == 1): ?>
                            <td style="text-align: center"><?php // echo $model->area;                                                                                                                                                                                                                  ?><?php // echo CHtml::hiddenField("supplierArea" . strtolower($k), $model->area);                                                                                                                                                                                                                  ?></td>
                            <td>ตร.เมตร</td>
                        <?php endif; ?>

                        <td class="text-info" > <?php echo $product->code; ?></td>
                        <td id="productUnits"><?php echo $product->productUnits; ?></td>
                        <td id="noPerBox"><?php echo $product->noPerBox; ?></td>
                        <?php
                        echo CHtml::hiddenField("OrderItems[" . $product->productId . "][price]", isset($product->productPromotion->price) ? $product->productPromotion->price : $product->price );
                        ?>

                        <?php
                        echo CHtml::hiddenField("OrderItems[" . $product->productId . "][productId]", $product->productId);
                        ?>
                        <?php
//												$productArea = ($model->product->width * $model->product->height) / 10000;
//												$estimateQuantity = $productArea * $model->area;
                        ?>

                        <td  style="text-align: center">
                            <?php echo $product->area; ?>
                        </td>
                        <td>ตร.เมตร</td>
                        <?php if ($this->action->id == "view" || $model->status == 1): ?>
                            <td style="text-align: center" id="estimateAreaQuantity"><?php echo $estimateQuantity ?></td>
                        <?php endif; ?>
    <!--<td></td>-->
                        <td><?php
                            echo CHtml::numberField("OrderItems[" . $product->productId . "][quantity]", 1, array(
                                'min' => 1,
                                //													'class'=>'hide',
                                'id' => 'quantityText'));
                            ?></td>
                        <td id="price"><?php // echo number_format($model->quantity * $model->product->price)                                                                                                                                                                                                              ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <!--        <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Cat1</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Price/Unit</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="copyRow" id="copyRow">
                                    <td><?php
//                                echo CHtml::dropDownList("OrderItems[0][brandId]", "", Brand::model()->getAllBrandBySupplierId(3), array(
//                                    'prompt' => 'Select Brand',
//                                    'class' => 'form-control',
//                                    'onchange' => "findModelTile(this,'" . Yii::app()->baseUrl . "');",
//                                    'id' => 'brandId',
//                                ));
        ?></td>
                                    <td class="model"><?php
//                                echo CHtml::dropDownList('OrderItems[0][brandModelId]', '', array(
//                                        ), array(
//                                    'prompt' => 'Select Model',
//                                    'class' => 'form-control',
//                                    'onchange' => "findCat1(this,'" . Yii::app()->baseUrl . "');",
//                                    'id' => 'brandModelId',
//                                ));
        ?></td>
                                    <td class="cat1"><?php
//                                echo CHtml::dropDownList('OrderItems[0][category1Id]', '', array(
//                                        ), array(
//                                    'prompt' => 'Select Cat1',
//                                    'class' => 'form-control',
//                                    'onchange' => "findCat2Product(this,'" . Yii::app()->baseUrl . "');",
//                                    'id' => 'category1Id',
//                                ));
        ?></td>
                                    <td class="product"><?php
//                                echo CHtml::dropDownList('OrderItems[0][productId]', '', array(
//                                        ), array(
//                                    'prompt' => 'Select Product',
//                                    'class' => 'form-control',
//                                    'id' => 'productId',
//                                    'onchange' => "chooseProduct(this,'" . Yii::app()->baseUrl . "');",
//                                ));
        ?></td>
                                    <td><?php
//                                echo CHtml::numberField('OrderItems[0][quantity]  ', "", array(
//                                    'class' => 'form-control'))
        ?></td>
                                    <td class="unit"><span class="unitText skipCopy"></span></td>
                                    <td class="price"><span class="priceText skipCopy"></span></td>
                                    <td class="total"><span class="toalText skipCopy"></span></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6"><a id="copyItem" href="#" rel=".copyRow" class="button green"><i class="fa fa-plus"></i>เพิ่ม</a></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>-->

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Cat1</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Price/Unit</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="copyRow" id="copyRow">
                            <td><?php
                                echo CHtml::dropDownList("OrderItems[0][brandId]", "", Brand::model()->getAllBrandBySupplierId(3), array(
                                    'prompt' => 'Select Brand',
                                    'class' => 'form-control',
                                    'onchange' => "findModel (this, '" . Yii::app()->baseUrl . "');
                            ",
                                    'id' => 'brandId',
                                ));
                                ?></td>
                            <td class="model"><?php
                                echo CHtml::dropDownList('OrderItems[0][brandModelId]', '', array(
                                        ), array(
                                    'prompt' => 'Select Model',
                                    'class' => 'form-control',
                                    'onchange' => "findCat1 (this, '" . Yii::app()->baseUrl . "');
                            ",
                                    'id' => 'brandModelId',
                                ));
                                ?></td>
                            <td class="cat1"><?php
                                echo CHtml::dropDownList('OrderItems[0][category1Id]', '', array(
                                        ), array(
                                    'prompt' => 'Select Cat1',
                                    'class' => 'form-control',
                                    'onchange' => "findCat2Product (this, '" . Yii::app()->baseUrl . "');
                            ",
                                    'id' => 'category1Id',
                                ));
                                ?></td>
                            <td class="product"><?php
                                echo CHtml::dropDownList('OrderItems[0][productId]', '', array(
                                        ), array(
                                    'prompt' => 'Select Product',
                                    'class' => 'form-control',
                                    'id' => 'productId',
                                    'onchange' => "chooseProduct (this, '" . Yii::app()->baseUrl . "');
                            ",
                                ));
                                ?></td>
                            <td><?php
                                echo CHtml::numberField('OrderItems[0][quantity]  ', "", array(
                                    'class' => 'form-control'))
                                ?></td>
                            <td class="unit"><span class="unitText skipCopy"></span></td>
                            <td class="price"><span class="priceText skipCopy"></span></td>
                            <td class="total"><span class="toalText skipCopy"></span></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6"><a id="copyItem" href="#" rel=".copyRow" class="button green"><i class="fa fa-plus"></i>เพิ่ม</a></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>                
        <?php
        $result["status"] = TRUE;
        $result["productId"] = $product->productId;
        $result["code"] = $product->code;
        $result["image"] = isset($product->productImagesSort[0]) ? Yii::app()->baseUrl . $product->productImagesSort[0]->image : "";
        $result["name"] = $product->name;
        $result["description"] = $product->description;
        $result["width"] = $product->width;
        $result["height"] = $product->height;
        $result["productArea"] = isset($product->area) ? $product->area : "";
        $result["price"] = $product->price;
        $result["noPerBox"] = isset($product->noPerBox) ? $product->noPerBox : 12;
        $result["productUnits"] = $product->productUnits;
        ?>

        <div class="row">
            <div class="col-md-4">
                <img src="<?php echo isset($product->productImagesSort[0]) ? Yii::app()->baseUrl . $product->productImagesSort[0]->image : ""; ?>" id="image" class="col-md-12" />
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12" ><h3 id="name"><?php echo $product->name; ?></h3></div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="code"><?php echo $product->code; ?></div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="description"><?php echo $product->description; ?></div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="pprice"><?php echo isset($product->productPromotion->price) ? $product->productPromotion->price : $product->price; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>