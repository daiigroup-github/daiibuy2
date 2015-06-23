/**
 * Created by NPR on 8/13/14.
 */

$('#addToCartGinzaHome').live('click', function () {
	if (confirm('Add To Cart?')) {
		$.ajax({
			type: 'POST',
			url: baseUrl + '/ginzahome/product/addToCart',
			dataType: 'json',
			data: $('#ginzaHomeForm').serialize(),
			success: function (data) {
				//alert success message
				if (data.result)
				{
					updateCartHeader();
					alert("เพิ่มสินค้าลงตะกร้าสินค้าเรียนร้อยแล้ว");
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
			url: baseUrl + '/ginzatown/product/addToCart',
			dataType: 'json',
			data: $('#ginzaHomeForm').serialize(),
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
	}
});


function payClick(period)
{
	$('ul.setup-panel li a[href="#step-3-1"]').trigger('click');
	if (period == 2)
	{
		$("#changHouseDetail").removeClass('hide');
		$("#changHouseDetail2").removeClass('hide');
		$("#submit2").removeClass('hide');
	}
	else
	{
		$("#submit" + period).removeClass('hide');
//		goToStepSplit();
	}
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
