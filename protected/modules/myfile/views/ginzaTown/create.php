<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
$this->breadcrumbs = array(
	$this->module->id,
);

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

<?php
$this->renderPartial("_navbar", array(
	'model'=>$model));
?>
<!-- WIZARD -->
<?php
$form = $this->beginWidget('CActiveForm', array(
	'id'=>'ginzatown-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'enctype'=>'multipart/form-data',
	),
	));
?>
<div class="myfile-main">
	<?php
	$this->renderPartial("_wizard_step", array(
		'model'=>$model));
	?>
	<div class="row setup-content" id="step-c1">
		<div class="col-xs-12">
			<div class="row sidebar-box blue " style="background-color: white">
				<div class="col-md-12" style="border:1px black solid" id="item-table">
					<?php if(isset($errorMessage)): ?>
						<h1 class="text-center alert alert-danger" style="font-weight: bold">
							<?php
							echo $errorMessage;
							?>
						</h1>
					<?php endif;
					?>
				</div>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="page-header select-province">
							<h1>เลือกจังหวัด</h1><small> กรุณาเลือกจังหวัดที่ท่านต้องการสั่งซื้อสินค้า.</small>
						</div>
						<div class="form-group">
							<div class="col-sm-10">
								<?php
								echo $form->textField($model, 'title', array(
									'size'=>20,
									'maxlength'=>20,
									'class'=>'form-control',
									'placeholder'=>'กรุณากรอกชื่อ My File.'));
								?>
								<?php echo $form->error($model, 'title'); ?>
							</div>
						</div>
						<div>
							<?php
							echo CHtml::dropDownList('Order[provinceId]', $model->provinceId, CHtml::listData(Province::model()->findAll(), 'provinceId', 'provinceName'), array(
								'class'=>'form-control',
								'id'=>'selectProvince',
								'prompt'=>'--กรุณาเลือกจังหวัด--',
								'onclick'=>'showStep2Button()'
							));
							?>
						</div>
					</div>
				</div>
				<div class="row wizard-control">
					<div class="pull-right">
						<!--<a class="btn btn-warning btn-lg col-lg-offset-3" onclick="updatePrice()"><i class="glyphicon glyphicon-refresh"></i> อัพเดทราคา</a>-->
						<a id="nextCreate1" class="btn btn-success btn-lg pull-right"><i class="glyphicon glyphicon-chevron-right"></i> ต่อไป</a>
						<?php
						if(1 == 0):
//					if((!$model->isRequestSpacialProject) && (count($child1->sup) == 0 && $child1->status < 1)):
							?>
							<a id="requestSpecial" class="btn btn-info btn-lg" href="<?php echo Yii::app()->createUrl("/myfile/ginzaTown/requestGinzatownSpacialProject/id/$model->orderId") ?>"><i class="glyphicon glyphicon-share"></i> Request Special Project</a>
						<?php endif; ?>
					</div>
				</div>
			</div>

		</div>
	</div>
	<div class="row setup-content" id="step-c2">
		<div class="row sidebar-box blue " style="background-color: white">
			<div class="row">
				<div class="col-lg-12" id="conditionDiv">
					<div class="col-lg-12">
						<table class="table table-bordered table-condensed">
							<thead>
								<tr>
									<th>Model</th>
									<th>Category</th>
									<th>Series</th>
									<th>Color</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								<tr  id="copy" class="copy">
									<td><?php
										echo CHtml::dropDownList("OrderItems[brandModelId][]", "", CHtml::listData(BrandModel::model()->findAll('supplierId = 5'), "brandModelId", "title"), array(
	'prompt'=>'เลือกประเภทบ้าน',
											'class'=>'form-control',
											'onchange'=>'findCategory1(this);',
											'id'=>'brandModelId',
										));
										?></td>
									<td class="cat1"><?php
										echo CHtml::dropDownList("OrderItems[category1Id][]", "", array(), array(
											'prompt'=>'เลือกแบบบ้าน',
											'class'=>'form-control category1Id',
											'onchange'=>'findCategory2(this);',
											'id'=>'category1Id',
										));
										?></td>
									<td class="cat2"><?php
										echo CHtml::dropDownList("OrderItems[category2Id][]", "", array(), array(
											'prompt'=>'เลือกซีรี่ย์',
											'class'=>'form-control category2Id',
											'onchange'=>'findColor(this);',
											'id'=>'category2Id',
										));
										?></td>
									<td class="option"><?php
										echo CHtml::dropDownList("OrderItems[productOptionId][]", "", array(), array(
											'prompt'=>'เลือกสี',
											'class'=>'form-control',
											'onchange'=>'findProduct(this);',
											'id'=>'productOptionId',
										));
										?></td>
									<?php
