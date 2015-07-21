<h3>ตารางประเมินราคา <?php echo $model->title; ?></h3>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <?php
                    if ($model->isTheme == 1):
//                        throw new Exception(print_r("GGG", true));
                        ?>
                        <th>ลำดับ</th>
                        <th>รายละเอียดรายการที่ชอบ</th>
                        <?php if ($this->action->id == "view" || $model->status == 1): ?>

                        <th style="width: 10%;text-align: center">พื้นที่จาก การประเมิณ(ตร.ม.)</th>
                            <?php endif; ?>
                        <th>รหัส</th>
                        <th>รายละเอียดสินค้า</th>
                        <th>หน่วย</th>
                        <th>พื้นที่/หน่วย</th>
                        <?php if ($this->action->id == "view" || $model->status == 1): ?>
                            <th style="width: 10%;text-align: center">ปริมาณจากการประเมิณพื้นที่</th>
                            <th>ปริมาณแก้ไข</th>
                        <?php else: ?>
                                            <th>ระบุจำนวน(กล่อง)</th>
                                <?php endif; ?>
                        <th>ราคารวม</th>
                        <?php
                    elseif (!isset($model->orderItems[0]->product)):
                        ?>
                        <th>ลำดำ</th>
                        <th>สินค้า</th>
                        <th>รูปภาพสินค้า</th>
                        <th>รหัสสินค้า</th>
                        <th>ชื่อสินค้า</th>
                        <th>พื้นที่จากการ<br>ประเมิณ(ตร.ม.)</th>
                                <th>ราคา(บาท)/กล่อง</th>
                            <th>จำนวน(กล่อง)</th>
                                <th>ราคารวม(บาท)</th>
                            <?php
                    else:
                        ?>
                            <th>ลำดำ</th>
                            <th>รูปภาพสินค้า</th>
                            <th>รหัสสินค้า</th>
                            <th>ชื่อสินค้า</th>
                                    <th>ราคา(บาท)/กล่อง</th>
                            <th>จำนวน(กล่อง)จำนวน(กล่อง)</th>
                            <?php if ($this->action->id == "view"): ?>
                        <th>ราคารวม(บาท)</th>
                            <?php endif; ?>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;

                if (isset($model->orderItems) && count($model->orderItems) > 0) {
                    foreach ($model->orderItems as $item):
                        ?>
                        <?php
                        if ($model->isTheme == 1):
                            ?>
                            <tr id="orderItem<?php echo strtolower($item->groupName); ?>">
                                <td><?php echo $i; ?></td>
                                <td style="text-align:center"><?php echo $item->groupName ?></td>
                                                        <td style="text-align: center"><?php echo $item->area; ?><?php echo CHtml::hiddenField("supplierArea" . strtolower($item->groupName), $item->area); ?></td>
                                            <td><?php echo isset($item->product) ? $item->product->code : ""; ?></td>
                                            <td id="productName<?php echo strtolower($item->groupName) ?>"><?php echo isset($item->product) ? $item->product->name : ""; ?></td>

                                            <td id="productUnits<?php echo strtolower($item->groupName) ?>"><?php echo isset($item->product) ? $item->product->productUnits : ""; ?></td>
                                <?php
                                echo CHtml::hiddenField("OrderItems[" . $item->orderItemsId . "][price]", isset($item->product) ? $item->product->calProductPromotionPrice(null, null) : "", array(
                                                            'id' => "priceHidden" . strtolower($item->groupName)));
                                ?>
                                <?php
                                echo CHtml::hiddenField("OrderItems[" . $item->orderItemsId . "][productId]", isset($item->product) ? $item->product->productId : "", array(
                                    'id' => "productId" . strtolower($item->groupName)));
                                ?>
                                <?php
                                $productArea = isset($item->product->area) ? ($item->product->width * $item->product->height) / 10000 : 0;
                                $estimateQuantity = $productArea == 0 ? 0 : ceil($item->area / $productArea);
            ?>

                                <td  style="text-align: center" id="productArea<?php echo strtolower($item->groupName) ?>">
                                    <?php echo $productArea; ?>
                                </td>
                                <td style="text-align: center" id="estimateAreaQuantity<?php echo strtolower($item->groupName) ?>"><?php echo $estimateQuantity ?></td>
                                <td id="quantity<?php echo strtolower($item->groupName) ?>"><?php
                                    echo CHtml::numberField("OrderItems[" . $item->orderItemsId . "][quantity]", $item->quantity, array(
                                        'min' => 0,
                                        //													'class'=>'hide',
                                        'id' => 'quantityText_' . strtolower($item->groupName)));
                                    ?></td>
                                <td id="price<?php echo strtolower($item->groupName) ?>"><?php echo isset($item->product) ? number_format($item->quantity * $item->product->calProductPromotionPrice(null, null), 2) : 0 ?></td>
                                        </tr>
                            <?php
                        elseif (!isset($model->orderItems[0]->product)):

                            //Estimate from backend
                            $orderDetailModel = OrderDetail::model()->find('orderId = ' . $model->orderId);
                            if (isset($orderDetailValueModel))
                                $orderDetailValueModel = OrderDetailValue::model()->find('orderDetailId = ' . $orderDetailModel->orderDetailId . ' and orderDetailTemplateFieldId = 9');
                            $productArray = Product::model()->findAllTileArray();


//                            throw new Exception(print_r($productArray, true));
                            ?>
                            <tr>
                                <td id="<?php echo $item->orderItemsId; ?>" name="<?php echo $item->orderItemsId; ?>"><?php echo $i; ?> </td>
                                <td><?php
                                    echo CHtml::dropDownList('OrderItems[' . $item->orderItemsId . '][productId]', "productId", $productArray, array(
                                        'prompt' => '---เลือกกระเบื้อง---',
                                        'onchange' => 'select(this);',
//										'id'=>'type',
                                    ));
//                                    throw new Exception(print_r($model->orderItems, true));
//                                    echo (isset($item->product->productImagesSort) && count($item->product->productImagesSort)) ? CHtml::image(Yii::app()->baseUrl . $item->product->productImagesSort[0]->image, "", array(
//                                                'style' => 'width:200px')) : "";
                                    ?></td>
                                <td id="productPic<?php echo $item->orderItemsId; ?>"><?php echo "####"; ?></td>
                                <td id="productCode<?php echo $item->orderItemsId; ?>"><?php echo "####"; ?></td>
                                <td id="productName<?php echo $item->orderItemsId; ?>"><?php echo "####"; ?></td>
                                <td id="productArea<?php echo $item->orderItemsId; ?>"><?php echo $item->area; ?></td>
                                                        <td id="productPrice<?php echo $item->orderItemsId; ?>" style="color:red; width: 5%">0.00<?php // echo number_format($item->product->calProductPromotionPrice(null, null), 2);                                                                                                                                                     ?>
                                                <?php // echo CHtml::hiddenField("Order[createMyfileType]", 3)   ?>
                                    <?php // echo CHtml::hiddenField("OrderItems[$item->orderItemsId][productId]", "") ?>
                                            </td>
                                                        <?php
                                                        echo CHtml::hiddenField("OrderItems[$item->orderItemsId][price]", "", array(
                                                            'id' => 'priceHidden_' . $item->orderItemsId));
                                                        ?>
                                                        <td style="width: 1%">
                                    <div class="row"><div class="col-md-12"><?php
                                            echo CHtml::numberField("OrderItems[" . $item->orderItemsId . "][quantity]", isset($item->quantity) ? $item->quantity : 1, array(
                                                "id" => "quantityText_" . $item->orderItemsId))
                                            ?></div></div>
                                </td>
                                <?php if ($this->action->id == "view"): ?>
                                <td style="color:red; width: 5%" id="total<?php echo $item->orderItemsId; ?>">0.00<?php // echo number_format($item->product->calProductPromotionPrice(null, null) * $item->quantity, 0)                                                                                                                                                      ?></td>
                                            <?php endif; ?>
                            </tr>
                            <?php
                        else:
//                            throw new Exception(print_r($model->orderItems, true));
                            ?>
                                         <tr>
                                             <td><?php echo $i; ?></td>
                                                         <td><?php
                                    echo CHtml::image(Yii::app()->baseUrl . isset($item->product->productImages[0]) ? $item->product->productImages[0]->image : "");
                                                                         ?></td>
                                <td><?php echo $item->product->code;                                                                                                                                                       ?></td>
                                <td><?php echo $item->product->name;                                                                                                                                                       ?></td>
                                                        <td style="color:red"><?php echo number_format($item->product->calProductPromotionPrice(null, null), 2); ?>
                                                <?php // echo CHtml::hiddenField("Order[createMyfileType]", 3)   ?>
                                                <?php echo CHtml::hiddenField("OrderItems[$item->orderItemsId][productId]", $item->productId) ?>
                                                <?php
                                    echo CHtml::hiddenField("OrderItems[$item->orderItemsId][price]", $item->product->calProductPromotionPrice(null, null), array(
                                                    'id' => 'priceHidden_' . $i))
                                    ?>
                                </td>
                                <td style="width: 20%">
                                    <div class="row"><div class="col-md-12"><?php
                                            echo CHtml::numberField("OrderItems[" . $item->orderItemsId . "][quantity]", isset($item->quantity) ? $item->quantity : 1, array(
                                                "id" => "quantityText_" . $i))
                                            ?></div></div>
                                </td>
                                <?php if ($this->action->id == "view"): ?>
                                                                <td id="total<?php echo $i; ?>"><?php echo number_format($item->product->calProductPromotionPrice(null, null) * $item->quantity, 0); ?></td>
                                            <?php endif; ?>
                            </tr>
                        <?php endif; ?>
                        <?php
                        $i++;
                    endforeach;
                }
                else {
                    $productGroupName = array(
                        "a" => "a",
                        "b" => "b",
                        "c" => "c",
                        "d" => "d",
                        "e" => "e",
                        "f" => "f");
//					echo CHtml::hiddenField("Order[createMyfileType]", 1);
                    foreach ($productGroupName as $k => $v):
                        ?>
                        <tr id="orderItem<?php echo strtolower($k); ?>">
                            <td><?php echo $i; ?></td>
                            <td style="text-align:center"><?php echo $k ?></td>
                            <?php if ($this->action->id == "view" || $model->status == 1): ?>
                                <td style="text-align: center"><?php // echo $item->area;                                                                                                                                                                                                                                                                           ?><?php // echo CHtml::hiddenField("supplierArea" . strtolower($k), $item->area);                                                                                                                                                                                                                                                                           ?></td>
                                <td>ตร.เมตร</td>
                            <?php endif; ?>

                            <td id="productCode<?php echo strtolower($k) ?>" class="text-info" id="productCode"><?php // echo $item->product->code;                                                                                                                                                                                                                                                                            ?></td>
                            <td id="productName<?php echo strtolower($k) ?>"><?php // echo $item->product->name;                                                                                                                                                                                                                                                                          ?></td>
                            <td id="productUnits<?php echo strtolower($k) ?>"><?php // echo $item->product->productUnits;                                                                                                                                                                                                                                                                     ?></td>
                            <?php
                            echo CHtml::hiddenField("OrderItems[" . $k . "][price]" . strtolower($k), "", array(
                                'id' => "priceHidden" . strtolower($k)));
                            ?>
                            <?php
                            echo CHtml::hiddenField("OrderItems[" . $k . "][productId]" . strtolower($k), "", array(
                                'id' => "productId" . strtolower($k)));
                            echo CHtml::hiddenField("OrderItems[" . $k . "][groupName]" . strtolower($k), strtolower($k), array(
                                'id' => "groupName" . strtolower($k)));
                            ?>
                            <?php
//												$productArea = ($item->product->width * $item->product->height) / 10000;
//												$estimateQuantity = $productArea * $item->area;
                            ?>

                            <td  style="text-align: center" id="productArea<?php echo strtolower($k) ?>">
                                <?php // echo $productArea;               ?>
                            </td>
                            <?php if ($this->action->id == "view" || $model->status == 1): ?>
                                <td style="text-align: center" id="estimateAreaQuantity<?php echo strtolower($k) ?>"><?php // echo $estimateQuantity                                                                                                                                                                                                                                                                  ?></td>
                            <?php endif; ?>
                            <td id="quantity<?php echo strtolower($k) ?>"><?php
                                echo CHtml::numberField("OrderItems[" . $k . "][quantity]", "", array(
                                    'min' => 0,
                                    //													'class'=>'hide',
                                    'id' => 'quantityText_' . strtolower($k)));
                                ?></td>
                                            <td id="price<?php echo strtolower($k) ?>"><?php // echo number_format($item->quantity * $item->product->calProductPromotionPrice(null, null))                                                                                                                                                                                                                                                                        ?></td>
                                </tr>
                        <?php
                        $i++;
                    endforeach;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>

    function moneyFormat(num) {
        var p = num.toFixed(2).split(".");
        return p[0].split("").reverse().reduce(function (acc, num, i, orig) {
            return  num + (i && !(i % 3) ? "," : "") + acc;
        }, "") + "." + p[1];
    }
    function select(sel)
    {

        var attrName = sel.attributes['name'].value;
        var orderItemId = attrName.substr(11, 4);
        var obj = $('select[name=\"' + attrName + '\"]');
        var productId = obj.val();
        var id = '#' + orderItemId;
//        alert(orderItemId);
        var category1Id = $(id).attr('name');
        $.ajax({
            'url': '<?php echo CController::createUrl('madrid/findTileByProductId'); ?>',
//            'dataType': 'json',
            'dataType': 'JSON',
            'type': 'POST',
            'data': {'productId': productId, 'category1Id': category1Id},
            'success': function (data) {
//                alert(data);
//                obj.parent().parent().children('.size').children('select').html(data);
//				findProductByCat1(sel);
                $("#productCode" + orderItemId).html(data[productId]["productCode"]);
                $("#productName" + orderItemId).html(data[productId]["name"]);
                $("#productUnits" + orderItemId).html(data[productId]["productUnits"]);
//                data[productId]["productArea"] = $("#productArea" + category1Id).val();
//                var estimateQuantity = data[productId]["productArea"] * $("#supplierArea" + category1Id).val();
//                $("#estimateAreaQuantity" + category1Id).html(estimateQuantity);
//					$("#quantityText_" + groupName).removeClass("hide");
//                                                alert(estimateQuantity);
//                if (estimateQuantity) {
//                    $("#quantityText_" + category1Id).val(estimateQuantity);
//                } else {
//                    $("#quantityText_" + category1Id).val(1);
//                }
                var areaId = "#productArea" + orderItemId;
                var estimateArea = $(areaId).html();
                var quantity = Math.ceil(parseFloat(estimateArea) / parseFloat(data[productId]["productArea"]));
//                alert(quantity);
                $("#quantityText_" + orderItemId).val(quantity);
                $("#productPrice" + orderItemId).html(data[productId]["price"]);
                $("#total" + orderItemId).html(moneyFormat(data[productId]["price"] * quantity));
                $("#productPic" + orderItemId).html(data[productId]["productImage"]);
                $("#priceHidden_" + orderItemId).val(data[productId]["price"]);
                $("#productId" + orderItemId).val(data[productId]["productId"]);
            },
        });
    }
</script>