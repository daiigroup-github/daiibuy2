<?php /*
<div class="row">
    <div class="col-md-12 register-account">
        <div class="carousel-heading no-margin">
            <h4>Billing Address</h4>
        </div>

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => '{id}',
            //'enableClientValidation' => true,
            //'clientOptions' => array('validateOnSubmit' => true,),
            'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
        ));
        ?>
        <div class="page-content">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'firstname');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'firstname');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'lastname');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'lastname');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'company');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'company');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'address_1');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'address_1');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'address_2');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'address_2');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'districtId');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'districtId');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'amphurId');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'amphurId');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'provinceId');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'provinceId');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'postcode');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'postcode');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'taxNo');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'taxNo');?>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>

    </div>
</div>

<div class="row">
    <div class="col-md-12 register-account">
        <div class="carousel-heading no-margin">
            <h4>Shipping Address</h4>
        </div>

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => '{id}',
            //'enableClientValidation' => true,
            //'clientOptions' => array('validateOnSubmit' => true,),
            'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
        ));
        ?>
        <div class="page-content">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p>Same as billing address</p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <input type="checkbox" id="i-agree-to-terms" /><label for="i-agree-to-terms"></label>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'firstname');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'firstname');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'lastname');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'lastname');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'company');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'company');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'address_1');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'address_1');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'address_2');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'address_2');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'districtId');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'districtId');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'amphurId');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'amphurId');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'provinceId');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'provinceId');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'postcode');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'postcode');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'taxNo');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'taxNo');?>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>

    </div>
</div>
*/?>

<div class="row">
    <div class="col-md-6 register-account">
        <div class="carousel-heading no-margin">
            <h4>Billing Address</h4>
        </div>

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => '{id}',
            //'enableClientValidation' => true,
            //'clientOptions' => array('validateOnSubmit' => true,),
            'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
        ));
        ?>
        <div class="page-content">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'firstname');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'firstname');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'lastname');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'lastname');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'company');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'company');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'address_1');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'address_1');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'address_2');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'address_2');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'districtId');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'districtId');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'amphurId');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'amphurId');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'provinceId');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'provinceId');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'postcode');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'postcode');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'taxNo');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'taxNo');?>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>

    </div>

    <div class="col-md-6 register-account">
        <div class="carousel-heading no-margin">
            <h4>Billing Address</h4>
        </div>

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => '{id}',
            //'enableClientValidation' => true,
            //'clientOptions' => array('validateOnSubmit' => true,),
            'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
        ));
        ?>
        <div class="page-content">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'firstname');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'firstname');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'lastname');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'lastname');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'company');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'company');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'address_1');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'address_1');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'address_2');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'address_2');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'districtId');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'districtId');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'amphurId');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'amphurId');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'provinceId');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'provinceId');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'postcode');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'postcode');?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <p><?php echo $form->labelEx($addressModel, 'taxNo');?></p>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <?php echo $form->textField($addressModel, 'taxNo');?>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>

    </div>
</div>


<div class="page-content">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php echo CHtml::submitButton('Register', array('class'=>'big blue', 'name'=>'Register'));?>
            <?php echo CHtml::resetButton('Reset', array('class'=>'big'));?>
        </div>
    </div>
</div>
