/**
 * JS-сценарий модуля
 * 
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    5.4
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2015 OOO «Диафан» (http://www.diafan.ru/)
 */

var rating = 0;

$(document).on('click', '.js_rating_votes', function(){
	if($(this).attr("disabled") == "disabled")
	{
		return false;
	}
	$.ajax({
		data: {
			module : "rating",
			element_id: $(this).attr("element_id"),
			module_name: $(this).attr("module_name"),
			element_type: $(this).attr("element_type"),
			action: 'add',
			rating: rating
		},
		type : 'POST'
	});
	$(this).attr("disabled", "disabled");
	return false;
});
$(document).on('mouseout', '.js_rating_votes', function(){
	if($(this).attr("disabled") == "disabled")
	{
		return false;
	}
	if($(this).next('.js_rating_votes_hide').length)
	{
		$(this).html($(this).next('.js_rating_votes_hide').html());
	}
});
$(document).on('mouseover', '.js_rating_votes_item', function(){
	if($(this).parents('.js_rating_votes').attr("disabled") == "disabled")
	{
		return false;
	}
	if(! $(this).parents('.js_rating_votes').next('.js_rating_votes_hide').length)
	{
		$(this).parents('.js_rating_votes').after('<span class="js_rating_votes_hide">'+$(this).parents('.js_rating_votes').html()+'</span>');
		$(this).parents('.js_rating_votes').next('.js_rating_votes_hide').hide();
	}
	rating = 0;
	var plus = true;
	$(this).attr("current", "true");
	$(this).parents('.js_rating_votes').find('.js_rating_votes_item').each(function(){
		if(plus)
		{
			rating = rating + 1;
                        $(this).addClass("active");
			
		}
		else
		{
			$(this).removeClass("active");
		}
		if($(this).attr("current") == "true")
		{
			plus = false;
		}
	});
	$(this).attr("current", "false");
});