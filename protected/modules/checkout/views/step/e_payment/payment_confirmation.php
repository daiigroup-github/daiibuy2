<?php
$ePayment = Supplier::model()->findEpaymentByConfig($model->supplierId);
//$this->renderPartial("security", array(
//	'ePayment'=>$ePayment));
include 'security.php';
Yii::app()->clientScript->registerScript('load', "$(document).ready(function () {
		setTimeout(function () {
			$('#confirmationForm').submit();
		}, 1000
				);
	});");
?>
<!--<script >
	$(document).ready(function () {
		setTimeout(function () {
			$('#confirmationForm').submit();
			alert(111);
		}, 1000
				);
	});
</script>-->



<?php
foreach($_REQUEST as $name=> $value)
{
	if(strtolower($name) == 'submit')
		continue;

	$params[$name] = $value;
}
?>
<div class="row text-center">
	<div class="col-md-12">
		<?php
		echo CHtml::image(Yii::app()->baseUrl . "/images/logo.png", "", array(
			"style"=>"width:500px"));
		?></div>
</div>
</div>
<div class="row text-center">
	<div class="col-md-12">

	</div>
</div>
<div class="row text-center" style="background-color:white;">
	<div class="col-md-12"><i class="icon-spinner icon-spin icon-3x"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span  style="font-size: 40px;font-weight: bold">ระบบกำลังดำเนินการ...</span></div>
</div>


<form id="confirmationForm" action="<?php echo $ePayment->ePaymentUrl; ?>" method="post">
	<?php
	foreach($params as $name=> $value)
	{
		echo "<input type=\"hidden\" id=\"" . $name . "\" name=\"" . $name . "\" value=\"" . $value . "\"/>\n";
	}

	echo "<input type=\"hidden\" id=\"signature\" name=\"signature\" value=\"" . sign($params) . "\"/>\n";
	?>

	<!--<input type="submit" id="submit" value="submit" />-->

</form>

