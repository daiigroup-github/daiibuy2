<?php
/* @var $this ContentController */
/* @var $model Content */

$this->breadcrumbs = array(
	'Contents'=>array(
		'index'),
	$model->title=>array(
		'view',
		'id'=>$model->contentId),
	'Update',
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		Update Content <?php echo $model->contentId; ?>	</div>
	<div class="panel-body">
		<?php
		$this->renderPartial('_form', array(
			'model'=>$model));
		?>
	</div>
</div>