/**
 * Created by NPR on 8/13/14.
 */
$('.add-to-cart').click(function () {

	var data = {};
	var productId = $(this).data('productid');
	var qty = $('#' + productId).val();
	var data = {productId: productId, qty: qty};
	$.ajax({
		url: baseUrl + '/madrid/product/addToCart',
		type: 'POST',
		dataType: 'JSON',
		data: data,
		beforeSend: function () {
			return confirm('คุณต้องการเพิ่มสินค้าลงตะตร้าหรือไม่ ?')
		},
		success: function (data) {
			//alert success message
			if (data.result)
			{
				updateCartHeader();
				alert("เพิ่มสินค้าลงตะกร้าสินค้าเรียนร้อยแล้ว");
			}
			else
			{
				alert("ไม่สามารถเพิ่มสินค้าลงตะกร้าสินค้าได้");
			}
		}
	});
});
function loadThemeItem(cat2Id, baseUrl, orderId)
{
	renderThemeItem(baseUrl, orderId);
	$("#sanitary-item").html("");
	$.ajax({
		url: baseUrl + '/myfile/madrid/loadThemeItem',
		type: 'POST',
		dataType: 'JSON',
		data: {category2Id: cat2Id, orderId: orderId},
		success: function (data) {
			//alert success message
//			$("#item-table").removeClass('hide');
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
function renderThemeItem(baseUrl, orderId)
{
	$("#item-table").addClass('hide');
	$("#action-button").removeClass('hide');
	$.ajax({
		url: baseUrl + '/myfile/madrid/renderThemeView',
		type: 'POST',
//		dataType: 'JSON',
		data: {orderId: orderId},
		success: function (data) {
			$("#item-table").removeClass("hide");
			$("#item-table").html(data);
		}
	});
}
function loadSetItem(cat2Id, baseUrl)
{
	$("#item-table").html('');
	$("#action-button").removeClass('hide');
	$.ajax({
		url: baseUrl + '/myfile/madrid/loadSetItem',
		type: 'POST',
//		dataType: 'JSON',
		data: {category2Id: cat2Id},
		success: function (data) {
			$("#sanitary-item").removeClass("hide");
			$("#sanitary-item").html(data);
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
function findCat2Product(sel, baseUrl)
{
	var attrName = sel.attributes['name'].value;
	var obj = $('select[name=\"' + attrName + '\"]');
	var cat1Id = obj.val();
	$.ajax({
		'url': baseUrl + '/backoffice/order/findAllProductInCat2Cat1IdAjax',
//			'dataType': 'json',
		'type': 'POST',
		'data': {'cat1Id': cat1Id},
		'success': function (data) {
			obj.parent().parent().children('.product').children('select').html(data);
		},
	});
}

function chooseProduct(sel, baseUrl)
{
	var attrName = sel.attributes['name'].value;
	var obj = $('select[name=\"' + attrName + '\"]');
	var productId = obj.val();
	$.ajax({
		'url': baseUrl + '/myfile/madrid/findProductByPk',
		'dataType': 'json',
		'type': 'POST',
		'data': {'productId': productId},
		'success': function (data) {
			obj.parent().parent().children('.price').children('.priceText').html(data.price);
			obj.parent().parent().children('.unit').children('.unitText').html(data.productUnits);
		},
	});
}

function updateSetPrice(no)
{
	for (var i = 1; i <= no; i++)
	{
		var price = $("#priceHidden_" + i).val();
		var quantity = $("#quantityText_" + i).val();
		$("#total" + i).html(price * quantity);
	}
}

function addFavourite(userId, category2Id, baseUrl, isTheme)
{
	var url = "";
	if (isTheme)
	{
		url = baseUrl + '/madrid/theme/addFavourite'
	}
	else
	{
		url = baseUrl + '/madrid/set/addFavourite'
	}
	$.ajax({
		'url': url,
		'dataType': 'json',
		'type': 'POST',
		'data': {'userId': userId, 'category2Id': category2Id, },
		'success': function (data) {
			if (data)
			{
				alert("เพิ่ม Theme สู่รายการที่ชื่นชอบสำเร็จ");
			}
			else
			{
				alert("ไม่สามารถเพิ่ม Theme สู่รายการที่ชื่นชอบสำเร็จได้ กรุณาลองใหม่อีกครั้ง");
			}
		},
	});
}

