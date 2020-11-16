<?php
/**
 * Шаблон страницы сайта
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
    </head>
  <!-- Yandex.Metrika counter -->
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
<!-- /Yandex.Metrika counter -->  <body>
        <div id="wrapper">
            <insert name="show_include" file="header" />
            <insert name="show_include" file="nav" />
            <main class="main">
                <div class="container">
                    
                    <insert name="show_breadcrumb">
                    <div class="heading_row"><div class="heading">
                                <div class="heading__item">
                                    <insert name="show_h1">
                                </div>
                                
                    </div></div>
                    <insert name="show_text">
                    <insert name="show_module">
                </div>
            </main>

            <insert name="show_include" file="footer"/>
        </div>

        <insert name="show_include" file="script"/>
    </body>
</html>