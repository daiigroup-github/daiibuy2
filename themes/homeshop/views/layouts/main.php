<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="../../assets/ico/favicon.ico">

	<title><?php echo Yii::app()->name; ?></title>

<!--	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,700,900,700italic,500italic' rel='stylesheet' type='text/css'/>-->

</head>

<body>

<?php echo $content; ?>

<?php $this->renderPartial('//layouts/_modal_province'); ?>

</body>
</html>
<?php Yii::app()->clientScript->registerCoreScript('homeshop'); ?>

