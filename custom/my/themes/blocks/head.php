<?php

/**
 * head
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
}?>


      <insert name="show_head">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
  
      <script src="<insert name="custom" path="js/modernizr-flexbox.min.js" absolute="true">"></script>
      <script>
          var link = document.createElement( "link" ), head = document.getElementsByTagName("head")[0];
          link.rel = 'stylesheet';
          link.href = '<insert name="custom" path="css/libs.min.css" absolute="true">';
          
          if (! Modernizr.flexbox) { 
              link.href = '<insert name="custom" path="css/libs-noflex.min.css" absolute="true">';
          }
          
          head.insertBefore(link, head.firstChild);
           
      </script>
	  
	  <script type="text/javascript">!function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src="https://vk.com/js/api/openapi.js?162",t.onload=function(){VK.Retargeting.Init("VK-RTRG-440122-eKejT"),VK.Retargeting.Hit()},document.head.appendChild(t)}();</script><noscript><img src="https://vk.com/rtrg?p=VK-RTRG-440122-eKejT" style="position:fixed; left:-999px;" alt=""/></noscript>
  
      
      <insert name="show_css" files="default.css, main.css, colors.css">
      
    
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->