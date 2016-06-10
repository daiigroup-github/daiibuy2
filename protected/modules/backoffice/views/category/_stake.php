<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'category-form',
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
<div class="span10 offset1 alert alert-info">
    <div class="form-group">
        <div class="control-label col-lg-3">เลือก Template :</div>
        <div class="col-lg-9">
            <?php
            echo Select2::dropDownList("categoryId", "categoryId", chtml::listData(Category::model()->findAllCategoryStakeProvinceTemplateArray(), "categoryId", "TextName"), array(
                'prompt' => ' -- เลือกต้นแบบบ้าน --',
                'id' => 'categoryId',
                'style' => 'max-width:400px;
	min-width:300px',
                'select2Options' => array(
                    'maximumSelectionSize' => 1,),));
            ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-12">
            <?php
            echo CHtml::button("Replace", array(
                'class' => 'btn btn-success btn-xs col-lg-offset-3',
                'onclick' => 'replaceStakeByCategoryId()'))
            ?>
        </div>
    </div>
</div>

<div class="col-lg-12" id="stake_table">
    <table class="table table-bordered table-hover">
        <thead>
            <tr class="alert alert-warning">
                <th>จังหวัด</th>
                <th>รายละเอียดเสาเข็ม</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($provinces as $province):
                $stake = CategoryStakeProvince::model()->find("categoryId = $categoryId AND provinceId = $province->provinceId");
                ?>
                <tr>
                    <td><?php
                        echo isset($province->provinceName) ? $province->provinceName : "";
                        ?>
                    </td>
                    <td><?php
                        echo CHtml::textField("CategoryStakeProvince[$province->provinceId][stake]", isset($stake) ? $stake->stake : "", array(
                            'class' => 'col-lg-12'))
                        ?></td>
                </tr>
                <?php
            endforeach;
            ?>
        </tbody>
    </table>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-9">
        <?php
        echo CHtml::submitButton('บันทึก', array(
            'class' => 'btn btn-primary'));
        echo CHtml::submitButton('บันทึก และ กลับไปที่ Series', array(
            'class' => 'btn btn-success',
            'name' => 'saveAndBack'));
        ?>
    </div>
</div>
<?php $this->endWidget(); ?>

<script>
    function replaceStakeByCategoryId()
    {

//					alert($("#categoryId").val());s
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: '<?php echo Yii::app()->createUrl("backoffice/category/replaceStakeByCategoryId"); ?>',
            beforeSend: function () {
                if ($("#categoryId").val() == "")
                {
                    alert("Please Choose Category");
                    return false;
                }
//							alert($("#furnitureGroupId").val());
            },
            data: {categoryId: $("#categoryId").val()},
            success: function (data) {
                if (data.status)
                {

                    $("#stake_table").html(data.stakeReplace);
                    alert("โหลดข้อมูลเสาจากบ้านต้นแบบเรียบร้อย!!!");
                } else
                {
                    alert("ไม่สามารถดึงข้อมูลเสาจากบ้านต้นแบบได้");
                }
            }
        });
    }
</script>