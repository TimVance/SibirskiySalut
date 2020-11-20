<?php
/**
 * Шаблон стартовой страницы сайта
 * 
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    6.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2016 OOO «Диафан» (http://www.diafan.ru/)
 */
if (!defined("DIAFAN")) {
    $path = __FILE__;
    $i = 0;
    while (!file_exists($path . '/includes/404.php')) {
        if ($i == 10)
            exit;
        $i++;
        $path = dirname($path);
    }
    include $path . '/includes/404.php';
}
?><!DOCTYPE html>
<html lang="ru">
<head>
    <insert name="show_include" file="head" />
</head><!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(51516521, "init", {
        id:51516521,
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/51516521" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<body>
    <div id="wrapper" class="main__page">
        <insert name="show_include" file="glavheader" />
        <insert name="show_include" file="nav" />
         <insert name="show_block" module="site" id="9">
		 <insert name="show_block" module="site" id="21">
			 <div class="container">
				 
				  <insert name="show_block" module="site" id="20"><!-- Блок на главной после Слайдера -->
				 
			 </div>
			 
        <main class="main">
            <div class="container">
                
               <insert name="show_block" module="ab" template="sections" count="16" images="true" site_id="172"></insert>
                    
                    <insert name="show_block" module="site" id="10">
                     <insert name="show_block" module="site" id="11"> 
                     <insert name="show_block" module="site" id="16">
               
                <insert name="show_block" module="site" id="12">

            </div>

            <div class="counts-wrapper">
                <div class="container">
                    <insert name="show_block" module="bs" cat_id="8" template="counters" count="6"></insert>
                </div>
            </div>

            <div class="container">

				<insert name="show_body">
				
				<insert name="show_block" module="site" id="15">
                
            </div>
        </main>

        <insert name="show_include" file="footer"/>

    </div>

<insert name="show_include" file="script"/>

<link rel="stylesheet" href="/slick/slick.css">
<link rel="stylesheet" href="/slick/slick-theme.css">
<script src="/slick/slick.min.js"></script>
<script>
$(function () {
  $('#tworighslider').carousel({
    interval: 5000, //скорость смены слайдов в милисекундах
    keyboard: false,
    pause: 'hover'
  });
    $('.sectionslider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: false,
        dots: false,
    });
});
</script>
<script>
    $(function () {
        let lists = $(".counters-list .number");
        lists.each(function () {
            let target_block = $(this);
            var blockStatus = true;
            $(window).scroll(function () {
                var scrollEvent = ($(window).scrollTop() > (target_block.offset().top - $(window).height()));
                if (scrollEvent && blockStatus) {
                    console.log("ty");
                    blockStatus = false; // Запрещаем повторное выполнение функции до следующей перезагрузки страницы.
                    $({numberValue: 0}).animate({numberValue: target_block.data("number")}, {
                        duration: 3000, // Продолжительность анимации, где 500 - 0.5 одной секунды, то есть 500 миллисекунд
                        easing: "linear",
                        step: function (val) {
                            target_block.html(Math.ceil(val)); // Блок, где необходимо сделать анимацию
                        }
                    });
                }
            });
        });
    });
</script>

</body>
</html>