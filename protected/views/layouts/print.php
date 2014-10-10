<?php
$css = Yii::app()->baseUrl . '/css';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="language" content="en"/>
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<link href="<?php echo $css; ?>/print/normalize.css" rel="stylesheet">
		<link href="<?php echo $css; ?>/print/print.css" rel="stylesheet">
	</head>
	<body>
		<div class="wrapper">
			<?php echo $content; ?>
		</div>
	</body>
</html>

<?php Yii::app()->clientScript->registerCoreScript('bootstrap'); ?>