$(document).ready(function() {

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
		var base_url = window.location.origin;
		$.ajax({
			url: base_url + '/daiibuy2/myfile/fenzer/showProductOrder',
			type: 'POST',
			data: {'categoryId': $('#height_input').attr('name'),
				'length': $('#length_input').attr('value'),
				'height': $('#selectHeight').attr('value'),
			},
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
		var base_url = window.location.origin;
		var orderId = $("#order").attr("name");
		if (orderId === null)
		{
			orderId = $(this).attr("name");
		}
//		alert(orderId);
		$.ajax({
			url: base_url + '/daiibuy2/myfile/fenzer/addToCart',
			type: 'POST',
			data: {'orderId': orderId},
			success: function(data) {
			}
		});
		window.location.assign(base_url + '/daiibuy2/myfile/fenzer/');
	});
	$('#finish').on('click', function(e) {
		var base_url = window.location.origin;
		window.location.assign(base_url + '/daiibuy2/myfile/fenzer/');
	});
	$('#nextToStep4').on('click', function(e) {

//save order
		var base_url = window.location.origin;
		var length = $("#length_input").attr("value");
		var categoryId = $("#editTable").attr("name");
//		alert(categoryId);
		var productItems = $("#editTableForm").serialize();
		$.ajax({
			url: base_url + '/daiibuy2/myfile/fenzer/saveOrderMyFile',
			type: 'POST',
			data: $("#editTableForm").serialize() + '&length=' + length + '&categoryId=' + categoryId,
			success: function(data) {
				$("#confirm_content").html(data);
			}
		});
		$('ul.setup-panel li a[href="#step-4"]').trigger('click');
	});
//view Myfile Fenzer
	$('#nextToStep4Edit').on('click', function(e) {

//save order
		var base_url = window.location.origin;
		var orderId = $("#nextToStep4Edit").attr("name");
		var length = $("#length_input").attr("value");
		var categoryId = $("#editTable").attr("name");
//		alert(categoryId);
		var productItems = $("#editTableForm").serialize();
		$.ajax({
			url: base_url + '/daiibuy2/myfile/fenzer/saveOrderMyFile',
			type: 'POST',
			data: $("#editTableForm").serialize() + '&length=' + length + '&categoryId=' + categoryId + '&orderId=' + orderId,
			success: function(data) {
				$("#confirm_content").html(data);
			}
		});
		$('ul.setup-panel li a[href="#step-4"]').trigger('click');
	});
//clickable Row
	$(".clickableRow").click(function() {
		var base_url = window.location.origin;
		var categoryId = $(this).attr("id");
//		alert(categoryId);
		var height = $(this).attr("name");
		$.ajax({
			url: base_url + '/daiibuy2/myfile/fenzer/showProductSelected',
			type: 'POST',
			data: {'categoryId': categoryId},
			success: function(data) {
				$("#select_content").html(data);
			}
		});
		$('#height_input')[0].setAttribute('value', height);
		$('#height_input')[0].setAttribute('name', categoryId);
		this.setAttribute("class", "clickableRow active");
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
	$('#calculatePrice').on('click', function() {
		var base_url = window.location.origin;
		var length = $("#length_input").attr("value");
		var categoryId = $("#editTable").attr("name");
//		alert(categoryId);
		var productItems = $("#editTableForm").serialize();
		alert(productItems);
		$.ajax({
			url: base_url + '/daiibuy2/myfile/fenzer/updatePrice',
			type: 'POST',
			data: $("#editTableForm").serialize() + '&length=' + length + '&categoryId=' + categoryId,
			success: function(data) {
				$("#result_content").html(data);
			}
		});
//		alert($(this).attr("name"));
	});
//	$('#nextToStep3')

//Upload Plan Atech
	$('#uploadPlanAtech').on('click', function() {
		$('ul.setup-panel li a[href="#step-2"]').trigger('click');
	});
	$('#manualQuantityAtech').on('click', function() {
//		var base_url = window.location.origin;
//		var title = $("#myfile_title").attr("value");
//		var provinceId = $("#selectProvince").attr("value");
//		alert(title);
//		alert(provinceId);
//		var productItems = $("#editTableForm").serialize();
//		$.ajax({
//			url: base_url + '/daiibuy2/myfile/atechWindow/saveTitleAndProvinceId',
//			type: 'POST',
//			data: {'provinceId': provinceId, 'title': title},
//			success: function(data) {
//				$("#upload_plan").html(data);
//			}
//		});
		$('ul.setup-panel li a[href="#step-2-2"]').trigger('click');
	});

	$('#nextToStep3Atech').on('click', function() {

		var base_url = window.location.origin;
		var title = $("#Order_title").attr("value");
		var provinceId = $("#selectProvince").attr("value");
//		alert($("#aa").serialize());
//		alert(categoryId);
//		alert(title + ", " + provinceId);
		$.ajax({
			url: base_url + '/daiibuy2/myfile/atechWindow/calculatePriceMyFile',
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
		var base_url = window.location.origin;
		var brandModelId = $(this).attr("name");
		var title = $("#Order_title").attr("value");
		var provinceId = $("#selectProvince").attr("value");
		alert($("#aa").serialize());
		alert($("#editTableForm").serialize());
		alert(title + ", " + provinceId + ", " + brandModelId);
		$.ajax({
			url: base_url + '/daiibuy2/myfile/atechWindow/updatePriceMyFile',
			type: 'POST',
			data: $("#aa").serialize() + '&title=' + title + '&provinceId=' + provinceId + '&brandModelId=' + brandModelId + "&" + $("#editTableForm").serialize(),
			success: function(data) {
				$("#atech_result").html(data);
			}
		});
//		this.setAttribute("class", "atechNav active");
	});

	$(".atechUpdate").click(function() {
		var base_url = window.location.origin;
		var brandModelId = $(this).attr("name");
		var title = $("#Order_title").attr("value");
		var provinceId = $("#selectProvince").attr("value");
		alert($("#editTableForm").serialize());
		alert(title + ", " + provinceId + ", " + brandModelId);
		$.ajax({
			url: base_url + '/daiibuy2/myfile/atechWindow/updatePriceMyFile',
			type: 'POST',
			data: $("#editTableForm").serialize() + '&title=' + title + '&provinceId=' + provinceId + '&brandModelId=' + brandModelId,
			success: function(data) {
				$("#atech_result").html(data);
			}
		});
//		this.setAttribute("class", "atechNav active");
	});

	$('#nextToStep4Atech').on('click', function(e) {

//save order
		var base_url = window.location.origin;
		var brandModelId = $(this).attr("name");
		var title = $("#Order_title").attr("value");
		var provinceId = $("#selectProvince").attr("value");
		$.ajax({
			url: base_url + '/daiibuy2/myfile/atechWindow/saveMyFileAtech',
			type: 'POST',
			data: $("#editTableForm").serialize() + '&title=' + title + '&provinceId=' + provinceId + '&brandModelId=' + brandModelId,
			success: function(data) {
				$("#atech_result").html(data);
			}
		});
		$('ul.setup-panel li a[href="#step-4"]').trigger('click');
	});

});