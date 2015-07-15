<?php
$this->renderPartial('_form', array(
	'model'=>$model,
	'productWithOutPay'=>$productWithOutPay,
	'cat2ToProduct'=>$cat2ToProduct,
	'price'=>$price,
	'brandModelArray'=>$brandModelArray,
	'errorMessage'=>isset($_GET["errorMessage"]) ? $_GET["errorMessage"] : NULL));
?>