<?php

/**
 * Шаблон страницы товара
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

/*
  echo '<div class="js_shop_id js_shop shop shop_id shop-item-container">';


  echo '<div class="shop-item-left">';

  //вывод изображений товара
  if (!empty($result["img"]))
  {
  echo '<div class="js_shop_all_img shop_all_img shop-item-big-images">';
  $k = 0;
  foreach ($result["img"] as $img)
  {
  switch ($img["type"])
  {
  case 'animation':
  echo '<a class="js_shop_img shop-item-image'.(empty($k) ? ' active' : '').'" href="'.BASE_PATH.$img["link"].'" rel="prettyPhoto[gallery'.$result["id"].'shop]" image_id="'.$img["id"].'">';
  break;
  case 'large_image':
  echo '<a class="js_shop_img shop-item-image'.(empty($k) ? ' active' : '').'" href="'.BASE_PATH.$img["link"].'" rel="large_image" width="'.$img["link_width"].'" height="'.$img["link_height"].'" image_id="'.$img["id"].'">';
  break;
  default:
  echo '<a class="js_shop_img shop-item-image'.(empty($k) ? ' active' : '').'" href="'.BASE_PATH.$img["link"].'" image_id="'.$img["id"].'">';
  break;
  }
  echo '<img src="'.BASE_PATH.$img["link"].'" alt="'.$img["alt"].'" title="'.$img["title"].'" image_id="'.$img["id"].'" class="shop_id_img">';
  echo '</a>';
  $k++;
  }
  echo '<span class="shop-photo-labels">';
  if (!empty($result['hit']))
  {
  echo '<img src="'.BASE_PATH.Custom::path('img/label_hot_big.png').'">';
  }
  if (!empty($result['action']))
  {
  echo '<img src="'.BASE_PATH.Custom::path('img/label_special_big.png').'">';
  }
  if (!empty($result['new']))
  {
  echo '<img src="'.BASE_PATH.Custom::path('img/label_new_big.png').'">';
  }
  echo '</span>';

  echo '<span class="icon-zoom">&nbsp;</span>
  <span class="js_shop_wishlist shop_wishlist shop-like'.(! empty($result["wish"]) ? ' active' : '').'">&nbsp;</span>';

  echo '</div>';
  if($result["preview_images"])
  {
  echo '<a class="control-prev shop-previews-control" href="#">&nbsp;</a>
  <a class="control-next shop-previews-control" href="#">&nbsp;</a>';
  echo '<div class="shop_preview_img shop-item-previews items-scroller" data-item-per-screen="3" data-controls="shop-previews-control">';
  foreach ($result["img"] as $img)
  {
  echo ' <a class="js_shop_preview_img item" href="#" style="background-image:url('.$img["preview"].')" image_id="'.$img["id"].'">&nbsp;</a>';
  }
  echo '</div>';
  }
  }

  echo '</div>';

  echo '<div class="shop-item-right">';
  echo '<div class="shop-item-info1">';

  //вывод артикула
  if (!empty($result["article"]))
  {
  echo '<h4 class="shop-item-artikul">'.$this->diafan->_('Артикул').': '.$result["article"].'</h4>';
  }

  //вывод производителя
  if (!empty($result["brand"]))
  {
  echo '<div class="shop_brand">';
  echo $this->diafan->_('Производитель').': ';
  echo '<a href="'.BASE_PATH_HREF.$result["brand"]["link"].'">'.$result["brand"]["name"].'</a>';
  echo '</div>';
  }

  //вывод рейтинга товара
  if (!empty($result["rating"]))
  {
  echo '<div class="shop-item-rate rate">'.$this->diafan->_('Рейтинг').": ";
  echo $result["rating"];
  echo '</div>';
  }

  //скидка на товар
  if (!empty($result["discount"]))
  {
  echo '<div class="shop_discount">'.$this->diafan->_('Скидка').': <span class="shop_discount_value">'.$result["discount"].' '.$result["discount_currency"].($result["discount_finish"] ? ' ('.$this->diafan->_('до').' '.$result["discount_finish"].')' : '').'</span></div>';
  }

  //кнопка "Купить"
  echo $this->get('buy_form', 'shop', array("row" => $result, "result" => $result));

  if(empty($result["hide_compare"]))
  {
  echo $this->get('compare_form', 'shop', $result);
  //echo $this->get('compared_goods_list', 'shop', array("site_id" => $result["site_id"], "shop_link" => $result['shop_link']));
  }

  echo $this->htmleditor('<insert name="show_social_links">');

  echo '</div>';

  echo '<div class="shop-item-info2">
  <div class="shop-item-info2">
  <div class="block">
  <h4><img src="'.BASE_PATH.Custom::path('img/icon_deliver.png').'">'.$this->diafan->_('Условия доставки').'</h4>
  '.$this->htmleditor('<insert name="show_block" module="site" id="3">').'
  </div>
  <div class="block">
  <h4><img src="'.BASE_PATH.Custom::path('img/icon_return.png').'">'.$this->diafan->_('Условия возврата').'</h4>
  '.$this->htmleditor('<insert name="show_block" module="site" id="4">').'
  </div>
  </div>
  </div>';

  echo $this->htmleditor('<insert name="show_block_order_rel" module="shop" count="2" images="1">');

  echo '</div>';

  //счетчик просмотров
  if(! empty($result["counter"]))
  {
  echo '<div class="shop_counter">'.$this->diafan->_('Просмотров').': '.$result["counter"].'</div>';
  }

  //теги товара
  if (!empty($result["tags"]))
  {
  echo $result["tags"];
  }

  //полное описание товара
  echo '<div class="shop_text">'.$this->htmleditor($result['text']).'</div>';

  //характеристики товара
  if (!empty($result["param"]))
  {
  echo $this->get('param', 'shop', array("rows" => $result["param"], "id" => $result["id"]));
  }

  //комментарии к товару
  if (!empty($result["comments"]))
  {
  echo $result["comments"];
  }

  echo '</div>';

  //ссылки на предыдущий и последующий товар
  if (! empty($result["previous"]) || ! empty($result["next"]))
  {
  echo '<div class="previous_next_links">';
  if (! empty($result["previous"]))
  {
  echo '<div class="previous_link"><a href="'.BASE_PATH_HREF.$result["previous"]["link"].'">&larr; '.$result["previous"]["text"].'</a></div>';
  }
  if (! empty($result["next"]))
  {
  echo '<div class="next_link"><a href="'.BASE_PATH_HREF.$result["next"]["link"].'">'.$result["next"]["text"].' &rarr;</a></div>';
  }
  echo '</div>';
  }
  echo $this->htmleditor('<insert name="show_block_rel" module="shop" count="4" images="1">');
 * 
 * 
 */

