<?php
/**
 * Шаблон таблицы с товарами в корзине
 * 
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    6.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2016 OOO «Диафан» (http://www.diafan.ru/)
 */

if (! defined('DIAFAN')) {
	$path = __FILE__; $i = 0;
	while(! file_exists($path.'/includes/404.php'))
	{
		if($i == 10) exit; $i++;
		$path = dirname($path);
	}
	include $path.'/includes/404.php';
}

//шапка таблицы
echo '<table class="cart">
	<thead><tr>
		<th class="cart_img">'.$this->diafan->_('Фото').'</th>
		<th class="cart_name">'.$this->diafan->_('Наименование товара').'</th>';
		if(! empty($result["measure_unit"]))
		{
			echo '<th class="cart_measure_unit">'.$this->diafan->_('Единица измерения').'</th>';
		}
		echo '<th class="cart_count">'.$this->diafan->_('Количество').'</th>
		<th class="cart_price">'.$this->diafan->_('Цена').', '.$result["currency"].'</th>';
		if($result["discount"])
		{
			echo '<th class="cart_old_price">'.$this->diafan->_('Цена со скидкой').', '.$result["currency"].'</th>';
			echo '<th class="cart_discount">'.$this->diafan->_('Скидка').'</th>';
		}
		echo '<th class="cart_summ">'.$this->diafan->_('Сумма').', '.$result["currency"].'</th>';
		if(empty($result["hide_form"]))
		{
			echo '<th class="cart_remove"></th>';
		}
		echo '
	</tr></thead><tbody>';
