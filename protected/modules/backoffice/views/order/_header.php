<div class="form-group" >
    <div class="col-xs-2" style="text-align: center;height: 120px;">
        <?php
        if (isset(Yii::app()->user->id)) {
            $user = User::model()->findByPk(Yii::app()->user->id);
        }
        if (isset(Yii::app()->user->id)) {
            if (isset($supplier->logoDoc) && !empty($supplier->logoDoc)) {
                echo CHtml::image(Yii::app()->baseUrl . $supplier->logoDoc, '', array(
                    'style' => 'width:100px;'));
            } else {
                echo CHtml::image(Yii::app()->baseUrl . "/images/NoLogo.png", '', array(
                    'style' => 'width:120px;'));
            }
        }
        ?>
    </div>
    <div class="col-xs-6" style="text-align: center;height: 120px;border: 1px #dddddd solid">
        <?php
//		if(isset(Yii::app()->user->id))
//		{
//			if(($model->status < 4 && ($user->type != 2 && $user->type != 3)) && !isset($supplier->redirectURL))
//			{
//
        ?>
        <br>
        <?php
//				if(isset($daiiAddr))
//				{
//					echo $daiiAddr->description;
//				}
//			}
//			else
//			{
        echo getOrderSupplierBillingAddress($model);
//			}
//		}
//		else
//		{
//			if(isset($daiiAddr))
//			{
//				echo $daiiAddr->description;
//			}
//		}
        ?>
    </div>
    <div class="col-xs-4" style="text-align: center;height: 120px;border: 1px #dddddd solid">
        <?php // throw new Exception(print_r($model->status.", ".$user->type.", ".Yii::app()->controller->action->id,true)); ?>
        <h5 style="margin-top: 43px;"><?php echo (Yii::app()->controller->action->id == "printProductList") ? "ใบรายการสินค้า" : ((Yii::app()->controller->action->id == "viewOrder" && ($user->type == 3 || $user->type == 7)) ? "ใบสั่งซื้อสินค้า" : ((($user->type == 1 || $user->type == 2) && $model->status > 2) ? "ใบเสร็จรับเงิน/<br>ใบกำกับภาษี" : (($model->status == 3 && ($user->type == 3 || $user->type == 7)) ? "ใบส่งสินค้า" : $pageText[$model->status]['pageTitle']))); ?></h5>
    </div>
</div>
<div class="form-group" >
        <?php
        $numberOfTax = Configuration::model()->getTaxNumber();
        if (isset($user)) {
            if ($model->status != 3 && ($user->type != 4 || $user->type != 2 )) {
                ?>
            <div class="col-xs-6 table-condensed" ><h5 style='margin-left: 10px;'>เลขประจำตัวผู้เสียภาษี : <?php echo $supplier->taxNumber; ?>
                </h5></div>
            <div class="col-xs-6 table-condensed" style="text-align: right" >
            <?php
            if (isset($user)) {
                if ($user->type == 5 || $user->type == 4) {
                    echo "<h5 style='margin-right: 10px;'>สำเนา</h5>";
                } else {
                    echo "<h5 style='margin-right: 10px;'>ต้นฉบับ</h5>";
                }
            } else {
                echo "<h5 style='margin-right: 10px;'>ต้นฉบับ</h5>";
            }
            ?>
            </div>
                <?php
            } else {
                ?>
            <div class="col-xs-6 table-condensed" ><h5 style='margin-left: 10px;'>เลขประจำตัวผู้เสียภาษี : <?php echo $supplier->taxNumber; ?>
                </h5></div>
            <div class="col-xs-6 table-condensed" style="text-align: right" >
                <?php
                if (isset($user)) {
                    if ($user->type == 5 || $user->type == 4) {
                        echo "<h5 style='margin-right: 10px;'>สำเนา</h5>";
                    } else {
                        echo "<h5 style='margin-right: 10px;'>ต้นฉบับ</h5>";
                    }
                } else {
                    echo "<h5 style='margin-right: 10px;'>ต้นฉบับ</h5>";
                }
                ?>
            </div>
        <?php
    }
} else {
    ?>
        <div class="col-xs-6 table-condensed" ><h5 style='margin-left: 10px;'>เลขประจำตัวผู้เสียภาษี : <?php echo $numberOfTax; ?>
            </h5></div>
        <div class="col-xs-6 table-condensed" style="text-align: right;font-size:small" >
            <?php
            if (isset($user)) {
                if ($user->type == 5 || $user->type == 4) {
                    echo "<h5 style='margin-right: 10px;'>สำเนา</h5>";
                } else {
                    echo "<h5 style='margin-right: 10px;'>ต้นฉบับ</h5>";
                }
            } else {
                echo "<h5 style='margin-right: 10px;'>ต้นฉบับ</h5>";
            }
            ?>
        </div>
        <?php } ?>


</div>