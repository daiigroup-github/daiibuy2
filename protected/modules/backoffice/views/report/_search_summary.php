<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'htmlOptions' => array(//		'class'=>'form-inline well'
        'class'=>'alert alert-info'
    ),
    'id' => 'search-form'
));
?>
    <div class="input-group">
        <div class="row">
            <div class="col-lg-3">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit">Search by Year and Month</button>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4">
                        <?php
                        echo $form->dropDownList($model, 'paymentYear', $model->findAllYearSalesArray(), array(
                            "class" => "form-control",
                            "prompt" => "-- เลือกทุกปี --",));
                        ?>
                    </div>
                    <div class="col-lg-4">
                        <?php
                        echo $form->dropDownList($model, 'paymentMonth', $model->findAllMonthSalesArray(), array(
                            "class" => "form-control",
                            "prompt" => "-- เลือกทุกเดือน --",));
                        ?>
                    </div>
                    <div class="col-lg-4">
                        <?php
                        if(Yii::app()->user->userType == 3){
                            //hidden field
                            echo $form->hiddenField($model, 'supplierId');
                        } else {
                            echo $form->dropDownList($model, 'supplierId', Supplier::model()->findAllSupplierArray(), array(
                                    "class" => "form-control",
                                    "prompt" => "-- เลือกทุก Supplier --")
                            );
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?php $this->endWidget(); ?>


<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'htmlOptions' => array(//		'class'=>'form-inline well'
        'class'=>'well'
    ),
    'id' => 'search-form2'
));
?>
    <div class="input-group">
        <div class="row">
            <div class="col-lg-3">
                <div class="input-group-btn">
		            <button class="btn btn-default" type="submit">Search by date range</button>
	            </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4">
                        <?php echo $form->dateField($model, 'startDate', array('class'=>'form-control'))?>
                    </div>
                    <div class="col-lg-4">
                        <?php echo $form->dateField($model, 'endDate', array('class'=>'form-control'))?>
                    </div>
                    <div class="col-lg-4">
                        <?php
                        if(Yii::app()->user->userType == 3){
                            //hidden field
                            echo $form->hiddenField($model, 'supplierId');
                        } else {
                            echo $form->dropDownList($model, 'supplierId', Supplier::model()->findAllSupplierArray(), array(
                                    "class" => "form-control",
                                    "prompt" => "-- เลือกทุก Supplier --")
                            );
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?php $this->endWidget(); ?>