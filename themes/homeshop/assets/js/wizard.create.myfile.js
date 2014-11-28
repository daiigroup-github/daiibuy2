//$(document).ready(function() {

var navListItems = $('ul.setup-panel li a'),
		allWells = $('.setup-content');
allWells.hide();
navListItems.click(function(e)
{
	e.preventDefault();
	var $target = $($(this).attr('href')),
			$item = $(this).closest('li');
	if (!$item.hasClass('disabled')) {
		navListItems.closest('li').removeClass('active');
		$item.addClass('active');
		allWells.hide();
		$target.show();
	}
});
$('ul.setup-panel li.active a').trigger('click');
$('#nextToStep2').on('click', function(e) {
//		$('ul.setup-panel li:eq(1)').removeClass('disabled');
	$('ul.setup-panel li a[href="#step-2"]').trigger('click');
//		$(this).remove();
});
$('#backToStep1').on('click', function(e) {
	$('ul.setup-panel li a[href="#step-1"]').trigger('click');
});
$('#nextToStep3').on('click', function(e) {
	var base_url = baseUrl;
	$.ajax({
		url: base_url + '/myfile/fenzer/showProductOrder',
		type: 'POST',
		data: $("#ggg").serialize() + '&categoryId=' + $('#height_input').attr('name') + '&cat1Id=' + $('#length_input').attr('name') + '&length=' + $('#length_input').attr('value') + '&height=' + $('#selectHeight').attr('value'),
//				'length': $('#length_input').attr('value'),
//				'height': $('#selectHeight').attr('value'),
//			},
		success: function(data) {
			$("#order_list").html(data);
		}
	});
	$('ul.setup-panel li a[href="#step-3"]').trigger('click');
});
$('#backToStep2').on('click', function(e) {
	$('ul.setup-panel li a[href="#step-2"]').trigger('click');
});
$('#backToStep2-2').on('click', function(e) {
	$('ul.setup-panel li a[href="#step-2-2"]').trigger('click');
});
$('#backToStep3').on('click', function(e) {
	$('ul.setup-panel li a[href="#step-3"]').trigger('click');
});
$('#addToCart').on('click', function(e) {
	var base_url = baseUrl;
	var orderId = $("#order").attr("name");
	if (orderId === null)
	{
		orderId = $(this).attr("name");
	}
//		alert(orderId);
	$.ajax({
		url: base_url + '/myfile/fenzer/addToCart',
		type: 'POST',
		data: {'orderId': orderId},
		success: function(data) {
		}
	});
	window.location.assign(base_url + '/myfile/fenzer/');
});
$('#finish').on('click', function(e) {
	var base_url = baseUrl;
	window.location.assign(base_url + '/myfile/fenzer/');
});
var fenzerSave = true;
$('#nextToStep4').live('click', function(e) {

//save order
	var base_url = baseUrl;
	var length = $("#length_input").attr("value");
	var cat1Id = $("#length_input").attr("name");
	var categoryId = $("#editTable").attr("name");
//		alert(categoryId);
	var productItems = $("#editTableForm").serialize();
	if (fenzerSave == true) {
		$.ajax({
			url: base_url + '/myfile/fenzer/saveOrderMyFile',
			type: 'POST',
			data: $("#editTableForm").serialize() + '&length=' + length + '&cat1Id=' + cat1Id + '&categoryId=' + categoryId + "&" + $("#ggg").serialize(),
			success: function(data) {
				$("#confirm_content").html(data);
				$('ul.setup-panel li a[href="#step-4"]').trigger('click');
			}
		});
	}

	fenzerSave = false;
	/*
	 $.ajax({
	 url: base_url + '/myfile/fenzer/saveOrderMyFile',
	 type: 'POST',
	 data: $("#editTableForm").serialize() + '&length=' + length + '&categoryId=' + categoryId + "&" + $("#ggg").serialize(),
	 success: function(data) {
	 $("#confirm_content").html(data);
	 $('ul.setup-panel li a[href="#step-4"]').trigger('click');
	 }
	 });
	 */
});
//view Myfile Fenzer
$('#nextToStep4Edit').on('click', function(e) {

//save order
	var base_url = baseUrl;
	var orderId = $("#nextToStep4Edit").attr("name");
	var length = $("#length_input").attr("value");
	var cat1Id = $("#length_input").attr("name");
	var categoryId = $("#editTable").attr("name");
//		alert(categoryId);
	var productItems = $("#editTableForm").serialize();
	$.ajax({
		url: base_url + '/myfile/fenzer/saveOrderMyFile',
		type: 'POST',
		data: $("#editTableForm").serialize() + '&length=' + length + '&cat1Id=' + cat1Id + '&categoryId=' + categoryId + '&orderId=' + orderId + "&" + $("#ggg").serialize(),
		success: function(data) {
			$("#confirm_content").html(data);
		}
	});
	$('ul.setup-panel li a[href="#step-4"]').trigger('click');
});
//clickable Row
var clickable = true;
$(".clickableRow").click(function() {
	if (clickable == true) {
		var base_url = baseUrl;
		var categoryId = $(this).attr("id");
//		alert(categoryId);
		var height = $(this).attr("name");
//	alert($(this).attr("style"));
		var cat1Id = $(this).attr("style");
		$.ajax({
			url: base_url + '/myfile/fenzer/showProductSelected',
			type: 'POST',
			data: {'categoryId': categoryId},
			success: function(data) {
				$("#select_content").html(data);
			}
		});
		$('#height_input')[0].setAttribute('value', height);
		$('#height_input')[0].setAttribute('name', categoryId);
		$('#length_input')[0].setAttribute('name', cat1Id);
		this.setAttribute("class", "clickableRow active");
		clickable = false;
		$("#nextToStep3").removeClass('hidden');
	}
});
//delete row
//	$(".deleteRow").click(function() {
//		if (confirm('ยืนยันเพื่อลบรายการสินค้านี้?')) {
//			$(this).parent().parent().remove();
//		}
//	});
$("#deleteRow").live('click', function() {
	if (confirm('ยืนยันเพื่อลบรายการสินค้านี้?')) {
		$(this).parent().parent().remove();
	}
});
//calculatePrice

