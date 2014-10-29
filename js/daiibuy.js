/**
 * Created by NPR on 8/13/14.
 */

var baseUrl = (window.location.host === 'dev') ? 'http://dev/daiibuy2/' : window.location.origin + '/daiibuy2/';
function addToCart(productId) {
	alert('productId' + productId);

	//ajax add to db

}

$(document).ready(function(){
    updateCartHeader();
});

function updateCartHeader() {
    $.ajax({
        type: 'POST',
        url: baseUrl+'/cart/updateCartHeader',
        dataType: 'json',
        success: function (data){
            $('#cartHeader').html(data.cartHeader);
            $('#cartHeaderTable').html(data.cartHeaderTable);
        }
    });
}