<?php
$baseUrl = Yii::app()->baseUrl;

$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl . '/js/fancyBox/fancyBox.js');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/lib/jquery-1.7.2.min.js');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/lib/jquery.mousewheel-3.0.6.pack.js');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.js?v=2.0.6');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-buttons.js?v=1.0.2');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.2');
$cs->registerScriptFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-media.js?v=1.0.0');
$cs->registerCssFile($baseUrl . '/js/fancyBox/fancyBox.css');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/jquery.fancybox.css?v=2.0.6');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-buttons.css?v=1.0.2');
$cs->registerCssFile($baseUrl . '/js/fancyBox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.2');
?>

<div id='userCerForm' class="wide form">

	<?php
//$this->renderPartial('_search', array(
//	'model' => $model,
//));
	?>

	<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'user-grid',
		'itemsCssClass'=>'table table-striped table-bordered table-condensed',
		'dataProvider'=>UserCertificateFile::model()->getUserCertificate($model->userId),
		'columns'=>array(
			array(
				'name'=>'file',
				'type'=>'raw',
				'htmlOptions'=>array(
					'style'=>'text-align:center;width:20%'),
				'value'=>'showImage($data->file, $data->name)',
			),
			'name',
			'description',
			array(
				'name'=>'value',
				'header'=>'Value(%)',
				'type'=>'raw',
				'htmlOptions'=>array(
					'style'=>'text-align:center;width:10%'),
				'value'=>'$data->value',
			),
			array(
				'name'=>'status',
				'type'=>'raw',
				'htmlOptions'=>array(
					'style'=>'text-align:center;width:10%'),
				'value'=>'$data->showStatus($data->status)',
			),
			array(
				'class'=>'CButtonColumn',
				'template'=>'{update}',
				'buttons'=>array(
					'update'=>array(
						'url'=>'$this->grid->controller->createUrl("/admin/user/UpdateUserCertificateFile"
                                            ,array("id"=>$data->id))'
					),
				)
			),
		),
	));
	?>

	<?php
	echo CHtml::Link('<i class="icon-plus-sign icon-white"></i>เพิ่มเอกสารรับรอง', Yii::app()->createUrl("/admin/user/AddUserCertificateFile/", array(
			'id'=>$model->userId))
		, array(
		'class'=>'btn btn-primary',
		'id'=>'create_cer'));
	?>

</div>

<?php

function showImage($imageUrl, $title)
{
	$image = "";
	if(!empty($imageUrl) && isset($imageUrl))
	{
		if(strpos($imageUrl, ".pdf"))
		{
			$imageUrl = Yii::app()->baseUrl . "/" . $imageUrl;
			$image = "<p><a class='pdf' Title='$title' href='$imageUrl'>ดูไฟล์แนบ</a></p>";
		}
		else
		{
			$imageUrl = Yii::app()->baseUrl . "/" . $imageUrl;
			$image = "<p><a class='fancyFrame' Title='$title' href='$imageUrl'><img src='$imageUrl' width='200px' alt='' /></a></p>";
		}
	}
	return $image;
}
?>