//$("#selectProvince").live('click', function() {
//	$("#nextToStep2").show();
//});

$('#calculatePrice').on('click', function() {
	var update = 1;
	if (update == 1) {
		var length = $("#length_input").attr("value");
		var categoryId = $("#editTable").attr("name");
		var cat1Id = $("#length_input").attr("name");
		var productItems = $("#editTableForm").serialize();
		$.ajax({
			url: baseUrl + '/myfile/fenzer/updatePrice',
			type: 'POST',
			data: $("#editTableForm").serialize() + '&length=' + length + '&cat1Id=' + cat1Id + '&categoryId=' + categoryId + "&" + $("#ggg").serialize(),
			success: function(data) {
				$("#result_content").html(data);
				update = update + 1;
			}
		});
	}
});
//	$('#nextToStep3')

//Upload Plan Atech
$('#uploadPlanAtech').on('click', function() {
//check title and province
	if (!($("#Order_title").attr("value") == "") && !($("#selectProvince").select2('val') == "")) {
		$('ul.setup-panel li a[href="#step-2"]').trigger('click');
	} else {
		alert("กรุณากรอกชื่อ และเลือกจังหวัดใหครบถ้วน");
	}
});
$('#manualQuantityAtech').on('click', function() {
	//check title and province
	if (!($("#Order_title").attr("value") == "") && !($("#selectProvince").select2('val') == "")) {
		$('ul.setup-panel li a[href="#step-2-2"]').trigger('click');
	} else {
		alert("กรุณากรอกชื่อ และเลือกจังหวัดใหครบถ้วน");
	}
//		var base_url = baseUrl;
//		var title = $("#myfile_title").attr("value");
//		var provinceId = $("#selectProvince").attr("value");
//		alert(title);
//		alert(provinceId);
//		var productItems = $("#editTableForm").serialize();
//		$.ajax({
//			url: base_url + '/myfile/atechWindow/saveTitleAndProvinceId',
//			type: 'POST',
//			data: {'provinceId': provinceId, 'title': title},
//			success: function(data) {
//				$("#upload_plan").html(data);
//			}
//		});

});
$('#nextToStep3Atech').on('click', function() {

	var base_url = baseUrl;
	var title = $("#Order_title").attr("value");
	var provinceId = $("#selectProvince").attr("value");
//		alert($("#aa").serialize());
//		alert(categoryId);
//		alert(title + ", " + provinceId);
	$.ajax({
		url: base_url + '/myfile/atechWindow/calculatePriceMyFile',
		type: 'POST',
		data: $("#aa").serialize() + '&title=' + title + '&provinceId=' + provinceId,
		success: function(data) {
//				alert("ya");
			$("#atech_result").html(data);
		}
	});
	$('ul.setup-panel li a[href="#step-3"]').trigger('click');
});
$(".atechNav").click(function() {
	var base_url = baseUrl;
	var brandModelId = $(this).attr("name");
	var title = $("#Order_title").attr("value");
	var provinceId = $("#selectProvince").attr("value");
//		alert($("#aa").serialize());
//		alert($("#editTableForm").serialize());
//		alert(title + ", " + provinceId + ", " + brandModelId);
	$.ajax({
		url: base_url + '/myfile/atechWindow/updatePriceMyFile',
		type: 'POST',
		data: $("#aa").serialize() + '&title=' + title + '&provinceId=' + provinceId + '&brandModelId=' + brandModelId + "&" + $("#editTableForm").serialize(),
		success: function(data) {
			$("#atech_result").html(data);
			navClick = false;
		}
	});
//		this.setAttribute("class", "atechNav active");

});
$(".atechUpdate").click(function() {
	var base_url = baseUrl;
	var brandModelId = $(this).attr("name");
	var title = $("#Order_title").attr("value");
	var provinceId = $("#selectProvince").attr("value");
//		alert($("#editTableForm").serialize());
//		alert(title + ", " + provinceId + ", " + brandModelId);
	$.ajax({
		url: base_url + '/myfile/atechWindow/updatePriceMyFile',
		type: 'POST',
		data: $("#editTableForm").serialize() + '&title=' + title + '&provinceId=' + provinceId + '&brandModelId=' + brandModelId,
		success: function(data) {
			$("#atech_result").html(data);
		}
	});
//		this.setAttribute("class", "atechNav active");
});
var atechSave = true;
$('#nextToStep4Atech').click(function(e) {

//save order
	if (atechSave)
	{
		var base_url = baseUrl;
		var orderId = $(this).attr("name");
		var title = $("#Order_title").attr("value");
		var provinceId = $("#selectProvince").attr("value");
		var brandModelId = $("#updateButton").attr("name");
		$.ajax({
			url: base_url + '/myfile/atechWindow/saveMyFileAtech',
			type: 'POST',
			data: $("#editTableForm").serialize() + '&title=' + title + '&provinceId=' + provinceId + '&orderId=' + orderId + '&brandModelId=' + brandModelId,
			success: function(data) {
				$("#confirm_product").html(data);
				$('ul.setup-panel li a[href="#step-4"]').trigger('click');
				atechSave = false;
			}
		});
	}
});
var addData = true;
$('#addNewItemFenzer').on('click', function(e) {
	if (addData == true)
	{
		$.ajax({
			url: baseUrl + '/myfile/fenzer/addNewProductItem',
			type: 'POST',
			dataType: 'html',
			data: $("#addItem").serialize() + "&" + $("#ggg").serialize(),
			success: function(data) {
				$("#editTable").append(data);
				addData = false;
			}
		});
	}
});
$('#addToCartAtech').on('click', function(e) {
	var base_url = baseUrl;
	var orderId = $("#order").attr("name");
	if (orderId === null)
	{
		orderId = $(this).attr("name");
	}
//		alert(orderId);
	$.ajax({
		url: base_url + '/myfile/atechWindow/addToCart',
		type: 'POST',
		data: {'orderId': orderId},
		success: function(data) {
		}
	});
	window.location.assign(base_url + '/myfile/fenzer/');
});