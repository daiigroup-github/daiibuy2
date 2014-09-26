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
			data: {'productId': $('#height').attr('name'),
				'length': $('#length_input').attr('value'),
				'height': $('#height_input').attr('value'),
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
	$('#nextToStep4').on('click', function(e) {
		$('ul.setup-panel li a[href="#step-4"]').trigger('click');
	});
//clickable Row
	$(".clickableRow").click(function() {
		var base_url = window.location.origin;
		var productId = $(this).attr("id");
		var height = $(this).attr("name");
		$.ajax({
			url: base_url + '/daiibuy2/myfile/fenzer/showProductSelected',
			type: 'POST',
			data: {'productId': productId},
			success: function(data) {
				$("#select_content").html(data);
			}
		});
		$('#height_input')[0].setAttribute('value', height);
		$('#height_input')[0].setAttribute('name', productId);
		this.setAttribute("class", "clickableRow active");
	});

//	$('#nextToStep3')
});