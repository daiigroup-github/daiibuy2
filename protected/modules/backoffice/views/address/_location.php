<?php
//$districtStyle = set show option display of district dropdown
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//$form=$this->beginWidget('CActiveForm', array(
//'id'=>'location-'.$type.'-form',
//'enableAjaxValidation'=>false,
//'htmlOptions' => array('enctype' => 'multipart/form-data',),
//    ));
?>
<?php
if(isset($type))
{
	$type = $type;
}
else
{
	$type = "";
}
$daiibuy = new DaiiBuy();
$daiibuy->loadCookie();
if(isset(Yii::app()->user->userType) && (Yii::app()->user->userType == 2 || $type == "shipping"))
{
	$model->provinceId = $daiibuy->provinceId;
	$model->amphurId = $daiibuy->amphurId;
}
?>

<div class="form-group">
	<label class="col-sm-2 control-label"><?php echo $form->labelEx($model, "[$type]" . 'provinceId'); ?></label>
	<div class="col-sm-3">
		<?php
		if(isset(Yii::app()->user->userType) && (Yii::app()->user->userType == 2 || $type == "shipping") && !(Yii::app()->user->userType == 4))
		{
			echo $form->dropdownList($model, "[$type]" . 'provinceId', Address::model()->getProviceById($model->provinceId), array(
				"class"=>"form-control",));
		}
		else
		{
			echo $form->dropdownList($model, "[$type]" . 'provinceId', Address::model()->getAllProvince(), array(
				"class"=>"form-control",
				"prompt"=>"--เลือกจังหวัด--",
				'ajax'=>array(
					'type'=>'POST', //request type
					'url'=>CController::createUrl('/backoffice/user/dynamicLocation'), //url to call.
					//Style: CController::createUrl('currentController/methodToCall')
					'update'=>!isset($type) ? "#" . get_class($model) . "_amphurId" : "#" . get_class($model) . "_" . $type . "_amphurId", //selector to update
					'data'=>array(
						"provinceId"=>"js:this.value"),
				//leave out the data key to pass all form values through
			)));
		}
		?>
	</div>

	<div class="col-sm-3">
		<?php
		if(isset(Yii::app()->user->userType) && (Yii::app()->user->userType == 2 || $type == "shipping") && !(Yii::app()->user->userType == 4))
		{
			echo $form->dropdownList($model, "[$type]" . 'amphurId', Address::model()->getAmphurById($model->amphurId), array(
				"class"=>"input-medium",));
		}
		else
		{
			echo $form->dropdownList($model, "[$type]" . 'amphurId', isset($model->provinceId) ? Address::model()->getAllAmphurByProvinceId($model->provinceId) : array(), array(
				"class"=>"form-control",
				"prompt"=>"--เลือกอำเภอ--",
				'ajax'=>array(
					'type'=>'POST', //request type
					'url'=>CController::createUrl('/backoffice/user/dynamicLocation'), //url to call.
					//Style: CController::createUrl('currentController/methodToCall')
					'update'=>!isset($type) ? "#" . get_class($model) . "_districtId" : "#" . get_class($model) . "_" . $type . "_districtId", //selector to update
					'data'=>array(
						"amphurId"=>"js:this.value"),
				//leave out the data key to pass all form values through
			)));
		}
		?>
		<?php echo $form->error($model, 'amphurId'); ?>
	</div>
	<div class="col-sm-4">
		<?php
		echo $form->dropdownList($model, "[$type]" . 'districtId', isset($model->amphurId) ? Address::model()->getAllDistrictIdByAmphurId($model->amphurId) : array(), array(
			"class"=>"form-control",
			"prompt"=>"--เลือกตำบล--",
			"style"=>isset($districtStyle) ? $districtStyle : ""));
		?>
		<?php echo $form->error($model, 'districtId'); ?>
	</div>
</div>

<?php
//$this->endWidget(); ?>