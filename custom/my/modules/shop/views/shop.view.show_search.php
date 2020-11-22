<?php
/**
 * Шаблон форма поиска по товарам
 *
 * Шаблонный тег <insert name="show_search" module="shop"
 * [cat_id="категория"] [site_id="страница_с_прикрепленным_модулем"]
 * [ajax="подгружать_результаты"]
 * [only_module="only_on_module_page"] [template="шаблон"]>:
 * форма поиска по товарам
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    6.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2016 OOO «Диафан» (http://www.diafan.ru/)
 */

if (!defined('DIAFAN')) {
    $path = __FILE__;
    $i    = 0;
    while (!file_exists($path . '/includes/404.php')) {
        if ($i == 10) exit;
        $i++;
        $path = dirname($path);
    }
    include $path . '/includes/404.php';
}


$rand_id = rand(0, 9999);


echo '<form method="GET" action="' . BASE_PATH_HREF . $result["path"] . '" class="js_shop_search_form' . (!empty($result["send_ajax"]) ? ' ajax' : '') . ' block block_search hidden-sm-down"><div role="tab">';
echo '<div class="block_header">' . $this->diafan->_('Подбор') . '</div>';
echo '<input type="hidden" name="module" value="shop">
<input type="hidden" name="action" value="search"><div class="collapse in" role="tabpanel">';

if (count($result["site_ids"]) > 1) {
    echo '<div class="shop_search_site_ids">
	<span class="infofield">' . $this->diafan->_('Раздел') . ':</span>
	<select class="js_shop_search_site_ids">';
    foreach ($result["site_ids"] as $row) {
        echo '<option value="' . $row["id"] . '" path="' . BASE_PATH_HREF . $row["path"] . '"';
        if ($result["site_id"] == $row["id"]) {
            echo ' selected';
        }
        echo '>' . $row["name"] . '</option>';
    }
    echo '</select>';
    echo '</div>';
}

if (count($result["cat_ids"]) > 1) {
    echo '<div class="shop_search_cat_ids">
	<span class="infofield">' . $this->diafan->_('Категория') . ':</span>
	<select name="cat_id" class="js_shop_search_cat_ids">';
    echo '<option value="">' . $this->diafan->_('Все') . '</option>';
    foreach ($result["cat_ids"] as $row) {
        echo '<option value="' . $row["id"] . '" site_id="' . $row["site_id"] . '"';
        if ($result["cat_id"] == $row["id"]) {
            echo ' selected';
        }
        echo '>';
        if ($row["level"]) {
            echo str_repeat('- ', $row["level"]);
        }
        echo $row["name"] . '</option>';
    }
    echo '</select>';
    echo '</div>';
} else {
    echo '<input name="cat_id" type="hidden" value="' . $result["cat_id"] . '">';
}

if (!empty($result["article"])) {
    echo '<div class="shop_search_article">
		<span class="infofield">' . $this->diafan->_('Артикул') . ':</span>
		<input type="text" class="width-full" name="a" value="' . $result["article"]["value"] . '">
	</div>';
}
/*
if (! empty($result["price"]))
{
	echo '<div class="shop_search_price">
		<span class="infofield">'.$this->diafan->_('Цена').':</span>
		<div class="inline">
                        <label>'.$this->diafan->_('От').'</label>
			<input type="text" name="pr1" value="'.$result["price"]["value1"].'">
			<label>'.$this->diafan->_('до').'</label>
			<input type="text" name="pr2" value="'.$result["price"]["value2"].'">
		</div>
	</div>';
}
*/


