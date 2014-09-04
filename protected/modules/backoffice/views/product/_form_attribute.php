<?php
//AttributeTab
$pAttriButeGroupAdd = TRUE;
$pAttributeValueAdd = array(
	);
$pAttributeAddBtn = TRUE;
//AttributeTab
//if ($model->status == 2)
//{
//	$pAttriButeGroupAdd = FALSE;
//	$pAttributeValueAdd = array(
//		"readOnly" => TRUE);
//	$pAttributeAddBtn = FALSE;
//}
?>
<div class="row copy">
	<div class="span4">
		<div class="control-group">
			<label class="control-label">ชื่อคุณสมบัติ</label>
			<div class="controls">
				<?php
//				if ($pAttriButeGroupAdd)
//				{
				echo CHtml::dropDownList('attributeId', '', ProductAttribute::model()->getProductAttriButeFromUserId(), array(
					'prompt'=>'Product Group',
					'class'=>'input-medium',
					'id'=>'attributeId'));
				echo CHtml::link('<i class="icon-plus-sign"></i>', "", // the link for open the dialog
					array(
					'class'=>'',
					'style'=>'text-decoration:none;',
					'onclick'=>"{addAttribute(); $('#dialogAttribute').dialog('open');}"));
//				}
//				else
//				{
//					echo "<p style='color:red'>ไม่สามารถเพิ่ม Attributes ได้เนื่องจากสินค้านี้ผ่านการอนุมัติแล้ว</p>";
//				}
				?>
			</div>
		</div>
	</div>

	<div class="span5">
		<div class="control-group">
			<label class="control-label">รายละเอียด</label>
			<div class="controls">
				<?php
				echo CHtml::textField('attributeValue', '', $pAttributeValueAdd);
				?>
			</div>
		</div>
	</div>

	<div class="span2">
		<?php
		if($pAttributeAddBtn)
		{
			echo CHtml::ajaxLink('Add Attribute', '#', array(
				), array(
				'class'=>'btn btn-primary',
				'onclick'=>'insertAttributeTable();'));
		}
		?>
	</div>
</div>

<!-- Modal -->
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	// the dialog
	'id'=>'dialogAttribute',
	'options'=>array(
		'title'=>'Add Attribute',
		'autoOpen'=>false,
		'modal'=>true,
		'width'=>550,
		'height'=>200,
	),
));
?>
<div class="divForForm"></div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
// here is the magic
	function addAttribute()
	{
<?php
echo CHtml::ajax(array(
	'url'=>array(
		'admin/product/addattribute'),
	'data'=>"js:$(this).serialize()",
	'type'=>'post',
	'dataType'=>'json',
	'success'=>"function(data)
		{
			if (data.status == 'failure')
			{
				$('.divForForm').html(data.div);
				// Here is the trick: on submit-> once again this function!
				$('divForForm').submit(addAttribute);
				$('.divForForm form').submit(addAttribute);
			}
			else if(data.status = 'success')
			{
				$('#attributeId').append(data.div);
				setTimeout(\"$('#dialogAttribute').dialog('close') \",1000);
			}
			else
			{
				$('#dialogPriceGroup div.divForForm').html(data.div);
				setTimeout(\"$('#dialogAttribute').dialog('close') \",3000);
			}
		} ",
))
?>;
		return false;

	}

	var i = <?php echo isset($model->productAttributeValue) ? sizeof($model->productAttributeValue) + 1 : 0; ?>;

	function insertAttributeTable()
	{
		var t;
		if($('#attributeValue').val().trim() == "" || $('#attributeId').val().trim() == "")
		{
			alert("กรุณาระบุ ชื่อคุณสมบัติ และ รายละเอียดคุณสมบัติ");
		}
		else
		{
			t = '<tr class="ui-state-default">' +
					'<td><a style="color:red" onclick="$(this).parent().parent().remove(); return false;" href="#"><i class="icon-minus-sign"></i></a></td>' +
					'<td>' + $('#attributeId option:selected').text() +
					'<input type="hidden" name="ProductAttributeValue[' + i + '][productAttributeId]" value="' + $('#attributeId option:selected').val() + '" />' +
					'</td>' +
					'<td>' + $('#attributeValue').val() +
					'<input type="hidden" name="ProductAttributeValue[' + i + '][attributeValue]" value="' + $('#attributeValue').val() + '" />' +
					'</td>' +
					'</tr>';

			$('#tableAttribute tbody').append(t);
			i++;
		}
	}

	$(function() {
		$("#sortable").sortable();
		$("#sortable").disableSelection();
	});
</script>

<table class="table table-striped table-bordered table-hover" id="tableAttribute">
	<thead>
		<tr>
			<th>#</th>
			<th>Attribute Name</th>
			<th>Attribute Value</th>
		</tr>
	</thead>
	<tbody id="sortable">
		<?php
		if($model->productAttributeValue)
		{
			$i = 1;
			foreach($model->productAttributeValue as $productAttributeValue)
			{
				echo '<tr class="ui-state-default">' .
				'<td><a style="color:red" onclick="$(this).parent().parent().remove(); return false;" href="#"><i class="icon-minus-sign"></i></a></td>' .
				'<td>' . $productAttributeValue->productAttribute->attributeName .
				'<input type="hidden" name="ProductAttributeValue[' . $i . '][productAttributeId]" value="' . $productAttributeValue->productAttributeId . '" />' .
				'</td>' .
				'<td>' . $productAttributeValue->attributeValue .
				'<input type="hidden" name="ProductAttributeValue[' . $i . '][attributeValue]" value="' . $productAttributeValue->attributeValue . '" />' .
				'</td>' .
				'</tr>';

				$i++;
			}
		}
		?>
	</tbody>
</table>