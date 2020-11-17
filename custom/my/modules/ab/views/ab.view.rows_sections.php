<?php
/**
 * Шаблон элементов в списке объявлений
 *
 * Шаблон вывода списка объявлений
 * в категории объявлений, в результатах поиска или если группировка не используется
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    6.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2018 OOO «Диафан» (http://www.diafan.ru/)
 */

if (! defined('DIAFAN'))
{
	$path = __FILE__;
	while(! file_exists($path.'/includes/404.php'))
	{
		$parent = dirname($path);
		if($parent == $path) exit;
		$path = $parent;
	}
	include $path.'/includes/404.php';
}

if(empty($result['rows'])) return false;

foreach ($result["rows"] as $row)
{
    $images = $this->diafan->_images->get("medium", $row["id"], "ab", "element", 172, $row["name"], false, 10, "large");

	echo '<div class="main-sections-block-item">';
	    echo '<div class="flexBetween">';
	        echo '<div class="images-sections">';
	            echo '<div class="sectionslider">';
                    foreach ($images as $image) {
                        echo '<div><img src="'.$image["vs"]["large"].'"/></div>';
                    }
                echo '</div>';
	        echo '</div>';
            echo '<div class="info-sections">';
                $link = '';
                if (!empty($row["param"])) {
                    foreach ($row["param"] as $param) {
                        if ($param["id"] == 1) {
                            if (!empty($param["value"])) {
                                $link = $param["value"];
                            }
                        }
                    }
                }
                if (!empty($link)) {
                    echo '<a class="title" href="'.$link.'">'.$row["name"].'</a>';
                }
                else {
                    echo '<div class="title">'.$row["name"].'</div>';
                }
                echo '<div class="text">'.$row["text"].'</div>';
                if (!empty($link)) {
                    echo '<a href="'.$link.'" class="linkto">Подробнее</a>';
                }
            echo '</div>';
        echo '</div>';
	echo '</div>';
}