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

        if ($dropdown) {
            $class[] = 'dropdown-toggle';
        }

        return '<a href="' . (!empty($row['othurl']) ? $row['othurl'] : BASE_PATH_HREF . $row['link']) . '" class="' . implode(' ', $class) . '"'
                . ($dropdown ? ' data-toggle="dropdown-sub" role="button"' : '')
                . '>' . $row['name'] . '</a>';
    }

}

if (!function_exists('child_exists')) {

    function child_exists($id, array $array) {

        return array_key_exists($id, $array) && !empty($array[$id]);
    }

}

if (!function_exists('dropdown_menu2')) {

    function dropdown_menu2($id, $rows) {
        if (child_exists($id, $rows)) {
            echo '<ul class="dropdown-menu">';

            foreach ($rows[$id] as $popup) {
                echo '<li class="dropdown-item' . (child_exists($popup['id'], $rows) ? ' dropdown-sub' : '') . '">';
                echo menu_link($popup, 'nav-link', child_exists($popup['id'], $rows));

                dropdown_menu2($popup['id'], $rows);
               
                echo '</li>';
            }
            echo '</ul>';
        }
    }

}

echo '<ul class="nav">';
foreach ($result['rows'][0] as $main) {
    $class = array('nav-item');
    if ($main['active'] || $main['active_child']) {
        $class[] = 'active';
    }

    if (child_exists($main['id'], $result['rows'])) {
        $class[] = 'dropdown';
    }
    echo '<li class="' . implode(' ', $class) . '">' . menu_link($main, 'nav-link', child_exists($main['id'], $result['rows']));
    dropdown_menu2($main['id'], $result['rows']);
    echo '</li>';
}
echo '</ul>';