echo '<div class="box js_shop_id js_shop">';

if (!empty($result["rating"])) {
    echo '<div class="heading__item">' . $result['rating'] . '</div>';
}

echo '<div class="row">';
if (!empty($result['img'])) {
    echo '
            <div class="col-lg-4 col-md-5">
              <div class="pics">
                <div class="pics__big js_shop_all_img">';

    echo '<div class="labels">'
    . ($result['hit'] ? '<span class="labels__hit">HIT</span>' : '')
    . ($result['new'] ? '<span class="labels__new">NEW</span>' : '')
    . ($result['action'] ? '<span class="labels__dis">' . $result['discount'] . $result['discount_currency'] . '</span>' : '')
    . '</div>';

    $first = true;
    foreach ($result["img"] as $img) {
        switch ($img["type"]) {
            case 'animation':
                echo '<a ' . (!$first ? ' style="display:none"' : '') . ' class="js_shop_img" href="' . BASE_PATH . $img["link"] . '" rel="prettyPhoto[gallery' . $result["id"] . 'shop]" image_id="' . $img["id"] . '">';
                break;
            case 'large_image':
                echo '<a ' . (!$first ? ' style="display:none"' : '') . ' class="js_shop_img" href="' . BASE_PATH . $img["link"] . '" rel="large_image" width="' . $img["link_width"] . '" height="' . $img["link_height"] . '" image_id="' . $img["id"] . '">';
                break;
            default:
                echo '<a ' . (!$first ? ' style="display:none"' : '') . ' class="js_shop_img" href="' . BASE_PATH . $img["link"] . '" image_id="' . $img["id"] . '">';
                break;
        }
        echo '<img src="' . BASE_PATH . $img["link"] . '" alt="' . $img["alt"] . '" title="' . $img["title"] . '"></a>';
        $first = false;
    }

    echo '</div>';
    if ($result["preview_images"]) {

        echo '<div class="row js_item-preview">';
        $first = true;
        foreach ($result['img'] as $img) {
            echo '<div class="col-lg-4 col-md-4 col-xs-4">
                    <a href="#" class="pics__mini' . ($first ? ' active' : '') . '" image_id="' . $img["id"] . '">
                      <img src="' . $img["preview"] . '" alt="' . $img["alt"] . '" title="' . $img["title"] . '" >
                    </a>
                  </div>';
            $first = false;
        }


        echo '</div>';
    }
    echo '</div>
        </div>';
}

