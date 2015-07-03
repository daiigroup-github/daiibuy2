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

                            <th style="width: 10%;text-align: center">พื้นที่จาก การประเมิณ</th>
                            <th>หน่วย</th>
                        <?php endif; ?>
                        <th>รหัส</th>
                        <th>รายละเอียดสินค้า</th>
                        <th>หน่วย</th>
                        <th>จำนวน/หน่วย</th>
                        <?php if ($this->action->id == "view" || $model->status == 1): ?>
                            <th style="width: 10%;text-align: center">ปริมาณจาก การประเมิณพื้นที่</th>
                            <th>ปริมาณแก้ไข</th>
                        <?php else: ?>
                            <th>ระบุจำนวน</th>
                        <?php endif; ?>
                        <th>ราคารวม</th>
                        <?php
                    else:
                        ?>
                        <th>Product Image</th>
                        <th>Code</th>
                        <th>Title/Category</th>
                        <th>Price</th>
                        <th>Quantiry</th>
                        <?php if ($this->action->id == "view"): ?>
                            <th>Summary</th>
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
                                <td>ตร.เมตร</td>
                                <td id="productCode<?php echo strtolower($item->groupName) ?>" class="text-info" id="productCode"><?php echo isset($item->product) ? $item->product->code : ""; ?></td>
                                <td id="productName<?php echo strtolower($item->groupName) ?>"><?php echo isset($item->product) ? $item->product->name : ""; ?></td>
                                <td id="productUnits<?php echo strtolower($item->groupName) ?>"><?php echo isset($item->product) ? $item->product->productUnits : ""; ?></td>
                                <?php
                                echo CHtml::hiddenField("OrderItems[" . $item->orderItemsId . "][price]", isset($item->product) ? $item->product->price : "", array(
                                    'id' => "priceHidden" . strtolower($item->groupName)));
                                ?>
                                <?php
                                echo CHtml::hiddenField("OrderItems[" . $item->orderItemsId . "][productId]", isset($item->product) ? $item->product->productId : "", array(
                                    'id' => "productId" . strtolower($item->groupName)));
                                ?>
                                <?php
                                $productArea = isset($item->product) ? ($item->product->width * $item->product->height) / 10000 : 0;
                                $estimateQuantity = $productArea * $item->area;
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
                                <td id="price<?php echo strtolower($item->groupName) ?>"><?php echo isset($item->product) ? number_format($item->quantity * $item->product->price) : 0 ?></td>
                            </tr>
                            <?php
                        else:
//                            throw new Exception(print_r($model->orderItems, true));
                            ?>
                            <tr>
                                <td><?php
//                                    throw new Exception(print_r($model->orderItems, true));
//                                    echo (isset($item->product->productImagesSort) && count($item->product->productImagesSort)) ? CHtml::image(Yii::app()->baseUrl . $item->product->productImagesSort[0]->image, "", array(
//                                                'style' => 'width:200px')) : "";
                                    ?></td>
                                <td><?php // echo $item->product->code;   ?></td>
                                <td><?php // echo $item->product->name;   ?></td>
                                <td style="color:red"><?php // echo number_format($item->product->price, 2);  ?>
                                    <?php // echo CHtml::hiddenField("Order[createMyfileType]", 3)   ?>
                                    <?php echo CHtml::hiddenField("OrderItems[$item->orderItemsId][productId]", "") ?>
                                    <?php
                                    echo CHtml::hiddenField("OrderItems[$item->orderItemsId][price]", "", array(
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
                                    <td id="total<?php echo $i; ?>"><?php // echo number_format($item->product->price * $item->quantity, 0)  ?></td>
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
                                <td style="text-align: center"><?php // echo $item->area;                                                                                                                       ?><?php // echo CHtml::hiddenField("supplierArea" . strtolower($k), $item->area);                                                                                                                       ?></td>
                                <td>ตร.เมตร</td>
                            <?php endif; ?>

                            <td id="productCode<?php echo strtolower($k) ?>" class="text-info" id="productCode"><?php // echo $item->product->code;                                                                                                                        ?></td>
                            <td id="productName<?php echo strtolower($k) ?>"><?php // echo $item->product->name;                                                                                                                      ?></td>
                            <td id="productUnits<?php echo strtolower($k) ?>"><?php // echo $item->product->productUnits;                                                                                                                  ?></td>
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
                                <?php // echo $productArea;              ?>
                            </td>
                            <?php if ($this->action->id == "view" || $model->status == 1): ?>
                                <td style="text-align: center" id="estimateAreaQuantity<?php echo strtolower($k) ?>"><?php // echo $estimateQuantity                                                                                                               ?></td>
                            <?php endif; ?>
                            <td id="quantity<?php echo strtolower($k) ?>"><?php
                                echo CHtml::numberField("OrderItems[" . $k . "][quantity]", "", array(
                                    'min' => 0,
                                    //													'class'=>'hide',
                                    'id' => 'quantityText_' . strtolower($k)));
                                ?></td>
                            <td id="price<?php echo strtolower($k) ?>"><?php // echo number_format($item->quantity * $item->product->price)                                                                                                                   ?></td>
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