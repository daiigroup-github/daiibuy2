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
                <?php endif; ?>
                <?php if (1 == 2): ?>
                    <tr>
                        <td><?php
                            echo (isset($item->product->productImagesSort) && count($item->product->productImagesSort)) ? CHtml::image(Yii::app()->baseUrl . $item->product->productImagesSort[0]->image, "", array(
                                        'style' => 'width:200px')) : "";
                            ?></td>
                        <td><?php echo $item->product->code; ?></td>
                        <td><?php echo $item->product->name; ?></td>
                        <td style="color:red"><?php echo number_format($item->product->price, 2); ?>
                            <?php // echo CHtml::hiddenField("Order[createMyfileType]", 3) ?>
                            <?php echo CHtml::hiddenField("OrderItems[$item->orderItemsId][productId]", $item->productId) ?>
                            <?php
                            echo CHtml::hiddenField("OrderItems[$item->orderItemsId][price]", $item->product->price, array(
                                'id' => 'priceHidden_' . $i))
                            ?>
                        </td>
                        <td style="width: 20%">
                            <div class="row"><div class="col-md-12"><?php
                                    echo CHtml::numberField("OrderItems[$item->orderItemsId][quantity]", $item->quantity, array(
                                        "id" => "quantityText_" . $i))
                                    ?></div></div>
                        </td>
                        <?php if ($this->action->id == "view"): ?>
                            <td id="total<?php echo $i; ?>"><?php echo number_format($item->product->price * $item->quantity, 0) ?></td>
                        <?php endif; ?>
                    </tr>
                <?php endif; ?>
                <?php
                if (1 == 1) {
//                    echo CHtml::hiddenField("Order[createMyfileType]", 3);
                    ?>
                    <tr id="orderItem">
                        <td><?php echo $i; ?></td>
                        <td id="productName"></td>
                        <?php if ($this->action->id == "view" || $model->status == 1): ?>
                            <td style="text-align: center"><?php // echo $item->area;                                                                                                                                                                       ?><?php // echo CHtml::hiddenField("supplierArea" . strtolower($k), $item->area);                                                                                                                                                                       ?></td>
                            <td>ตร.เมตร</td>
                        <?php endif; ?>

                        <td id="productCode" class="text-info" ><?php // echo $item->product->code;                                                                                                                                                                           ?></td>
                        <td id="productUnits"><?php // echo $item->product->name;                                                                                                                                                                        ?></td>
                        <td id="noPerBox"><?php // echo $item->product->productUnits;                                                                                                                                                                      ?></td>
                        <?php
                        echo CHtml::hiddenField("OrderItems[price]", "", array(
                            'id' => "priceHidden"));
                        ?>
                        <?php
                        echo CHtml::hiddenField("OrderItems[productId]", "", array(
                            'id' => "productId"));
                        echo CHtml::hiddenField("OrderItems[groupName]", "", array(
                            'id' => "groupName"));
                        ?>
                        <?php
//												$productArea = ($item->product->width * $item->product->height) / 10000;
//												$estimateQuantity = $productArea * $item->area;
                        ?>

                        <td  style="text-align: center" id="productArea">
                            <?php // echo $productArea;             ?>
                        </td>
                        <td>ตร.เมตร</td>
                        <?php if ($this->action->id == "view" || $model->status == 1): ?>
                            <td style="text-align: center" id="estimateAreaQuantity"><?php // echo $estimateQuantity                                                                                                                                                                 ?></td>
                        <?php endif; ?>
    <!--<td></td>-->
                        <td id="quantity"><?php
                            echo CHtml::numberField("OrderItems[quantity]", "3", array(
                                'min' => 1,
                                //													'class'=>'hide',
                                'id' => 'quantityText'));
                            ?></td>
                        <td id="price"><?php // echo number_format($item->quantity * $item->product->price)                                                                                                                                                                    ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>

        <?php
        $this->widget('ext.jqrelcopy.JQRelcopy', array(
            //the id of the 'Copy' link in the view, see below.
            'id' => 'copyItemTiles',
            //add a icon image tag instead of the text
            //leave empty to disable removing
            'removeText' => '<i class="fa fa-remove"></i>',
            //htmlOptions of the remove link
            'removeHtmlOptions' => array(
//		'style'=>'color:red',
                'class' => 'btn btn-danger'
            ),
            //options of the plugin, see http://www.andresvidal.com/labs/relcopy.html
            'options' => array(
                //A class to attach to each copy
                'copyClass' => 'newCopy',
                // The number of allowed copies. Default: 0 is unlimited
                'limit' => 0,
                //Option to clear each copies text input fields or textarea
                'clearInputs' => true,
                //A jQuery selector used to exclude an element and its children
                'excludeSelector' => '.skipcopy',
            //Additional HTML to attach at the end of each copy.
//		'append'=>CHtml::tag('span', array(
//			'class'=>'hint'
//			), 'You can remove this line'),
            ),
            'jsAfterNewId' => "
		if(typeof this.attr('name') !== 'undefined'){ this.attr('name', this.attr('name').replace('[0]', '['+counter+']'));}

		",
        ));
        ?>
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
                        <tr class="copyRow" id="copyRowTile">
                            <td><?php
                                echo CHtml::dropDownList("OrderItems[0][brandId]", "", Brand::model()->getAllBrandBySupplierId(3), array(
                                    'prompt' => 'Select Brand',
                                    'class' => 'form-control',
                                    'onchange' => "findModel(this,'" . Yii::app()->baseUrl . "');",
                                    'id' => 'brandId',
                                ));
                                ?></td>
                            <td class="model"><?php
                                echo CHtml::dropDownList('OrderItems[0][brandModelId]', '', array(
                                        ), array(
                                    'prompt' => 'Select Model',
                                    'class' => 'form-control',
                                    'onchange' => "findCat1(this,'" . Yii::app()->baseUrl . "');",
                                    'id' => 'brandModelId',
                                ));
                                ?></td>
                            <td class="cat1"><?php
                                echo CHtml::dropDownList('OrderItems[0][category1Id]', '', array(
                                        ), array(
                                    'prompt' => 'Select Cat1',
                                    'class' => 'form-control',
                                    'onchange' => "findCat2Product(this,'" . Yii::app()->baseUrl . "');",
                                    'id' => 'category1Id',
                                ));
                                ?></td>
                            <td class="product"><?php
                                echo CHtml::dropDownList('OrderItems[0][productId]', '', array(
                                        ), array(
                                    'prompt' => 'Select Product',
                                    'class' => 'form-control',
                                    'id' => 'productId',
                                    'onchange' => "chooseProduct(this,'" . Yii::app()->baseUrl . "');",
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
                            <td colspan="6"><a id="copyItemTiles" href="#" rel=".copyRowTile" class="button green"><i class="fa fa-plus"></i>เพิ่ม</a></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <img src="" id="image" class="col-md-12" />
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12" ><h3 id="name"></h3></div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="code"></div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="description"></div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="pprice"></div>
                </div>
            </div>
        </div>
    </div>
</div>