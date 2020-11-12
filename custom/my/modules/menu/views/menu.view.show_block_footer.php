<?php

/**
 * menu
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


if (empty($result["rows"])) {
    return false;
}

if (!function_exists('menu_link')) {

    function menu_link($row, $class, $dropdown = false) {
        if (!is_array($class)) {
            $class = array($class);
        }

        return '<a href="' . (!empty($row['othurl']) ? $row['othurl'] : BASE_PATH_HREF . $row['link']) . '" class="' . implode(' ', $class) . '"'
                //. ($dropdown ? ' data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"' : '')
                . '>' . $row['name'] . '</a>';
    }

}

if (!function_exists('child_exists')) {

    function child_exists($id, array $array) {

        return array_key_exists($id, $array) && !empty($array[$id]);
    }

}

echo '<ul class="nav nav-stacked">';
foreach ($result['rows'][0] as $main) {
    echo '<li class="nav-item">' . menu_link($main, 'nav-link').'</li>';
}
echo '</ul>';


