<?php
$this->renderPartial('_form', array(
	'model'=>$model,
	'productWithOutPay'=>$productWithOutPay,
	'cat2ToProduct'=>$cat2ToProduct,
	'price'=>$price,
	'brandModels'=>$brandModels,
	'errorMessage'=>isset($_GET["errorMessage"]) ? $_GET["errorMessage"] : NULL));
?>