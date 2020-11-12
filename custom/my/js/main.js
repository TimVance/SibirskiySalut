$(function () {

    //$("#wrapper").css('padding-bottom',$(".footer").height());
    
    
    
    $("#wrapper").append($(".modal"));
    
    $(".header__nav .mobile .navbar-nav").removeClass("navbar-nav");

    if ($(".js_shop_id").length) {
        $(".heading").addClass("item");

        if ($(window).width() < 767) {
            $(".accordion__content").removeClass("in");
        }
    }

    $(".heading").append($(".heading__item"));

    if ($.fn.flexslider) {
        $('.js-vslider').flexslider({
            direction: $(window).width() > 760 ? "vertical":"",
            animation: "slide",
            directionNav: false,
            controlsContainer: $(".js-vslider-conrols"),
        });
    }

    if ($.fn.perfectScrollbar) {
        $('.js-scrollbar').perfectScrollbar({
            theme: 'aroma',
            suppressScrollY: true
        });

        if (Modernizr.flexwrap) {
            $('.js-flex-scrollbar').perfectScrollbar({
                theme: 'aroma',
                suppressScrollY: true
            });
        }
    }

    $(".js-search-show").click(function (e) {
        e.preventDefault();

        var el = $($(this).attr('href'));
        if (!el.length)
            return false;

        $(this).hide(0, function () {
            $(".header__nav .navbar-nav").fadeOut('fast', function () {
                el.fadeIn('slow');
            });

        });
    });

    $(".js-search-close").click(function (e) {
        e.preventDefault();

        $("#header-search").fadeOut('fast', function () {
            $(".header__nav .js-search-show").show(0, function () {
                $(".header__nav .navbar-nav").fadeIn();
            });
        });
    });

    if (window.diafan_ajax) {
        diafan_ajax.success['shop_buy'] = function (form, response) {
            $('#popup_cart').modal();
            return true;
        }
    }

    $(".js_item-preview").on('click', '.pics__mini', function (e) {
        e.preventDefault();

        var image_id = $(this).attr('image_id'),
                parent = $(this).parents(".js_shop").find(".js_shop_all_img");

        $(".pics__mini", e.delegateTarget).removeClass("active");

        $(".js_shop_img", parent).hide();
        $(".js_shop_img[image_id=" + image_id + "]", parent).show();

        $(this).addClass("active");
    });

    $(".js_count").on('click', '.input-group-addon', function (e) {
        e.preventDefault();
        var input = $(".form-control", e.delegateTarget), value = parseInt(input.val(), 10);

        if ($(this).hasClass("js_count-minus") && value > 1) {
            --value;
        }
        if ($(this).hasClass("js_count-plus")) {
            ++value;
        }
        input.val(value);
    });
    
    
    

});

$(window).load(function() {
    //$(".main__page .header").css({position:'fixed',width:'100%','z-index':2});
    //$(".main__page .main").css('padding-top',$(".header").height());
    $(".cover .cover__item .container").css('padding-top', $(".header").height())
});

$(window).resize(function () {
    if ($(".js_shop_id").length) {
        if ($(window).width() < 767) {
            $(".accordion__content").removeClass("in");
        } else {
            $(".accordion__content").addClass("in");
        }
    }
}).trigger('resize');

$(document).ready(function () {
    if (!Modernizr.flexbox && $.fn.isotope) {

        function fixColumns() {
            var columnWidth = 0,
                    rowHeight = 0;

            $(".catalog > div").each(function () {
                if ($(this).height() > rowHeight) {
                    rowHeight = $(this).height();
                }

                if ($(this).width() > columnWidth) {
                    columnWidth = $(this).width();
                }
            });

            $(".catalog").isotope({
                itemSelector: '.catalog > div',
                layoutMode: 'fitRows',
                masonry: {
                    columnWidth: columnWidth
                },
                cellsByRow: {
                    columnWidth: columnWidth,
                    rowHeight: rowHeight
                },
                masonryHorizontal: {
                    rowHeight: rowHeight
                },
                cellsByColumn: {
                    columnWidth: columnWidth,
                    rowHeight: rowHeight
                }
            });
        }
        
        setTimeout(fixColumns, 500); // after shop_buy_form.js
    }
});
