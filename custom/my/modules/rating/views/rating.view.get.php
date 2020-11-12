<?php
/**
 * Шаблон рейтинга элемента
 * 
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    5.4
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2015 OOO «Диафан» (http://www.diafan.ru/) 
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


echo '<div class="rating js_rating_votes" module_name="'.$result["module_name"].'" element_id="'.$result["element_id"].'" element_type="'.$result["element_type"].'"'
.($result["disabled"] ? ' disabled="disabled"' : '').'>';
for ($i = 0; $i < $result["rating"]; $i++)
{
	//echo '<img src="'.BASE_PATH.Custom::path('modules/rating/img/rplus.png').'" alt="+" width="16" height="16" class="js_rating_votes_item">';
    echo '<div class="rating__item active js_rating_votes_item"></div>'.PHP_EOL;
}
for ($i = 0; $i < 5 - $result["rating"]; $i++)
{
    echo '<div class="rating__item js_rating_votes_item"></div>'.PHP_EOL;
}
echo '</div>';