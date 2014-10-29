/**
 * Created by NPR on 8/13/14.
 */
$('.add-to-cart').click(function () {

	var data = {};
	if ($(this).attr('id'))
		data = {id: $(this).attr('id')};
	else
		data = $('#productOptionForm').serialize();
	$.ajax({
		url: baseUrl + 'madrid/product/addToCart',
		type: 'POST',
		dataType: 'JSON',
		data: data,
		success: function (data) {
			//alert success message
			alert(data.result);
		}
	});
})
		;
function loadThemeItem(cat2Id, baseUrl)
{
	$.ajax({
		url: baseUrl + '/myfile/madrid/loadThemeItem',
		type: 'POST',
		dataType: 'JSON',
		data: {category2Id: cat2Id},
		success: function (data) {
			//alert success message
			$("#item-table").removeClass('hide');
			$("#action-button").removeClass('hide');
			for (var groupName in data)
			{
				if (groupName != "")
				{
					$("#productCode" + groupName).html(data[groupName]["code"]);
					$("#productName" + groupName).html(data[groupName]["name"]);
					$("#productUnits" + groupName).html(data[groupName]["productUnits"]);
					$("#productArea" + groupName).html(data[groupName]["productArea"]);
					var estimateQuantity = data[groupName]["productArea"] * $("#supplierArea" + groupName).val();
					$("#estimateAreaQuantity" + groupName).html(estimateQuantity);
//					$("#quantityText_" + groupName).removeClass("hide");
					$("#quantityText_" + groupName).val(estimateQuantity);
					$("#price" + groupName).html(data[groupName]["price"] * estimateQuantity);
					$("#priceHidden" + groupName).val(data[groupName]["price"]);
					$("#productId" + groupName).val(data[groupName]["productId"]);
				}
				else
				{
					groupNames = {a: "a", b: "b", c: "c", d: "d", e: "e"};
					for (var groupName in groupNames)
					{
						$("#productCode" + groupName).html("");
						$("#productName" + groupName).html("");
						$("#productUnits" + groupName).html("");
						$("#productArea" + groupName).html("");
						$("#estimateAreaQuantity" + groupName).html("");
//						$("#quantityText_" + groupName).addClass("hide");
						$("#quantityText_" + groupName).val(0);
						$("#price" + groupName).html("");
						$("#priceHidden" + groupName).val(0);
						$("#productId" + groupName).val(0);
					}
				}
			}
		}
	});
}
function updatePrice()
{
	groupNames = {a: "a", b: "b", c: "c", d: "d", e: "e", f: "f"};
	for (var groupName in groupNames)
	{
		var price = $("#priceHidden" + groupName).val();
		var quantity = $("#quantityText_" + groupName).val();
		$("#price" + groupName).html(price * quantity);
	}
}

$('#manualQuantityMadrid').on('click', function () {
	$('ul.setup-panel li a[href="#step-3"]').trigger('click');
	$('#Order_createMyfileType').val(1);
});
$('#uploadPlanMadrid').on('click', function () {
	$('ul.setup-panel li a[href="#step-2"]').trigger('click');
	$('#Order_createMyfileType').val(2);
});
function loadSetItem(cat2Id, baseUrl)
{
	$("#item-table").removeClass('hide');
	$("#action-button").removeClass('hide');
	$.ajax({
		url: baseUrl + '/myfile/madrid/loadSetItem',
		type: 'POST',
//		dataType: 'JSON',
		data: {category2Id: cat2Id},
		success: function (data) {
			$("#item-table").html(data);
		}
	});
}


function findModel(sel, baseUrl)
{
	var attrName = sel.attributes['name'].value;
	var obj = $('select[name=\"' + attrName + '\"]');
	var brandId = obj.val();
	$.ajax({
		'url': baseUrl + '/backoffice/order/findAllModelByBrandIdAjax',
//			'dataType': 'json',
		'type': 'POST',
		'data': {'brandId': brandId},
		'success': function (data) {
			obj.parent().parent().children('.model').children('select').html(data);
		},
	});
}
function findCat1(sel, baseUrl)
{
	var attrName = sel.attributes['name'].value;
	var obj = $('select[name=\"' + attrName + '\"]');
	var brandModelId = obj.val();
	$.ajax({
		'url': baseUrl + '/backoffice/order/findAllCat1ByBrandModelIdAjax',
//			'dataType': 'json',
		'type': 'POST',
		'data': {'brandModelId': brandModelId},
		'success': function (data) {
			obj.parent().parent().children('.cat1').children('select').html(data);
		},
	});
}
function findCat2(sel, baseUrl)
{
	var attrName = sel.attributes['name'].value;
	var obj = $('select[name=\"' + attrName + '\"]');
	var cat1Id = obj.val();
	$.ajax({
		'url': baseUrl + '/backoffice/order/findAllCat2AndProductByBrandCat1IdAjax',
//			'dataType': 'json',
		'type': 'POST',
		'data': {'cat1Id': cat1Id},
		'success': function (data) {
			obj.parent().parent().children('.cat2').children('select').html(data);
			findProductByCat1(sel);
		},
	});
}
function findProductByCat1(sel, baseUrl)
{
	var attrName = sel.attributes['name'].value;
	var obj = $('select[name=\"' + attrName + '\"]');
	var cat1Id = obj.val();
	$.ajax({
		'url': baseUrl + '/backoffice/order/findAllProductByCat1IdAjax',
//			'dataType': 'json',
		'type': 'POST',
		'data': {'cat1Id': cat1Id},
		'success': function (data) {
			obj.parent().parent().children('.product').children('select').html(data);
		},
	});
}
function findProduct(sel, baseUrl)
{
	var attrName = sel.attributes['name'].value;
	var obj = $('select[name=\"' + attrName + '\"]');
	var cat2Id = obj.val();
	$.ajax({
		'url': baseUrl + '/backoffice/order/findAllProductByCat2IdAjax',
//			'dataType': 'json',
		'type': 'POST',
		'data': {'cat2Id': cat2Id},
		'success': function (data) {
			obj.parent().parent().children('.product').children('select').html(data);
//			findGroupName(sel);
		},
	});
}