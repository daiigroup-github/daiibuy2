/**
 * Created by NPR on 8/13/14.
 */

$('#addToCartGinzaHome').live('click', function () {
	if (confirm('Add To Cart?')) {
		$.ajax({
			type: 'POST',
			url: baseUrl + '/ginzaTown/product/addToCart',
			dataType: 'json',
			data: $('#ginzaHomeForm').serialize(),
			success: function (data) {
				//alert success message
				if (data.result)
				{
					updateCartHeader();
					alert("เพิ่มสินค้าลงตะกร้าสินค้าเรียบร้อยแล้ว");
				}
				else
				{
					alert("ไม่สามารถเพิ่มสินค้าลงตะกร้าสินค้าได้" + data.message);
				}
			}
		});
	}
});

$('#addToCartGinzaTown').live('click', function () {
	if (confirm('Add To Cart?')) {
		$.ajax({
			type: 'POST',
			url: baseUrl + '/ginzaTown/product/addToCart',
			dataType: 'json',
			data: $('#ginzaHomeForm').serialize(),
			success: function (data) {
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
	}
});


function payClick(period)
{
	$('ul.setup-panel li a[href="#step-3-1"]').trigger('click');
	$.ajax({
		type: 'POST',
		url: baseUrl + 'index.php/myfile/ginzaTown/renderCondition',
//		dataType: 'json',
		data: $("#payForm" + period).serialize(),
		success: function (data) {
			$("#conditionDiv").html(data);
			if (period == 2)
			{
				$("#changHouseDetail").removeClass('hide');
				$("#changHouseDetail2").removeClass('hide');
				$("#period" + period).removeClass("hide");
				$("#submit2").removeClass('hide');
			}
			else
			{
				$("#submit" + period).removeClass('hide');
//		goToStepSplit();
			}
		}
	});

}

function backToStep3()
{
	$('ul.setup-panel li a[href="#step-3"]').trigger('click');
}
function goToStepSplit(period)
{
	if (period == 2)
	{
		$("#payForm2").submit();
	}
	else
	{
		$('ul.setup-panel li a[href="#step-3-2"]').trigger('click');
		$("#period" + period).removeClass("hide");
	}
}
function pay(period)
{
	$("#payForm" + period).submit();
//	alert(period);
//	$("#condition" + period + "Modal").modal("show");
}

function formSubmit()
{

}

$('#furniture1Next').live('click', function () {
	var funitureGroupId = $("input:radio[name=furnitureGroupId]:checked").val();
	if (typeof (funitureGroupId) == "undefined")
	{
		alert("กรุณาเลือกชุดเฟอร์นิเจอร์");
	}
	else
	{
		$.ajax({
			type: 'POST',
			url: baseUrl + 'index.php/myfile/ginzaTown/furnitureColor',
//			dataType: 'json',
			data: {'furnitureGroupId': funitureGroupId, 'orderGroupId': $("#orderGroupId").val()},
			success: function (data) {
				//alert success message
				if (data)
				{
					$("#step2").html(data);
				}
				else
				{
					alert("ไม่สามารถเพิ่มสินค้าลงตะกร้าสินค้าได้");
				}
			}
		});
		$('ul.setup-panel li a[href="#step2"]').trigger('click');
	}

});
$('#furniture2Back').live('click', function () {
	$('ul.setup-panel li a[href="#step1"]').trigger('click');
});
$('#furniture2Next').live('click', function () {
	var funitureId = $("input:radio[name=furnitureId]:checked").val();
	if (typeof (funitureId) == "undefined")
	{
		alert("กรุณาเลือกสีเฟอร์นิเจอร์");
	}
	else
	{
		$.ajax({
			type: 'POST',
			url: baseUrl + 'index.php/myfile/ginzaTown/furnitureItem',
//			dataType: 'json',
			data: {'furnitureId': funitureId},
			success: function (data) {
				//alert success message
				if (data)
				{
					$("#step3").html(data);
				}
				else
				{
					alert("ไม่สามารถเพิ่มสินค้าลงตะกร้าสินค้าได้");
				}
			}
		});
		$('ul.setup-panel li a[href="#step3"]').trigger('click');
	}

});

function showFurnitureItemSub(furnitureItemId)
{
	$.ajax({
		type: 'POST',
		url: baseUrl + 'index.php/myfile/ginzaTown/furnitureItemSub',
		dataType: 'json',
		data: {'furnitureItemId': furnitureItemId},
		success: function (data) {
			//alert success message
			if (data.status)
			{
				$("#furnitureItemSub").html(data.furnitureItemSub);
				$("#planName").html(data.planName);
				$("#planImage").html(data.planImage);
			}
			else
			{
				alert("ไม่สามารถเพิ่มสินค้าลงตะกร้าสินค้าได้");
			}
		}
	});
}
$('#furniture3Back').live('click', function () {
	$('ul.setup-panel li a[href="#step2"]').trigger('click');
});
$('#furniture3Next').live('click', function () {
	$('ul.setup-panel li a[href="#step4"]').trigger('click');
});
$('#furniture4Back').live('click', function () {
	$('ul.setup-panel li a[href="#step3"]').trigger('click');
});
$('#furniture4Next').live('click', function () {

	var accept = $("input:radio[name=accept]:checked").val();
	if (typeof (accept) == "undefined")
	{
		alert("กรุณาเลือกยอมรับเงื่อนไข");
	}
	else
	{
		// Submit Form
		$("#furniture-form").submit();
	}
});

//Ginza Town Create
$('#nextCreate1').live('click', function () {
	if ($("#Order_title").val() != "" && $("#selectProvince").val() != "")
	{
		$('ul.setup-panel li a[href="#step-c2"]').trigger('click');
	}
	else
	{
		alert("กรุณาระบุชื่อ แฟ้มของฉัน และ เลือกจังหวัด");
	}
});
$('#backCreate2').live('click', function () {
	$('ul.setup-panel li a[href="#step-c1"]').trigger('click');
});
$('#nextCreate2').live('click', function () {
	if ($("#category2Id").val() != "")
	{
		$.ajax({
			type: 'POST',
			url: baseUrl + '/index.php/myfile/ginzaTown/prepareMyfileItem',
//			dataType: 'json',
			data: $("#ginzatown-form").serialize(),
			success: function (data) {
				//alert success message
				if (data)
				{
					$('ul.setup-panel li a[href="#step-c3"]').trigger('click');
					$("#orderItems").html(data);
//				$("#planName").html(data.planName);
//				$("#planImage").html(data.planImage);
				}
				else
				{
					alert("ไม่สามารถเพิ่มสินค้าลงตะกร้าสินค้าได้");
				}
			}
		});


	}
	else
	{
		alert("กรุณาเลือกสินค้าเพื่อสร้าง Myfile");
	}
});
$('#backCreate3').live('click', function () {
	$('ul.setup-panel li a[href="#step-c2"]').trigger('click');
});
$('#finishCreate3').live('click', function () {
	$.ajax({
		type: 'POST',
		url: baseUrl + 'index.php/myfile/ginzaTown/finish',
		dataType: 'json',
		data: $("#ginzatown-form").serialize(),
		success: function (data) {
			//alert success message
			if (data.status)
			{
				$("#orderId").val(data.orderId)
				$("#finishCreate3").addClass("hide");
				$("#backCreate3").addClass("hide");
				$("#requestSpecialCreate3").removeClass("hide");
				$("#addToCartCreate3").removeClass("hide");
			}
			else
			{
				alert("ไม่สามารถบันทึกได้");
			}
		}
	});
});

$('#addToCartCreate3').live('click', function () {
	$.ajax({
		type: 'POST',
		url: baseUrl + 'index.php/myfile/ginzaTown/addToCart',
		dataType: 'json',
		data: {'orderId': $("#orderId").val()},
		success: function (data) {
			//alert success message
			if (data.status)
			{
//				$("#requestSpecialCreate3").removeClass("hide");
				updateCartHeader();
				$("#addToCartCreate3").addClass("hide");
			}
			else
			{
				alert("ไม่สามารถบันทึกได้");
			}
		}
	});
});

$('#requestSpecialCreate3').live('click', function () {
	$.ajax({
		type: 'POST',
		url: baseUrl + 'index.php/myfile/ginzaTown/requestGinzatownSpacialProject',
		dataType: 'json',
		data: {'orderId': $("#orderId").val()},
		success: function (data) {
			//alert success message
			if (data.status)
			{
				$("#requestSpecialCreate3").addClass("hide");
				$("#spSending").removeClass("hide");
				updateCartHeader();
//				$("#addToCartCreate3").addClass("hide");
			}
			else
			{
				alert("ไม่สามารถบันทึกได้");
			}
		}
	});
});