if (!empty($result["price"])) {
    echo '<div class="shop_search_price formCost">
		<span class="infofield">' . $this->diafan->_('Цена') . ':</span>
		<div class="inline">
                        <label>' . $this->diafan->_('От') . '</label>
			<input type="text" id="minCost" class="from" name="pr1" data-min="' . $result["price"]["value_min"] . '" value="' . (!empty($result["price"]["value1"]) ? $result["price"]["value1"] : $result["price"]["value_min"]) . '">
			<label>' . $this->diafan->_('до') . '</label>
			<input type="text" id="maxCost" class="to" name="pr2" data-max="' . $result["price"]["value_max"] . '" value="' . (!empty($result["price"]["value2"]) ? $result["price"]["value2"] : $result["price"]["value_max"]) . '">
		</div>';

    echo '<div class="slider-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
        <div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div>
        <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span>
        <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;"></span>
    </div>';

    echo '</div>';
}

if (!empty($result["brands"])) {
    echo '<div class="shop_search_brand">
	<span class="infofield">' . $this->diafan->_('Производитель') . ':</span>';
    foreach ($result["brands"] as $row) {
        echo '<div class="js_shop_search_brand" site_id="' . $row["site_id"] . '">
		<input type="checkbox" name="brand[]" value="' . $row["id"] . '"';
        if (in_array($row["id"], $result["brand"])) {
            echo ' checked';
        }
        echo ' id="shop_search_brand' . $row["id"] . $rand_id . '"> <label for="shop_search_brand' . $row["id"] . $rand_id . '">' . $row["name"] . '</label></div>';
    }
    echo '</div>';
}

if (!empty($result["action"])) {
    echo '<div class="shop_search_action">
		<input type="checkbox" name="ac" id="shop_search_ac' . $rand_id . '" value="1"' . ($result["action"]["value"] ? ' checked' : '') . '>
		<label for="shop_search_ac' . $rand_id . '">' . $this->diafan->_('Товар по акции') . '</label>
	</div>';
}

if (!empty($result["new"])) {
    echo '<div class="shop_search_new">
		<input type="checkbox" name="ne" id="shop_search_ne' . $rand_id . '" value="1"' . ($result["new"]["value"] ? ' checked' : '') . '>
		<label for="shop_search_ne' . $rand_id . '">' . $this->diafan->_('Новинка') . '</label>
	</div>';
}

if (!empty($result["hit"])) {
    echo '<div class="shop_search_hit">
		<input type="checkbox" name="hi" id="shop_search_hit' . $rand_id . '" value="1"' . ($result["hit"]["value"] ? ' checked' : '') . '>
		<label for="shop_search_hit' . $rand_id . '">' . $this->diafan->_('Хит') . '</label>
	</div>';
}

