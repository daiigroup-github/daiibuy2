/**
 * Created by NPR on 8/13/14.
 */
$('.add-to-cart').click(function() {

	var data = {};
	var productId = $(this).data('productid');
	var qty = $('#' + productId).val();
	if (qty == 0) {
		qty = 1;
	}
//        alert(qty);
//	alert(productId + "," + qty);
	var data = {productId: productId, qty: qty};
	$.ajax({
		url: baseUrl + '/madrid/product/addToCart',
		type: 'POST',
		dataType: 'JSON',
		data: data,
		beforeSend: function() {
			return confirm('คุณต้องการเพิ่มสินค้าลงตะกร้าหรือไม่ ?')
		},
		success: function(data) {
			//alert success message
			if (data.result)
			{
				updateCartHeader();
				alert("เพิ่มสินค้าลงตะกร้าสินค้าเรียบร้อยแล้ว");
			}
			else
			{
				alert("ไม่สามารถเพิ่มสินค้าลงตะกร้าสินค้าได้");
			}
		}
	});
});

function moneyFormat(num) {
	var p = num.toFixed(2).split(".");
	return p[0].split("").reverse().reduce(function(acc, num, i, orig) {
		return  num + (i && !(i % 3) ? "," : "") + acc;
	}, "") + "." + p[1];
}