//								echo CHtml::hiddenField("OrderItems[price][]", "", array(
//									'id'=>'priceValue',
//									'class'=>'priceValue'))
									?>
									<td class="price"><?php
										echo CHtml::numberField('OrderItems[price][]', 1, array(
											'class'=>'form-control priceValue',
											'readonly'=>'readonly'))
										?></td>
									<td class="quantity"><?php
										echo CHtml::numberField('OrderItems[quantity][]', 1, array(
											'class'=>'form-control',
											'onchange'=>'updateTotalPrice(this)'))
										?></td>
									<td class="total"><?php
										echo CHtml::numberField('OrderItems[total][]', 1, array(
											'class'=>'form-control totalValue',
											'readonly'=>'readonly'))
										?></td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="7"><a id="copyItem" href="#" rel=".copy">เพิ่มรายการ</a></td>
								</tr>
							</tfoot>
						</table>
					</div>
					<div class="row wizard-control">
						<div class="pull-right">
							<a id="backCreate2" class="btn btn-primary btn-lg" ><i class="glyphicon glyphicon-chevron-left"></i> ย้อนกลับ</a>
							<a id="nextCreate2" class="btn btn-success btn-lg" ><i class="glyphicon glyphicon-ok"></i> Next</a>
							<!--<a id="finishAtech" class="btn btn-success btn-lg" href="<?php echo Yii::app()->createUrl("/myfile/madrid/finish/id/$model->orderId") ?>"><i class="glyphicon glyphicon-ok"></i> เสร็จสิ้น</a>-->
							<!--<a class="btn btn-warning btn-lg" href="<?php // echo Yii::app()->createUrl("/myfile/madrid/addToCart/id/$model->orderId")                                                  ?>"><i class="glyphicon glyphicon-shopping-cart"></i> ใส่ตระกร้า</a>-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row setup-content" id="step-c3">
		<div class="col-xs-12">
			<div class="col-md-12 well">
				<div id="orderItems">
					<?php
					if(!$model->isNewRecord):
						$this->renderPartial("create_items", array(
							'model'=>$model));
					endif;
					?>
				</div>
				<div class="row wizard-control">
					<div class="pull-right">

						<?php if($model->isNewRecord): ?>
							<?php echo CHtml::hiddenField("orderId"); ?>
							<a id="backCreate3" class="btn btn-primary btn-lg" ><i class="glyphicon glyphicon-chevron-left"></i> ย้อนกลับ</a>
							<a id="finishCreate3" class="btn btn-success btn-lg" ><i class="glyphicon glyphicon-ok"></i> บันทึก</a>
							<a id="requestSpecialCreate3" class="btn btn-info btn-lg hide" ><i class="glyphicon glyphicon-share"></i> Request Special Project</a>
							<span id="spSending" class="label label-danger hide">กำลังขออนุมัติ โปรเจ็คพิเศษ</span>
							<span id="spApprove" class="label label-success hide">ได้รับอนุมัติ โปรเจ็คพิเศษ</span>
							<a id="addToCartCreate3" class="btn btn-warning btn-lg hide" ><i class="glyphicon glyphicon-shopping-cart"></i> ใส่ตระกร้า</a>
						<?php else: ?>
							<?php echo CHtml::hiddenField("orderId", $model->orderId); ?>

							<?php if(!$model->isRequestSpacialProject): ?>
								<a id="requestSpecialCreate3" class="btn btn-info btn-lg" ><i class="glyphicon glyphicon-share"></i> Request Special Project</a>
								<span id="spSending" class="label label-danger hide">กำลังขออนุมัติ โปรเจ็คพิเศษ</span>
								<span id="spApprove" class="label label-success hide">ได้รับอนุมัติ โปรเจ็คพิเศษ</span>
								<?php
							else:
								$spacial = UserSpacialProject::model()->find("orderId = $model->orderId ORDER BY userSpacialProjectId DESC ");
								if(isset($spacial) && $spacial->status == 1)
								{
									?>
									<span id="spSending" class="label label-danger">กำลังขออนุมัติ โปรเจ็คพิเศษ</span>
									<?php
								}
								elseif($spacial->status == 2)
								{
									?>
									<span id="spApprove" class="label label-success">ได้รับอนุมัติ โปรเจ็คพิเศษ</span>
									<?php
								}
								else
								{
									?>
									<span id="spApprove" class="label label-danger">ไม่ได้รับอนุมัติ โปรเจ็คพิเศษ</span>
									<a id="requestSpecialCreate3" class="btn btn-info btn-lg" ><i class="glyphicon glyphicon-share"></i> Request Special Project Again</a>
								<?php } ?>
							<?php endif; ?>

							<a id="addToCartCreate3" class="btn btn-warning btn-lg" ><i class="glyphicon glyphicon-shopping-cart"></i> ใส่ตระกร้า</a>
						<?php endif; ?>

					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<?php $this->endWidget(); ?>
