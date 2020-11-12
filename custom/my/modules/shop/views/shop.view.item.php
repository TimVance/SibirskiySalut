<?php

/**
 * Шаблон списка товаров
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

$row = $result['rows'][$result['current_row']];
//print_r($row);
echo '<div class="catalog__item js_shop">';
if (!empty($row["img"]))
{
    echo
	'<div class="catalog__pic">
		<a href="' . BASE_PATH_HREF . $row["link"] . '">';

			foreach ($row["img"] as $img) {
				echo '<img src="' . $img["src"] . '" alt="' . $img["alt"] . '" title="' . $img["title"] . '" image_id="' . $img["id"] . '" class="js_shop_img">';
			}

		echo
		'</a>
			<div class="labels">'
			. ($row['hit'] ? '<span class="labels__hit">HIT</span>' : '')
			. ($row['new'] ? '<span class="labels__new">NEW</span>' : '')
			. ($row['action'] ? '<span class="labels__dis">' . $row['discount'] . $row['discount_currency'] . '</span>' : '')
		. '</div>

		<a class="js_shop_wishlist ' . (!empty($row["wish"]) ? 'active' : '') . ' remember" href="javascript:void(0)">
			<i class="fa fa-heart' . (!empty($row["wish"]) ? '' : '-o') . '"></i>
		</a>
	</div>';
}

echo '<a href="' . BASE_PATH_HREF . $row["link"] . '" class="catalog__title">' . $row['name'] . '</a>';

if (!empty($row["rating"])) {
    echo $row["rating"];
}

//вывод краткого описания товара
if (!empty($row["anons"])) {
    echo '<div class="shop_anons text">' . $this->htmleditor($row['anons']) . '</div>';
}

//вывод производителя
if (!empty($row["brand"])) {
    echo '<div class="shop_brand"><strong>';
    echo $this->diafan->_('Производитель') . ':</strong> ';
    echo '<a href="' . BASE_PATH_HREF . $row["brand"]["link"] . '">' . $row["brand"]["name"] . '</a>';
    echo '</div>';
}

//вывод артикула
if (!empty($row["article"])) {
    echo '<div class="shop_article"><strong>';
    echo $this->diafan->_('Артикул') . ':</strong> ';
    echo '<span class="shop_article_value">' . $row["article"] . '</span>';
    echo '</div>';
}

//вывод параметров товара
if (empty($result['search']) && !empty($row["param"])) {
    echo '<div class="shop_params">'.$this->get('param', 'shop', array("rows" => $row["param"], "id" => $row["id"])).'</div>';
}

//теги товара
if (!empty($row["tags"])) {
    echo $row["tags"];
}

if (empty($result['search'])) {
    echo $this->get('buy_form_item', 'shop', array("row" => $row, "result" => $result));
}


echo '</div>';