echo '<div class="col-lg-8 col-md-7">';

//вывод артикула
if (!empty($result["article"])) {
    echo '<p class="shop_article"><strong>' . $this->diafan->_('Артикул') . ':</strong> ' . $result["article"] . '</p>';
}

//вывод производителя
if (!empty($result["brand"])) {
    echo '<p class="shop_brand"><strong>';
    echo $this->diafan->_('Производитель') . ':</strong> ';
    echo '<a href="' . BASE_PATH_HREF . $result["brand"]["link"] . '">' . $result["brand"]["name"] . '</a>';
    echo '</p>';
}
echo '<h3>' . $this->diafan->_('Описание') . '</h3>
              <div class="text">
                ' . $this->htmleditor($result['text']) . '
              </div>';



echo $this->get('buy_form', 'shop', array("row" => $result, "result" => $result));
//счетчик просмотров
if (!empty($result["counter"])) {
    echo '<div class="shop_counter">' . $this->diafan->_('Просмотров') . ': ' . $result["counter"] . '</div>';
}

//теги товара
if (!empty($result["tags"])) {
    echo $result["tags"];
}
echo $this->htmleditor('<insert name="show_social_links">');
echo '</div>
          </div>

          </div>';

$tabs = array();

if (!empty($result['param'])) {
    $tabs['Характеристики'] = $this->get('param', 'shop', array("rows" => $result["param"], "id" => $result["id"]));
}

if(!empty($result)) {
	$tabs['Видео'] = $this->htmleditor('<insert name="show_dynamic" module="site" id="1">');
}

$dostavka = $this->htmleditor('<insert name="show_block" module="site" id="8">');
if (!empty($dostavka)) {
    $tabs['Доставка и оплата'] = $dostavka;
}

if (!empty($result['comments'])) {
    $tabs['Отзывы'] = $result['comments'];
}

if (!empty($tabs)) {
    echo '<div class="box item__tabs"><ul class="nav nav-tabs" role="tablist">';
    $first = true;
    foreach (array_keys($tabs) as $i => $v) {
        echo '<li class="nav-item">
    <a class="nav-link' . ($first ? ' active' : '') . '" data-toggle="tab" href="#tab-' . $i . '" role="tab">' . $this->diafan->_($v) . '</a>
  </li>';
        $first = false;
    }
    echo '</ul><div class="tab-content">';
    $first = true;
    $i=0;
    foreach ($tabs as $name => $v) {
        echo '<div class="tab-pane ' . ($first ? ' active' : '') . '" id="tab-' . $i . '" role="tabpanel">';
                echo '
                    <div role="tab" class="accordion" id="tab-' . $i . 'accordion">
                        <div class="accordion__header"><a href="#tab-' . $i . 'panel" data-toggle="collapse" data-parent="#tab-' . $i . 'accordion">'.$name.'</a></div>
                        <div class="accordion__content collapse in" role="tabpanel" id="tab-' . $i . 'panel">'.$v.'</div>
                    </div>';
                
                echo '</div>'; //tab-pane
        $first = false;
        $i++;
    }

    echo '</div></div>';
}

echo $this->htmleditor('<insert name="show_block_rel" module="shop" count="8" images="1">');