if (!empty($result["rows"])) {
    foreach ($result["rows"] as $row) {
        echo '<div class="js_shop_search_param shop_search_param shop_search_param' . $row["id"] . '" cat_ids="' . $row["cat_ids"] . '">';
        switch ($row["type"]) {
            case 'title':
                echo '<span class="infofield">' . $row["name"] . ':</span>';
                break;

            case 'date':
                echo '
				<span class="infofield">' . $row["name"] . ':</span>
				<div class="inline">
                                        <label>' . $this->diafan->_('От') . '</label>
					<input type="text" name="p' . $row["id"] . '_1" value="' . $row["value1"] . '" class="timecalendar" showTime="false">
					<label>' . $this->diafan->_('до') . '</label>
					<input type="text" name="p' . $row["id"] . '_2" value="' . $row["value2"] . '" class="timecalendar" showTime="false">
				</div>';
                break;

            case 'datetime':
                echo '
				<span class="infofield">' . $row["name"] . ':</span>
				<div class="inline">
                                        <label>' . $this->diafan->_('От') . '</label>
					<input type="text" name="p' . $row["id"] . '_1" value="' . $row["value1"] . '" class="timecalendar" showTime="true">
					<label>' . $this->diafan->_('до') . '</label>
					<input type="text" name="p' . $row["id"] . '_2" value="' . $row["value2"] . '" class="timecalendar" showTime="true">
				</div>';
                break;

            case 'numtext':
                if (!empty($row["value_max"]) && $row["value_max"] > $row["value_min"]) {
                    echo '
                        <span class="infofield">' . $row["name"] . ':</span>
                        <div class="inline">
                                                <label>' . $this->diafan->_('От') . '</label>
                            <input class="from" type="text" name="p' . $row["id"] . '_1" data-min="' . $row["value_min"] . '" value="' . (!empty($row["value1"]) ? $row["value1"] : $row["value_min"]) . '">
                            <label>' . $this->diafan->_('до') . '</label>
                            <input class="to" type="text"  name="p' . $row["id"] . '_2" data-max="' . $row["value_max"] . '" value="' . (!empty($row["value2"]) ? $row["value2"] : $row["value_max"]) . '">
                        </div>';
                    echo '
                        <div class="slider-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                            <div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div>
                            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span>
                            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;"></span>
                        </div>
                    ';
                }
                break;

            case 'checkbox':
                echo '
                <div>
				    <input type="checkbox" id="shop_search_p' . $row["id"] . $rand_id . '" name="p' . $row["id"] . '" value="1"' . ($row["value"] ? " checked" : '') . '>
				    <label for="shop_search_p' . $row["id"] . $rand_id . '">' . $row["name"] . '</label>
				</div>';
                break;

            case 'select':
            case 'multiple':
                if ($row["id"] == 19) {
                    echo '<span class="infofield">' . $row["name"] . ':</span>';
                    echo '<div class="animation-effect">
                        <div class="image"></div>
                        <div class="title"></div>
                        </div>';
                    $first = true;
                    foreach ($row["select_array"] as $key => $value) {
                        $rows_effects = [];
                        $rows_effects = DB::query_fetch_key_array("
                            SELECT * FROM {ab_param_element} AS p JOIN {attachments} AS a ON p.element_id=a.element_id
                            WHERE p.param_id=%d AND p.[value]=%d", 4, $key, "param_id");

                        if (!empty($rows_effects)) {
                            echo '<label class="effect-filter-label '.(in_array($key, $row["value"]) ? " active" : '').'" style="background-image: url(/attachments/get/' . $rows_effects[2][0]["id"] . '/' . $rows_effects[2][0]["name"] . ')" data-url="/attachments/get/' . $rows_effects[3][0]["id"] . '/' . $rows_effects[3][0]["name"] . '" data-name="'.$value.'">';
                                echo '<input type="checkbox" id="shop_search_p' . $row["id"] . '_' . $key . '' . $rand_id . '" name="p' . $row["id"] . '[]" value="' . $key . '"' . (in_array($key, $row["value"]) ? " checked" : '') . '>';
                            echo '</label>';
                        }
                        else {
                            if ($first) {
                                echo '<br>';
                                $first = false;
                            }
                            echo '<input type="checkbox" id="shop_search_p' . $row["id"] . '_' . $key . '' . $rand_id . '" name="p' . $row["id"] . '[]" value="' . $key . '"' . (in_array($key, $row["value"]) ? " checked" : '') . '>
					        <label for="shop_search_p' . $row["id"] . '_' . $key . '' . $rand_id . '">' . $value . '</label>';
                        }
                    }
                }
                else {
                    echo '
				    <span class="infofield">' . $row["name"] . ':</span><div class="js-scrollbar scrolled_params">';
                    foreach ($row["select_array"] as $key => $value) {
                        echo '<input type="checkbox" id="shop_search_p' . $row["id"] . '_' . $key . '' . $rand_id . '" name="p' . $row["id"] . '[]" value="' . $key . '"' . (in_array($key, $row["value"]) ? " checked" : '') . '>
					<label for="shop_search_p' . $row["id"] . '_' . $key . '' . $rand_id . '">' . $value . '</label>';
                    }
                    echo '</div>';
                }
        }
        echo '
		</div>';
    }
}
echo '
	<div class="block__foot">
	<input type="submit" class="btn btn_search_items" value="' . $this->diafan->_('Подобрать', false) . '">
            </div></div></div>
</form>';