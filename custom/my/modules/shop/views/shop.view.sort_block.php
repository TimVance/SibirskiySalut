<?php

/**
 * Шаблон блока «Сортировать» с ссылками на направление сортировки
 * 
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    6.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2016 OOO «Диафан» (http://www.diafan.ru/)
 */
if (!defined('DIAFAN')) {
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

$link_sort = $result["link_sort"];
$sort_config = $result['sort_config'];

echo '<div class="heading__item right"><div class="sort"><strong>'.$this->diafan->_('Сортировать').': </strong>';
foreach ($sort_config['sort_fields_names'] as $i => $name) {

    $icon = (empty($link_sort[$i]) ? 'fa-caret-uo' : 'fa-caret-down');
    $link = ($link_sort[$i]) ? BASE_PATH_HREF . $link_sort[$i] : BASE_PATH_HREF . $link_sort[$i + 1];
    echo '<a href="' . $link . '"' . (empty($link_sort[$i]) || empty($link_sort[$i + 1]) ? ' class="active"' : '') . '><i class="fa '.$icon.'" aria-hidden="true"></i>'."\n " . $name . '</a>';
}

echo '</div></div>';
