<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="language" content="en"/>

		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	</head>

	<body>

		<?php echo $content;
		?>

	</body>
</html>

<?php Yii::app()->clientScript->registerCoreScript('bootstrap'); ?>
