<?php
/* @var $this OrderGroupController */
/* @var $model OrderGroup */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'order-group-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'class' => 'form-horizontal',
        //'enctype' => 'multipart/form-data',
        ),
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php
    echo $form->errorSummary($model, '', '', array(
        'class' => 'alert alert-danger'));
    ?>

    <div class="form-group">
        <?php
        echo $form->labelEx($model, 'orderNo', array(
            'class' => 'col-sm-2 control-label'));
        ?>
        <div class="col-sm-10">
            <?php
            echo $form->textField($model, 'orderNo', array(
                'size' => 45,
                'maxlength' => 45,
                'class' => 'form-control',
                'disabled' => true));
            ?>
            <?php echo $form->error($model, 'orderNo'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php
        echo $form->labelEx($model, 'invoiceNo', array(
            'class' => 'col-sm-2 control-label'));
        ?>
        <div class="col-sm-10">
            <?php
            echo $form->textField($model, 'invoiceNo', array(
                'size' => 20,
                'maxlength' => 20,
                'class' => 'form-control',
//				'disabled' => true
            ));
            ?>
            <?php echo $form->error($model, 'invoiceNo'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php
        echo $form->labelEx($model, 'paymentCompany', array(
            'class' => 'col-sm-2 control-label'));
        ?>
        <div class="col-sm-10">
            <?php
            echo $form->textField($model, 'paymentCompany', array(
                'size' => 60,
                'maxlength' => 200,
                'class' => 'form-control'));
            ?>
            <?php echo $form->error($model, 'paymentCompany'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php
        echo $form->labelEx($model, 'paymentFirstname', array(
            'class' => 'col-sm-2 control-label'));
        ?>
        <div class="col-sm-10">
            <?php
            echo $form->textField($model, 'paymentFirstname', array(
                'size' => 60,
                'maxlength' => 200,
                'class' => 'form-control'));
            ?>
            <?php echo $form->error($model, 'paymentFirstname'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php
        echo $form->labelEx($model, 'paymentLastname', array(
            'class' => 'col-sm-2 control-label'));
        ?>
        <div class="col-sm-10">
            <?php
            echo $form->textField($model, 'paymentLastname', array(
                'size' => 60,
                'maxlength' => 200,
                'class' => 'form-control'));
            ?>
            <?php echo $form->error($model, 'paymentLastname'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php
        echo $form->labelEx($model, 'paymentAddress1', array(
            'class' => 'col-sm-2 control-label'));
        ?>
        <div class="col-sm-10">
            <?php
            echo $form->textArea($model, 'paymentAddress1', array(
                'rows' => 6,
                'cols' => 50,
                'class' => 'form-control'));
            ?>
            <?php echo $form->error($model, 'paymentAddress1'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php
        echo $form->labelEx($model, 'paymentAddress2', array(
            'class' => 'col-sm-2 control-label'));
        ?>
        <div class="col-sm-10">
            <?php
            echo $form->textArea($model, 'paymentAddress2', array(
                'rows' => 6,
                'cols' => 50,
                'class' => 'form-control'));
            ?>
            <?php echo $form->error($model, 'paymentAddress2'); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">
            <p><?php echo $form->labelEx($model, 'paymentProvinceId'); ?></p>
        </div>
        <div class="col-sm-9">
            <?php
//					$province = Province::model()->findByPk($this->cookie->provinceId);
//					echo $province->provinceName;
            echo $form->dropDownList($model, 'paymentProvinceId', CHtml::listData(Province::model()->findAll(), 'provinceId', 'provinceName'), array(
                'id' => 'billingProvince',
                'name' => 'OrderGroup[provinceId]',
//						'disabled'=>'disabled'
//						));
                'prompt' => ' --- เลือกจังหวัด ---',
                'ajax' => array(
                    'type' => 'POST',
                    'data' => array(
                        'provinceId' => 'js:this.value'),
                    'url' => $this->createUrl('findAmphur'),
                    'success' => 'js:function(data){

//									if(chooseProvince == this.value)
										$("#sameAddress").prop("disabled", true);
                                    $("#billingAmphur").html(data);
                                    $("#billingAmphur").prop("disabled", false);
                                    $("#billingDistrict").html("");
                                    $("#billingDistrict").prop("disabled", true);

                                }',
                ),
            ));
            ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">
            <p><?php echo $form->labelEx($model, 'paymentAmphurId'); ?></p>
        </div>
        <div class="col-md-9" id="">
            <?php
            echo $form->dropDownList($model, 'paymentAmphurId',
            //CHtml::listData($billingAddressModel->province->amphurs, 'amphurId', 'amphurName'),
            array(), array(
//                            'class'=>'chosen-select-full-width',
                'id' => 'billingAmphur',
                'name' => 'OrderGroup[amphurId]',
                'prompt' => '--- เลือกอำเภอ ---',
                'ajax' => array(
                    'type' => 'POST',
                    'data' => array(
                        'amphurId' => 'js:this.value'),
                    'url' => $this->createUrl('findDistrict'),
                    'success' => 'js:function(data){
                                    $("#billingDistrict").html(data);
                                    $("#billingDistrict").prop("disabled", false);
                                }',
                ),
            )
            );
            ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">
            <p><?php echo $form->labelEx($model, 'paymentDistrictId'); ?></p>
        </div>
        <div class="col-md-9">
            <?php
            echo $form->dropDownList($model, 'paymentDistrictId',
            //CHtml::listData($billingAddressModel->amphur->districts, 'districtId', 'districtName'),
            array(), array(
//                            'class'=>'chosen-select-full-width',
                'id' => 'billingDistrict',
                'name' => 'OrderGroup[districtId]',
                'prompt' => '--- เลือกตำบล ---',
            )
            );
            ?>
        </div>
    </div>
    <div class="form-group">
        <?php
        echo $form->labelEx($model, 'paymentPostcode', array(
            'class' => 'col-sm-2 control-label'));
        ?>
        <div class="col-sm-10">
            <?php
            echo $form->textField($model, 'paymentPostcode', array(
                'size' => 10,
                'maxlength' => 10,
                'class' => 'form-control'));
            ?>
            <?php echo $form->error($model, 'paymentPostcode'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php
        echo $form->labelEx($model, 'paymentTaxNo', array(
            'class' => 'col-sm-2 control-label'));
        ?>
        <div class="col-sm-10">
            <?php
            echo $form->textField($model, 'paymentTaxNo', array(
                'size' => 45,
                'maxlength' => 45,
                'class' => 'form-control'));
            ?>
            <?php echo $form->error($model, 'paymentTaxNo'); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <?php
            echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
                'class' => 'btn btn-primary'));
            ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->