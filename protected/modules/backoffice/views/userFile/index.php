<?php
/* @var $this UserFileController */
/* @var $model UserFile */

$this->breadcrumbs = array(
	'User Files',
);

$this->menu = array(
	array(
		'label'=>'Create UserFile',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-file-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

$this->pageHeader = 'การจัดการเอกสารที่ต้องการจาก User';
?>

<div class="btn-toolbar">
	<div class="btn-group">
		<?php
		echo CHtml::link('<i class="icon-plus-sign icon-white"></i> เพิ่มเอกสารที่ต้องการของ user', array(
			'create'), array(
			'class'=>'btn btn-primary'));
		?>
	</div>
</div>

<?php
$this->renderPartial('_search', array(
	'model'=>$model,
));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-file-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
	'columns'=>array(
		'userFileName',
		'type',
		'isShowInProductView',
		'isPublic',
		'status',
		'createDateTime',
		array(
			'class'=>'CButtonColumn',
		),
	),
));
?>
