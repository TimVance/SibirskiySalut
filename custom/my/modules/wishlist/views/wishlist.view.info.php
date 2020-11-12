<?php
/**
 * Шаблон информации о товарах в списке пожеланий
 * 
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    6.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2016 OOO «Диафан» (http://www.diafan.ru/)
 */

if (! defined('DIAFAN'))
{
    $path = __FILE__; $i = 0;
	while(! file_exists($path.'/includes/404.php'))
	{
		if($i == 10) exit; $i++;
		$path = dirname($path);
	}
	include $path.'/includes/404.php';
}

echo '<a href="'.$result["link"].'"><i class="fa '.(empty($result['count']) ? 'fa-heart-o':'fa-heart').'" aria-hidden="true"></i>';
if($result['count']) echo '<span class="tag tag-pill tag-default">'.$result["count"].'</span>';
echo '</a>';