//товары
if (! empty($result["rows"]))
{
	foreach ($result["rows"] as $row)
	{
		echo '
		<tr>
			<td class="cart_img">';
		if (!empty($row["img"]))
		{
			echo '<a href="'.BASE_PATH_HREF.$row["link"].'"><img src="'.$row["img"]["src"].'" width="'.$row["img"]["width"].'" height="'.$row["img"]["height"].'" alt="'.$row["img"]["alt"].'" title="'.$row["img"]["title"].'"></a> ';
		}
		echo '</td>
			<td class="cart_name">';
			if(! empty($row["cat"]))
			{
				echo '<a href="'.BASE_PATH_HREF.$row["cat"]["link"].'">'.$row["cat"]["name"].'</a> / ';
			}
			echo '<a href="'.BASE_PATH_HREF.$row["link"].'">'.$row["name"];
			echo (! empty($row["article"]) ? '<br/>'.$this->diafan->_('Артикул').': '.$row["article"] : '');
			echo '</a>';
			if($row["additional_cost"])
			{
				foreach($row["additional_cost"] as $a)
				{
					echo '<br>'.$a["name"];
					if($a["summ"])
					{
						echo ' + '.$a["format_summ"].' '.$result["currency"];
					}
				}
			}
			if(! $row["count"])
			{
				echo '<div class="cart_no_buy">'.$this->diafan->_('Товар временно отсутствует').'</div>';
			}
			echo '</td>';
			if(! empty($result["measure_unit"]))
			{
				echo '<td class="cart_measure_unit">'.($row["measure_unit"] ? $row["measure_unit"] : $this->diafan->_('шт.')).'</td>';
			}
			echo '
			<td class="js_cart_count cart_count"><nobr>'.(empty($result["hide_form"]) ? ' <span class="js_cart_count_minus cart_count_minus">-</span> <input type="text" class="number" value="'.$row["count"].'" min="0" name="editshop'.$row["id"].'" size="2"> <span class="js_cart_count_plus cart_count_plus">+</span> ' : $row["count"]).'</nobr></td>';
			if($result["discount"])
			{
				echo '<td class="cart_old_price">'.($row["old_price"] ? $row["old_price"] : $row["price"]).'</td>';
				echo '<td class="cart_price">'.($row["old_price"] ? $row["price"] : '').'</td>';
				echo '<td class="cart_discount">'.($row["discount"] ? $row["discount"] : '').'</td>';
			}
			else
			{
				echo '<td class="cart_price">'.$row["price"].'</td>';
			}
			echo '
			<td class="cart_summ">'.$row["summ"].'</td>
			'.(empty($result["hide_form"]) ? '<td class="cart_remove"><span class="js_cart_remove" confirm="'.$this->diafan->_('Вы действительно хотите удалить товар из корзины?', false).'"><input type="hidden" id="del'.$row["id"].'" name="del'.$row["id"].'" value="0"></span></td>' : '').'
		</tr>';
	}

	// общая скидка от объема
	if(! empty($result["discount_total"]) || ! empty($result["discount_next"]))
	{
		echo '
			<tr>
				<td class="cart_discount_total_text" colspan="'.($result["discount"] ? 6 : 4).'" >';
		if(! empty($result["discount_next"]) && empty($result["hide_form"]))
		{
			echo $this->diafan->_('До скидки %s осталось %s', true, $result["discount_next"]["discount"], $result["discount_next"]["summ"]);
		}
		echo '</td>';
		
		echo '
		<td class="cart_discount_total">';
		if(! empty($result["discount_total"]))
		{
			echo $this->diafan->_('Скидка').' '.$result["discount_total"]["discount"];
		}
		echo '</td>
		'.(empty($result["hide_form"]) ? '<td class="cart_last_td">&nbsp;</td>' : '').'
		</tr>';
	}

	//итоговая строка для товаров
	echo '
		<tr class="cart_last_tr">
			<td class="cart_total" colspan="2">'.$this->diafan->_('Итого за товары').':</td>';

	if(! empty($result["measure_unit"]))
	{
		echo '<td></td>';
	}
		
	echo '<td class="cart_count">'.$result["count"].'</td><td class="cart_price"></td>';
	if($result["discount"])
	{
		 echo '<td class="cart_old_price"></td>';
		echo '<td class="cart_discount"></td>';
	}
	echo '
	<td class="cart_summ">';
	if(! empty($result["discount_total"]))
	{
		echo '<div class="cart_summ_old_total">'.$result["old_summ_goods"].'</div>';
	}
	echo $result["summ_goods"];
	echo '</td>
			'.(empty($result["hide_form"]) ? '<td class="cart_last_td">&nbsp;</td>' : '').'
		</tr>';

	$count_clm = 0;
	if(! empty($result["discount"]))
	{
		$count_clm += 2;
	}
	if(! empty($result["measure_unit"]))
	{
		$count_clm++;
	}
        
        echo '</table>';
	//дополнительно
	if (! empty($result["additional_cost"])) 
	{
             echo '<h3>'.$this->diafan->_('Дополнительно').'</h3><table class="cart-unit">';
            
		
		foreach ($result["additional_cost"] as $row)
		{
			if(! empty($result["hide_form"]) && ! in_array($row["id"], $result["cart_additional_cost"]) && ! $row["required"])
				continue;

			if ($row['amount'])
			{
				$row['text'] .= '<br>'.$this->diafan->_('Бесплатно от суммы').' '.$row['amount'].' '.$result["currency"];
			}
			echo '<tr><td>';
                        if(! $row["required"] && empty($result["hide_form"]))
			{
				echo '<input name="additional_cost_ids[]" id="additional_cost_'.$row['id'].'" value="'.$row['id'].'" type="checkbox" '.(in_array($row["id"], $result["cart_additional_cost"]) ? ' checked' : '').'><label for="additional_cost_'.$row['id'].'">&nbsp;</label>';
			}
				
					echo '<label for="additional_cost_'.$row['id'].'">'.$row["name"].'</label>
					'.(empty($result["hide_form"]) ? '<div class="cart_delivery_text">'.$row['text'].'</div>' : '').'
				</td>
				
				<td class="cart_summ">'.$row["summ"].'</td></tr>';
		}
                
                echo '</table>';
	}
        
        
        

	//способы доставки
	if (! empty($result["delivery"])) 
	{
            echo '<h3>'.$this->diafan->_('Способ доставки').'</h3><table class="cart-unit">';
            
           
            
            
		
		foreach ($result["delivery"] as $row)
		{
			if(! empty($result["hide_form"]) && $row["id"] != $result["cart_delivery"])
				continue;

			if (! empty($row["thresholds"]) && empty($result["hide_form"]))
			{
				foreach ($row["thresholds"]  as $r)
				{
					if($r["amount"])
					{
						$row['text'] .= '<br>'.($r["price"] ? $this->diafan->_('Стоимость').' '.$r["price"].' '.$result["currency"].' '.$this->diafan->_('от суммы') : $this->diafan->_('Бесплатно от суммы')).' '.$r['amount'].' '.$result["currency"];
					}
					else
					{
						$row['text'] .= '<br>'.($r["price"] ? $this->diafan->_('Стоимость').' '.$r["price"].' '.$result["currency"] : $this->diafan->_('Бесплатно'));
					}
				}
			}
			echo '
			<tr><td><input name="delivery_id" id="delivery_id_'.$row['id'].'" value="'.$row['id'].'" type="radio" '.($row["id"] == $result["cart_delivery"] ? ' checked' : '').'><label for="delivery_id_'.$row['id'].'">'.$row["name"].'</label>
					'.(empty($result["hide_form"]) ? '<div class="cart_delivery_text">'.$row['text'].'</div>' : '').'
				</td>
				<td class="cart_summ">'.$row["price"].'</td>
			</tr>';
		}
                
                echo '</table>';
	}
}


//итоговая строка таблицы
echo '
	<div class="cart-result">
		<span class="title">'.$this->diafan->_('Итого к оплате').':</span> <span class="summ">';

echo $result["summ"];
	if(! empty($result["tax"]))
	{
		echo ' <small>'.$this->diafan->_('в т. ч. %s', true, $result["tax_name"]).' '.$result["tax"].'</small>';
	}
	echo '</span></div>';
