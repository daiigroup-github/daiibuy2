<?php ?>
<div id="result_content" class="content-result">
    <div class="row" >
        <div class="col-xs-12">
            <form id="editTableForm">
                <table id="editTable" style="background-color: #DDD" class="table table-hover edit-table" name="<?php echo $productResult['categoryId']; ?>">
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
                            <tr id="<?php echo $item->productId; ?>">
                                <td><?php echo $item->code; ?></td>
                                <td><?php echo $item->name; ?></td>
                                <td><?php echo $item->productUnits; ?></td>
                                <td><?php echo CHtml::textField('productItems[' . $item->productId . '][quantity]', $item->quantity, array('class' => 'edit-table-qty-input')); ?></td>
                                <td><?php echo FenzerController::formatMoney($item->price / intval($item->quantity), true); ?></td>
                                <td><?php echo FenzerController::formatMoney($item->price, true); ?></td>
                                <td><?php echo FenzerController::formatMoney(($item->price / $item->quantity) / 3, true); ?></td>
    <!--                                <td><button id="deleteRow" class="btn btn-danger">remove</button></td>-->
                                <td><a  class="btn btn-danger" onclick="removeRow(<?php echo $item->productId; ?>)">remove</a></td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
                <script>
                    function removeRow(code)
                    {
                        if (confirm('ยืนยันเพื่อลบรายการสินค้านี้?')) {
                            $("#" + code).remove();
                        }
                    }
                </script>
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
                echo Select2::dropDownList('productId', 'selectedCode', CHtml::listData(Product::model()->findAll('supplierId = 1 and status = 2'), 'productId', function($model) {
                    return $model->code . " " . $model->name;
                }), array('class' => 'form-control',
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
                'id' => 'addNewItemFenzer',
//				'ajax'=>array(
//				'type'=>'POST',
//				'url'=>CController::createUrl('fenzer/addNewProductItem'),
//				'dataType'=>'html',
//				'data'=>'js:$("#addItem").serialize()+ "&" + $("#ggg").serialize()',
//				'success'=>'js:function(data){
//						$("#editTable").append(data);
//				}',
//				),
            ));
            ?>
        </div>
    </div>
</div>