<?php
/* @var $this ContentController */
/* @var $model Content */

$this->breadcrumbs = array(
	'Contents'=>array(
		'index'),
	'Manage',
);

$this->menu = array(
	array(
		'label'=>'List Content',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create Content',
		'url'=>array(
			'create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#content-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
$this->pageHeader = 'การจัดการเนื้อหาเว็บไซต์';
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Manage Content
		<div class="pull-right">
			<?php
			echo CHtml::link('<i class="icon-plus-sign icon-white"></i>  Create', array(
				'create'), array(
				'class'=>'btn btn-xs btn-primary'));
			?>
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-12">
				<?php
				$this->renderPartial('_search', array(
					'model'=>$model,
				));
				?>
			</div>
		</div>
	</div>

	<div class="alert alert-danger"><h4>คุณสามารถเพิ่มรายการของ Content ต่างๆ ได้โดย กดปุ่ม <i class="icon-edit"></i> ของแต่ละ Content</h4>
		<br>1. รูปโปรโมชั่นหน้าหลัก เพิ่มรูป ที่รายการเพิ่มเติม
		<br>2. Link ของ Footerใส่ Controller/Action or Ext. Link เป็น  admin/content/contentView และ เพิ่ม link ที่รายการเพิ่มเติม
		<br>3. Social ของ Footer เพิ่ม Social ที่รายการเพิ่มเติม และใส่ Controller/Action or Ext. Link ของรายการเพิ่มเติม นำหน้าด้วย http:// หรือ protocal อื่นๆ ex. http://www.facebook.com/daiibuy
		<br>4. Copyright ของ Footer เพิ่มหรือแก้ไข ในช่องรายละเอียด ได้เลย
		<br>5. รูปหน้าเลือกจังหวัด เพิ่มรูป ที่รายการเพิ่มเติม มากสุด 4 รูป
		<br>6. วีดีโอหน้าเลือกจังหวัด ณ วันที่ 18/06/2556 ยัง   ****ไม่เปิดใช้งาน****
	</div>
	<?php
	$model->parentId = 0; // find root items only.
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'content-grid',
		'dataProvider'=>$model->search(),
		'itemsCssClass'=>'table table-striped table-bordered table-condensed table-hover',
		'columns'=>array(
			array(
				'name'=>'image',
				'type'=>'image',
				'htmlOptions'=>array(
					'width'=>'200px'),
				'value'=>'Yii::app()->baseUrl.$data->image',
			),
			'title',
			'description',
			'subview',
			/*
			  'type',
			  'status',
			  'createDateTime',
			  'updateDateTime',
			 */
			array(
				'class'=>'CButtonColumn',
			),
		),
	));
	?>

</div>