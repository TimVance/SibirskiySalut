<?php

/**
 * Шаблон блока производителей
 *
 * Шаблонный тег <insert name="show_brand" module="shop" [count="количество"]
 * [cat_id="категория"] [site_id="страница_с_прикрепленным_модулем"]
 * [images="количество_изображений"] [images_variation="тег_размера_изображений"]
 * [only_module="true|false"]
 * [template="шаблон"]>:
 * блок производителей
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

if (empty($result["rows"])) {
    return;
}

echo '<section class="brands">
                    <h2>' . $this->diafan->_('Бренды') . '</h2>
                    <div class="scrollbar js-flex-scrollbar"><div class="row">';
foreach ($result['rows'] as $row) {
    echo '<div class="col-md-3 col-lg-2 col-xs-6">
                            <a href="' . BASE_PATH_HREF . $row["link"] . '" class="brands__item">';
    if (!empty($row["img"])) {

        foreach ($row["img"] as $img) {

            echo '<img src="' . $img["src"] . '" alt="' . $img["alt"] . '" title="' . $img["title"] . '">';
        }
    } else {
        echo $row['name'];
    }
    echo '</a>
                        </div>';
}

echo '</div></div>
                </section>';
