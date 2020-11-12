<?php

/**
 * Шаблон блока на сайте в подвале
 * 
 * Шаблонный тег <insert name="show_block" module="site" id="номер_страницы" [template="шаблон"]>:
 * выводит блок на сайте
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

echo '<div class="footer-unit">';
if (!empty($result["name"])) {
    echo '<div class="footer-header">' . $result["name"] . '</div>';
}
echo $result['text'] . '</div>';
