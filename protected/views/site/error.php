<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle = Yii::app()->name . ' - Error';
$this->breadcrumbs = array(
	'Error',
);
?>

<h2>Error <?php echo $code; ?></h2>
<?php
echo CHtml::link("Back", "", array(
	'class'=>'btn btn-danger',
	'onclick'=>'history.back()'));
?>

<div class="error">
	<?php echo CHtml::encode($message); ?>
</div>