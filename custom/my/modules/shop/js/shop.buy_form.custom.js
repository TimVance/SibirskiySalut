$(document).on('click', '.js_shop_wishlist, .shop-like', function(e) {

	$(this).toggleClass("active");
    
    var i = $(this).find(".fa");
    if(i.hasClass("fa-heart-o")) {
        i.removeClass("fa-heart-o").addClass("fa-heart");
    }
    else {
        i.removeClass("fa-heart").addClass("fa-heart-o");
    }
});
$(document).on('click', 'input[action=one_click]', function() {
	$key = $(this).data('key');
	$('#oneClickModal' + ($key ? '_' + $key : '')).modal();
});