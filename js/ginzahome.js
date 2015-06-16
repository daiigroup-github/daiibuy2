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
					alert("ไม่สามารถเพิ่มสินค้าลงตะกร้าสินค้าได้");
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
	period = 2;
	if (period == 2)
	{
		$('ul.setup-panel li a[href="#step-3-1"]').trigger('click');
	}
	else
	{
		$('ul.setup-panel li a[href="#step-3-2"]').trigger('click');
		$("#period" + period).removeClass("hide");
	}
}

function backToStep3()
{
	$('ul.setup-panel li a[href="#step-3"]').trigger('click');
}
function pay(period)
{
	alert(period);
	$("#condition" + period + "Modal").modal("show");
}