function loadThemeItem(cat2Id, baseUrl, orderId)
{

//    cate2Id = $('#Order_category2Id').attr("value");
////      alert(cate2Id);
//        if(cate2Id == cat2Id){
//	$("#sanitary-item").html("");
//	renderThemeItem(baseUrl, orderId);
	$.ajax({
		url: baseUrl + '/myfile/madrid/loadThemeItem',
		type: 'POST',
		dataType: 'JSON',
		data: {category2Id: cat2Id, orderId: orderId},
		success: function(data) {
			//alert success message
			if (data.status)
			{
				$("#action-button").removeClass('hide');

				$("#item-table").removeClass("hide");
				$("#item-table").html(data.view);

				for (var groupName in data)
				{
					if (groupName != "")
					{

						$("#productCode" + groupName).html(data[groupName]["code"]);
						$("#productName" + groupName).html(data[groupName]["name"]);
						$("#productUnits" + groupName).html(data[groupName]["productUnits"]);
						$("#productArea" + groupName).html(data[groupName]["productArea"]);
						var estimateQuantity = Math.ceil($("#supplierArea" + groupName).val() / data[groupName]["productArea"]);
//                                                alert(data[groupName]["productArea"] + ', ' +$("#supplierArea" + groupName).val());
						$("#estimateAreaQuantity" + groupName).html(estimateQuantity);
//					$("#quantityText_" + groupName).removeClass("hide");
//                                                alert(estimateQuantity);
						var price = 0.00;
						if (estimateQuantity) {
							$("#quantityText_" + groupName).val(estimateQuantity);
							price = moneyFormat(data[groupName]["price"] * estimateQuantity);
						} else {
							$("#quantityText_" + groupName).val(1);
							price = moneyFormat(parseFloat(data[groupName]["price"]));

						}
//                                                alert(estimateQuantity);
						$("#price" + groupName).html(price);
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
			else
			{
				alert(data.errorMessage);
			}
		},
	});
//    }
}
function loadSetItem(cat2Id, baseUrl)
{
//	$("#item-table").html('');
	$("#action-button").removeClass('hide');

	$.ajax({
		url: baseUrl + '/myfile/madrid/loadSetItem',
		type: 'POST',
//		dataType: 'JSON',
		data: {category2Id: cat2Id},
		success: function(data) {
			$("#sanitary-item").removeClass("hide");
			$("#sanitary-item").html(data);
		}
	});
}
function loadProductsFavItem(productId, baseUrl, orderId, provinceId)
{

//    cate2Id = $('#Order_category2Id').attr("value");
////      alert(cate2Id);
//        if(cate2Id == cat2Id){
//	$("#sanitary-item").html("");
//	renderThemeItem(baseUrl, orderId);
	$.ajax({
		url: baseUrl + '/myfile/madrid/loadProductFavItem',
		type: 'POST',
//		dataType: 'JSON',
		data: {productId: productId, orderId: orderId, provinceId: provinceId},
		success: function(data) {
			//alert success message
//			if (data.status)
//			{
			$("#action-button-tiles").removeClass('hide');
			$("#product-fav-item").removeClass("hide");
			$("#product-fav-item").html(data);
//				$("#productCode").html(data["code"]);
//				$("#code").html(data["code"]);
//				$("#productName").html(data["name"]);
//				$("#name").html(data["name"]);
//				$("#productUnits").html(data["productUnits"]);
//				$("#description").html(data["description"]);
//				$("#productArea").html(data["productArea"]);
//                                $("#noPerBox").html(data["noPerBox"]);
//                                var supplierArea = 0.00;
//                                    supplierArea = $("#supplierArea").val();
//				var estimateQuantity = data["productArea"] * $("#supplierArea").val();
//				$("#estimateAreaQuantity").html(estimateQuantity);
////					$("#quantityText_" + groupName).removeClass("hide");
//				$("#quantityText").val(estimateQuantity);
//				$("#price").html(data["price"]);
//				$("#pprice").html(data["price"] * estimateQuantity);
//				$("#priceHidden").val(data["price"]);
//				$("#OrderItems_productId").val(data["productId"]);
//				$("#image").attr("src", data["image"]);
//                                $("#quantity").val("1");
//			}
//			else
//			{
//				alert(data.errorMessage);
//			}
		},
	});
//    }
}

function updatePrice()
{
	groupNames = {a: "a", b: "b", c: "c", d: "d", e: "e", f: "f"};
	for (var groupName in groupNames)
	{
		var price = $("#priceHidden" + groupName).val();
		var quantity = $("#quantityText_" + groupName).val();
		$("#price" + groupName).html(moneyFormat(price * quantity));
	}
}



$('#manualQuantityMadrid').on('click', function() {
	if (!($("#Order_title").attr("value") == "") && !($("#selectProvince").select2('val') == "")) {
		$('ul.setup-panel li a[href="#step-4"]').trigger('click');
		$('#Order_createMyfileType').val(1);
		$('#Order_isTheme').val(1);
	} else {
		alert("กรุณากรอกชื่อ และเลือกจังหวัดใหครบถ้วน");
	}

});

$('#manualQuantityTile').on('click', function() {

//	alert($("#selectProvince").select2('val'));
	if (!($("#Order_title").attr("value") == "") && !($("#selectProvince").val() == "")) {

		$('ul.setup-panel li a[href="#step-4-1"]').trigger('click');
		$('#Order_createMyfileType').val(1);
		$('#Order_isTheme').val(3);
		$.ajax({
			url: baseUrl + '/myfile/madrid/prepareProductsFav',
			type: 'POST',
			dataType: 'JSON',
			data: {provinceId: $("#selectProvince").val()},
			success: function(data) {
				$("#productsFavResult").html(data.products);
			}});
	} else {
		alert("กรุณากรอกชื่อ และเลือกจังหวัดใหครบถ้วน");
	}

});
$('#uploadPlanMadrid').on('click', function() {
	if (!($("#Order_title").attr("value") == "") && !($("#selectProvince").select2('val') == "")) {
		$('ul.setup-panel li a[href="#step-3"]').trigger('click');
		$('#Order_createMyfileType').val(2);
		$('#Order_isTheme').val(1);
	} else {
		alert("กรุณากรอกชื่อ และเลือกจังหวัดใหครบถ้วน");
	}
});

$('#uploadPlanTile').on('click', function() {
	if (!($("#Order_title").attr("value") == "") && !($("#selectProvince").select2('val') == "")) {
		$('ul.setup-panel li a[href="#step-3"]').trigger('click');
		$('#Order_createMyfileType').val(2);
		$('#Order_isTheme').val(3);
	} else {
		alert("กรุณากรอกชื่อ และเลือกจังหวัดใหครบถ้วน");
	}
});

$('.chooseStyle').click(function() {
//    alert($('#chooseStyle').attr("name"));
//                 alert($('#Order_category2Id'));
	cate2Id = $(this).attr("name");
	$('#Order_isTheme').val(1);
//                    alert(cate2Id);
	$('#OrderDetailValue_9_value').val(cate2Id);
	$.ajax({
		url: baseUrl + '/myfile/madrid/prepareThemeAndSet',
		type: 'POST',
		dataType: 'JSON',
		data: {category2Id: cate2Id},
		success: function(data) {
			//alert success message
//			alert(data.themes);
			if (data.status)
			{
				$("#themeResult").html(data.themes);
				$("#setResult").html(data.sets);
//				$("#action-button").removeClass('hide');
//				$("#item-table").removeClass("hide");
//				$("#item-table").html(data.view);
//
//				for (var groupName in data)
//				{
//					if (groupName != "")
//					{
//
//						$("#productCode" + groupName).html(data[groupName]["code"]);
//						$("#productName" + groupName).html(data[groupName]["name"]);
//						$("#productUnits" + groupName).html(data[groupName]["productUnits"]);
//						$("#productArea" + groupName).html(data[groupName]["productArea"]);
//						var estimateQuantity = data[groupName]["productArea"] * $("#supplierArea" + groupName).val();
//						$("#estimateAreaQuantity" + groupName).html(estimateQuantity);
////					$("#quantityText_" + groupName).removeClass("hide");
//						$("#quantityText_" + groupName).val(estimateQuantity);
//						$("#price" + groupName).html(data[groupName]["price"] * estimateQuantity);
//						$("#priceHidden" + groupName).val(data[groupName]["price"]);
//						$("#productId" + groupName).val(data[groupName]["productId"]);
//					}
//					else
//					{
//						groupNames = {a: "a", b: "b", c: "c", d: "d", e: "e"};
//						for (var groupName in groupNames)
//						{
//							$("#productCode" + groupName).html("");
//							$("#productName" + groupName).html("");
//							$("#productUnits" + groupName).html("");
//							$("#productArea" + groupName).html("");
//							$("#estimateAreaQuantity" + groupName).html("");
////						$("#quantityText_" + groupName).addClass("hide");
//							$("#quantityText_" + groupName).val(0);
//							$("#price" + groupName).html("");
//							$("#priceHidden" + groupName).val(0);
//							$("#productId" + groupName).val(0);
//						}
//					}
//				}
			}
			else
			{
				alert(data.errorMessage);
			}
		},
	});
//                  alert($('#Order_category2Id').attr("value"));
	$('ul.setup-panel li a[href="#step-2"]').trigger('click');

//	if (!($("#Order_title").attr("value") == "") && !($("#selectProvince").select2('val') == "")) {
//		$('ul.setup-panel li a[href="#step-3"]').trigger('click');
//		$('#Order_createMyfileType').val(2);
//	} else {
//		alert("กรุณากรอกชื่อ และเลือกจังหวัดใหครบถ้วน");
//	}

});

function findModelTile(sel, baseUrl)
{
	var attrName = sel.attributes['name'].value;
	var obj = $('select[name=\"' + attrName + '\"]');
	var brandId = obj.val();
	$.ajax({
		'url': baseUrl + '/backoffice/order/findTileModelByBrandIdAjax',
//			'dataType': 'json',
		'type': 'POST',
		'data': {'brandId': brandId},
		'success': function(data) {
			obj.parent().parent().children('.model').children('select').html(data);
		},
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
		'success': function(data) {
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
		'success': function(data) {
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
		'success': function(data) {
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
		'success': function(data) {
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
		$("#total" + i).html(moneyFormat(price * quantity));
		alert(moneyFormat(price * quantity));
	}
}

function addFavourite(userId, category2Id, baseUrl, isTheme)
{
	var url = "";
	var word = "";
	if (isTheme == 1)
	{
		url = baseUrl + '/madrid/theme/addFavourite'
		word = "Theme";
	}
	else if (isTheme == 0)
	{
		url = baseUrl + '/madrid/set/addFavourite'
		word = "Set";
	} else {
		url = baseUrl + '/madrid/product/addFavourite'
		word = "Floor Tile";
	}
	$.ajax({
		'url': url,
		'dataType': 'json',
		'type': 'POST',
		'data': {'userId': userId, 'category2Id': category2Id, },
		'success': function(data) {
			if (data == 1)
			{
				alert("เพิ่ม " + word + " สู่รายการที่ชื่นชอบสำเร็จ");
			}
			else if (data == 2)
			{
				alert("ไม่สามารถเพิ่ม " + word + " สู่รายการที่ชื่นชอบสำเร็จได้ กรุณาลองใหม่อีกครั้ง");
			}
			else
			{
				alert(word + " นี้ได้ถูกเพิ่มในรายการที่ชื่นชอบอยู่แล้ว");
			}
		},
	});
}

function checkComment()
{
	if ($("#OrderDetailValue_4_value").val() == "")
	{
		alert("กรุณากรอกคำร้อง");
		return false;
	}
	else
	{
		$('#Order_createMyfileType').val(2);
		return true;
	}
}

function addFavouriteProduct(userId, productId, baseUrl)
{
	var url = "";
	url = baseUrl + '/madrid/category/addFavouriteProduct'
	$.ajax({
		'url': url,
		'dataType': 'json',
		'type': 'POST',
		'data': {'userId': userId, 'productId': productId, },
		'success': function(data) {
			if (data == 1)
			{
				alert("เพิ่ม สินค้า สู่รายการที่ชื่นชอบสำเร็จ");
			}
			else if (data == 2)
			{
				alert("ไม่สามารถเพิ่ม สินค้า สู่รายการที่ชื่นชอบสำเร็จได้ กรุณาลองใหม่อีกครั้ง");
			}
			else
			{
				alert("คุณเพิ่มรายการนี้ เข้าสู่รายการที่ชื่นชอบไปแล้ว");
			}
		},
	});
}
