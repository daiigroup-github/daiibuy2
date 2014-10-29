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
					}
				}
			}
		}
	});
}
function updatePrice()
{
	groupNames = {a: "a", b: "b", c: "c", d: "d", e: "e"};
	for (var groupName in groupNames)
	{
		var price = $("#priceHidden" + groupName).val();
		var quantity = $("#quantityText_" + groupName).val();
		$("#price" + groupName).html(price * quantity);
	}
}

$('#manualQuantityMadrid').on('click', function () {
	$('ul.setup-panel li a[href="#step-3"]').trigger('click');
});
