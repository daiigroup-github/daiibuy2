<?php
/* @var $this OrderController */
/* @var $model Order */
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

$this->breadcrumbs = array(
	'Orders'=>array(
		'index'),
	$model->orderId,
);
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'bank-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'enctype'=>'multipart/form-data',
		'class'=>'form-horizontal'),
	));
$this->widget('ext.jqrelcopy.JQRelcopy', array(
	//the id of the 'Copy' link in the view, see below.
	'id'=>'copyItem',
	//add a icon image tag instead of the text
	//leave empty to disable removing
	'removeText'=>'<i class="fa fa-remove"></i>',
	//htmlOptions of the remove link
	'removeHtmlOptions'=>array(
//		'style'=>'color:red',
		'class'=>'btn btn-danger'
	),
	//options of the plugin, see http://www.andresvidal.com/labs/relcopy.html
	'options'=>array(
		//A class to attach to each copy
		'copyClass'=>'newCopy',
		// The number of allowed copies. Default: 0 is unlimited
		'limit'=>0,
		//Option to clear each copies text input fields or textarea
		'clearInputs'=>true,
		//A jQuery selector used to exclude an element and its children
		'excludeSelector'=>'.skipcopy',
	//Additional HTML to attach at the end of each copy.
//		'append'=>CHtml::tag('span', array(
//			'class'=>'hint'
//			), 'You can remove this line'),
	),
	'jsAfterNewId'=>"
		if(typeof this.attr('name') !== 'undefined'){ this.attr('name', this.attr('name').replace('[]', '['+counter+']'));}

		",
));
?>
<div class="panel panel-default">
	<div class="panel-heading">
		ถอดแบบ Myfile <?php echo isset($model->user) ? $model->user->firstname . " " . $model->user->lastname : "-" ?>
		<div class="pull-right">
			<?php
//			echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array(
//				'class'=>'btn btn-xs btn-primary'));
			?>
		</div>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-lg-2" >
				<h4>ไฟล์ที่ได้รับจากลูกค้า</h4>

				<table class="table table-bordered table-condensed table-condensed">
					<thead>
						<tr class="alert alert-info">
							<th>ลำดับ</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(count($model->orderFiles) > 0):
							$i = 1;
							foreach($model->orderFiles as $orderFiles)
							{
								?>
								<tr>
									<td><?php echo $i . "."; ?>|&nbsp;&nbsp;<?php echo showImage($orderFiles->filePath, $orderFiles->fileName) ?></td>
								</tr>
								<?php
								$i++;
							}
						else:
							?>
							<tr><td colspan="2" class="text-warning">
									ไม่มีรายการไฟล์ที่ลูกค้าอัพโหลด
								</td></tr>
						<?php
						endif;
						?>
					</tbody>
				</table>
			</div>
			<div class="col-lg-10" style="border-left: 2px black dotted">
				<h4>เลือกสินค้าที่จะสร้าง Myfile</h4>
				<table class="table table-bordered table-condensed">
					<thead>
						<tr class="alert alert-success">
							<?php if(Yii::app()->user->supplierId != 3): ?>
								<th style="width: 17%">Brand</th>
								<th style="width: 17%">Model</th>
								<th>Cat1</th>
								<th>Cat2</th>
								<th style="width: 17%">Product</th>
								<th style="width: 5%">Quantiry</th>
							<?php else: ?>
								<th style="width: 50%">Group Name</th>
								<th style="width: 50%">Area</th>
							<?php endif; ?>
						</tr>
					</thead>
					<tbody>
						<tr class="copy" id="copy">
							<?php if(Yii::app()->user->supplierId != 3): ?>
								<td><?php
									echo CHtml::dropDownList("OrderItems[brandId][]", "", Brand::model()->getAllBrandBySupplierId(Yii::app()->user->supplierId), array(
										'prompt'=>'Select Brand',
										'class'=>'form-control',
										'onchange'=>'findModel(this);',
										'id'=>'brandId',
									));
									?></td>
								<td class="model"><?php
									echo CHtml::dropDownList('OrderItems[brandModelId][]', '', array(
										), array(
										'prompt'=>'Select Model',
										'class'=>'form-control',
										'onchange'=>'findCat1(this);',
										'id'=>'brandModelId',
									));
									?></td>
								<td class="cat1"><?php
									echo CHtml::dropDownList('OrderItems[category1Id][]', '', array(
										), array(
										'prompt'=>'Select Cat1',
										'class'=>'form-control',
										'onchange'=>'findCat2(this);',
										'id'=>'category1Id',
									));
									?></td>
								<td class="cat2"><?php
									echo CHtml::dropDownList('OrderItems[category2Id][]', '', array(
										), array(
										'prompt'=>'Select Cat2',
										'class'=>'form-control',
										'onchange'=>'findProduct(this);',
										'id'=>'category2Id',
									));
									?></td>
								<td class="product"><?php
									echo CHtml::dropDownList('OrderItems[productId][]', '', array(
										), array(
										'prompt'=>'Select Product',
										'class'=>'form-control',
										'id'=>'productId',
									));
									?></td>
								<td><?php
									echo CHtml::numberField('OrderItems[quantity][]', "", array(
										'class'=>'form-control'))
									?></td>
							<?php else: ?>
								<td class="groupName"><?php
									echo CHtml::dropDownList('OrderItems[groupName][]', '', array(
										"A"=>"A",
										"B"=>"B",
										"C"=>"C",
										"D"=>"D",
										"E"=>"E",
										"F"=>"F",
										"G"=>"G",
										), array(
										'prompt'=>'Select Group Name',
										'class'=>'form-control',
										'id'=>'groupName',
									));
									?></td>
								<td><?php
									echo CHtml::numberField('OrderItems[area][]', "", array(
										'class'=>'form-control'))
									?></td>
							<?php endif; ?>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="6"><a id="copyItem" href="#" rel=".copy">Copy</a></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-offset-2 col-sm-9">
				<?php
				echo CHtml::submitButton('ส่งให้ ลูกค้า', array(
					'class'=>'btn btn-success btn-lg'));
				?>
			</div>
		</div>
	</div>
