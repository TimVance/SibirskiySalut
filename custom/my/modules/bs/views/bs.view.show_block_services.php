<?php

/**
 * Шаблон блока баннеров
 * 
 * Шаблонный тег <insert name="show_block" module="bs" [count="all|количество"]
 * [cat_id="категория"] [id="номер_баннера"] [template="шаблон"]>:
 * блок баннеров
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

if (empty($result)) {
    return false;
}

if (!isset($GLOBALS['include_bs_js'])) {
    $GLOBALS['include_bs_js'] = true;
    //скрытая форма для отправки статистики по кликам
    echo '<form method="POST" enctype="multipart/form-data" action="" class="ajax js_bs_form bs_form">
	<input type="hidden" name="module" value="bs">
	<input type="hidden" name="action" value="click">
	<input type="hidden" name="banner_id" value="0">
	</form>';
}

echo '<section class="services">
                    <div class="row">';
foreach ($result as $row) {
    $img = '';
    if (!empty($row['image'])) {
        $img = ' style="background-image:url(\'' . BASE_PATH . USERFILES . '/bs/' . $row['image'] . '\')"';
    }
    echo '<div class="col-xs-12 col-sm-6 col-md-6">';

    if (!empty($row['link'])) {
        echo '<a class="services__item js_bs_counter" href="' . $row['link'] . '" ' . ($img ? $img : '') . ' rel="' . $row['id'] . '" ' . (!empty($row['target_blank']) ? 'target="_blank"' : '') . '>';
    } else {
        echo '<div class="services__item " ' . ($img ? $img : '') . '>';
    }

    echo '<div class="services__wrap"><div class="services__name">' . $row['name'] . '</div>';
    
    if(!empty($row['text'])) {
        echo '<div class="services__text">' . $row['text'] . '</div>';
    }
    echo '</div>';

    if (!empty($row['link'])) {
        echo '</a>';
    } else {
        echo '</div>';
    }
    echo '</div>';
}


echo '</div>
                </section>';