<script>

	function findCategory1(sel)
	{
		var attrName = sel.attributes['name'].value;
		var obj = $('select[name=\"' + attrName + '\"]');
		var brandModelId = obj.val();

		$.ajax({
			'url': '<?php echo Yii::app()->createUrl('/myfile/ginzaTown/findCategory1'); ?>',
//			'dataType': 'json',
			'type': 'POST',
			'data': {'brandModelId': brandModelId},
			'success': function (data) {
				obj.parent().parent().children('.cat1').children('select').html(data);
			},
		});
	}
	function findCategory2(sel)
	{

		var attrName = sel.attributes['name'].value;
		var obj = $('select[name=\"' + attrName + '\"]');
		var cat1Id = obj.val();

		$.ajax({
			'url': '<?php echo Yii::app()->createUrl('/myfile/ginzaTown/findCategory2'); ?>',
//			'dataType': 'json',
			'type': 'POST',
			'data': {'category1Id': cat1Id},
			'success': function (data) {
				obj.parent().parent().children('.cat2').children('select').html(data);
//				findProductByCat1(sel);
			},
		});
	}
	function findColor(sel)
	{
		var attrName = sel.attributes['name'].value;
		var obj = $('select[name=\"' + attrName + '\"]');
		var cat2Id = obj.val();

		$.ajax({
			'url': '<?php echo Yii::app()->createUrl('/myfile/ginzaTown/findColor'); ?>',
//			'dataType': 'json',
			'type': 'POST',
			'data': {'brandModelId': $("#brandModelId").val(), 'category1Id': $("#category1Id").val(), 'category2Id': cat2Id},
			'success': function (data) {
				obj.parent().parent().children('.option').children('select').html(data);
				findProduct(sel);
			},
		});
	}
	function findProduct(sel)
	{
		var attrName = sel.attributes['name'].value;
		var obj = $('select[name=\"' + attrName + '\"]');
		var category1Id = obj.parent().parent().children('.cat1').children(".category1Id").val();
		var category2Id = obj.parent().parent().children('.cat2').children(".category2Id").val();
		$.ajax({
			'url': '<?php echo Yii::app()->createUrl('/myfile/ginzaTown/sumAllProductByCat2Id'); ?>',
			'dataType': 'json',
			'type': 'POST',
			'data': {'category2Id': category2Id, 'category1Id': category1Id},
			'success': function (data) {
				obj.parent().parent().children('.price').children(".priceValue").val(parseFloat(data.summary));
				obj.parent().parent().children('.total').children(".totalValue").val(parseFloat(data.summary));
//				obj.parent().parent().children('#priceValue').val(parseFloat(data.summary));

			},
		});
	}
	function updateTotalPrice(sel)
	{
		var attrName = sel.attributes['name'].value;
		var obj = $('input[name=\"' + attrName + '\"]');
		var quantity = obj.val();
		var price = obj.parent().parent().children('.price').children('.priceValue').val();
		obj.parent().parent().children('.total').children(".totalValue").val(quantity * price);

	}

</script>