</div>
<?php $this->endWidget(); ?>
<?php

function showImage($imageUrl, $title)
{
	$image = "";
	if(!empty($imageUrl) && isset($imageUrl))
	{
		if(strpos($imageUrl, ".pdf"))
		{
			$imageUrl = Yii::app()->baseUrl . $imageUrl;
			$image = "<a class='pdf' Title='$title' href='$imageUrl'><i class='fa fa-search'></i>View</a>";
		}
		else
		{
			$imageUrl = Yii::app()->baseUrl . $imageUrl;
			//$image = "<a class='fancyFrame' Title='$title' href='$imageUrl'><img src='$imageUrl' width='50px' alt='' /></a>";
			$image = "<a class='fancyFrame' Title='$title' href='$imageUrl'><i class='fa fa-search'></i>View</a>";
		}
	}
	return $image;
}
?>
<script>
	function findModel(sel)
	{
		var attrName = sel.attributes['name'].value;
		var obj = $('select[name=\"' + attrName + '\"]');
		var brandId = obj.val();

		$.ajax({
			'url': '<?php echo CController::createUrl('order/findAllModelByBrandIdAjax'); ?>',
//			'dataType': 'json',
			'type': 'POST',
			'data': {'brandId': brandId},
			'success': function (data) {
				obj.parent().parent().children('.model').children('select').html(data);
			},
		});
	}
	function findCat1(sel)
	{
		var attrName = sel.attributes['name'].value;
		var obj = $('select[name=\"' + attrName + '\"]');
		var brandModelId = obj.val();

		$.ajax({
			'url': '<?php echo CController::createUrl('order/findAllCat1ByBrandModelIdAjax'); ?>',
//			'dataType': 'json',
			'type': 'POST',
			'data': {'brandModelId': brandModelId},
			'success': function (data) {
				obj.parent().parent().children('.cat1').children('select').html(data);
			},
		});
	}
	function findCat2(sel)
	{
		var attrName = sel.attributes['name'].value;
		var obj = $('select[name=\"' + attrName + '\"]');
		var cat1Id = obj.val();

		$.ajax({
			'url': '<?php echo CController::createUrl('order/findAllCat2AndProductByBrandCat1IdAjax'); ?>',
//			'dataType': 'json',
			'type': 'POST',
			'data': {'cat1Id': cat1Id},
			'success': function (data) {
				obj.parent().parent().children('.cat2').children('select').html(data);
				findProductByCat1(sel);
			},
		});
	}
	function findProductByCat1(sel)
	{
		var attrName = sel.attributes['name'].value;
		var obj = $('select[name=\"' + attrName + '\"]');
		var cat1Id = obj.val();
		$.ajax({
			'url': '<?php echo CController::createUrl('order/findAllProductByCat1IdAjax'); ?>',
//			'dataType': 'json',
			'type': 'POST',
			'data': {'cat1Id': cat1Id},
			'success': function (data) {
				obj.parent().parent().children('.product').children('select').html(data);
			},
		});
	}
	function findProduct(sel)
	{
		var attrName = sel.attributes['name'].value;
		var obj = $('select[name=\"' + attrName + '\"]');
		var cat2Id = obj.val();

		$.ajax({
			'url': '<?php echo CController::createUrl('order/findAllProductByCat2IdAjax'); ?>',
//			'dataType': 'json',
			'type': 'POST',
			'data': {'cat2Id': cat2Id},
			'success': function (data) {
				obj.parent().parent().children('.product').children('select').html(data);
				findGroupName(sel);
			},
		});
	}
	function findGroupName(sel)
	{
		var attrName = sel.attributes['name'].value;
		var obj = $('select[name=\"' + attrName + '\"]');
		var cat2Id = obj.val();
		$.ajax({
			'url': '<?php echo CController::createUrl('order/findAllGroupNameByCat2IdAjax'); ?>',
//			'dataType': 'json',
			'type': 'POST',
			'data': {'cat2Id': cat2Id},
			'success': function (data) {
				obj.parent().parent().children('.groupName').children('select').html(data);
			},
		});
	}
</script>