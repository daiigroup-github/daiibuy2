<?php
$css = Yii::app()->baseUrl . '/css';
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="language" content="en"/>
		<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/css/twitter-bootstrap/js/jquery.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/css/twitter-bootstrap/js/bootstrap.js"></script>
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<link href="<?php echo $css; ?>/print/normalize.css" rel="stylesheet">
		<link href="<?php echo $css; ?>/print/print.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<?php echo $content; ?>
		</div>
	</body>
</html>
<?php Yii::app()->clientScript->registerCoreScript('bootstrap'); ?>


