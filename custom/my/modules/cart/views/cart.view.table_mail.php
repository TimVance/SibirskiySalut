<?php
/**
 * Шаблон таблицы с товарами, отправляемый пользователю по почте
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
		<th class="cart_img"></th>
		<th class="cart_name">'.$this->diafan->_('Наименование товара').'</th>';
		if(! empty($result["measure_unit"]))
		{
			echo '<th class="cart_measure_unit">'.$this->diafan->_('Единица измерения').'</th>';
		}
		echo '
		<th class="cart_count">'.$this->diafan->_('Количество').'</th>
		<th class="cart_price">'.$this->diafan->_('Цена').', '.$result["currency"].'</th>';
		if($result["discount"])
		{
			echo '<th class="cart_old_price">'.$this->diafan->_('Цена со скидкой').', '.$result["currency"].'</th>';
			echo '<th class="cart_discount">'.$this->diafan->_('Скидка').'</th>';
		}
		echo '<th class="cart_summ">'.$this->diafan->_('Сумма').', '.$result["currency"].'</th>
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
			echo '<a href="'.BASE_PATH_HREF.$row["link"].'"><img src="http'.(IS_HTTPS ? "s" : '')."://".getenv("HTTP_HOST").$row["img"]["src"].'" width="'.$row["img"]["width"].'" height="'.$row["img"]["height"].'" alt="'.$row["img"]["alt"].'" title="'.$row["img"]["title"].'"></a> ';
		}
		echo '</td>
			<td class="cart_name">';
			if(! empty($row["cat"]))
			{
				echo '<a href="'.BASE_PATH_HREF.$row["cat"]["link"].'">'.$row["cat"]["name"].'</a> / ';
			}
			echo '<a href="'.BASE_PATH_HREF.$row["link"].'">'.$row["name"];
			if(! empty($row["param"]))
			{
				foreach($row["param"] as $name => $value)
				{
					echo ', '.$name.': '.$value;
				}
			}
			if(! empty($row["article"]))
			{
				echo '<br/>'.$this->diafan->_('Артикул').': '.$row["article"];
			}
			echo '</a>';
			if(! empty($row["additional_cost"]))
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
			echo '</td>';
			if(! empty($result["measure_unit"]))
			{
				echo '<td class="cart_measure_unit">'.($row["measure_unit"] ? $row["measure_unit"] : $this->diafan->_('шт.')).'</td>';
			}
			echo '
			<td class="js_cart_count cart_count">'.$row["count"].'</td>';
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
		</tr>';
	}

	// общая скидка от объема
	if(! empty($result["discount_summ"]))
	{
		echo '
			<tr>
				<td class="cart_discount_total_text" colspan="'.($result["discount"] ? 6 : 4).'" ></td>
				<td class="cart_discount_total">';
		if(! empty($result["discount_summ"]))
		{
			echo $this->diafan->_('Скидка').' '.$result["discount_summ"];
		}
		echo '</td>
		</tr>';
	}

	//итоговая строка для товаров
	echo '
		<tr class="cart_last_tr">
                        
			<td class="cart_total" colspan="2">'.$this->diafan->_('Итого за товары').'</td>';
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
	if(! empty($result["old_summ_goods"]))
	{
		echo '<div class="cart_summ_old_total">'.$result["old_summ_goods"].'</div>';
	}
	echo $result["summ_goods"];
	echo '</td>
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
	
	//дополнительно
	if (! empty($result["additional_cost"])) 
	{
		echo '<tr><th colspan="'.($count_clm + 5).'" class="cart_additional_title">'.$this->diafan->_('Дополнительно').'</th></tr>';
		foreach ($result["additional_cost"] as $row)
		{
			if ($row['amount'])
			{
				$row['text'] .= '<br>'.$this->diafan->_('Бесплатно от суммы').' '.$row['amount'].' '.$result["currency"];
			}
			echo '
			<tr>
				<td class="cart_additional" colspan="'.($count_clm + 3).'">
					<div class="cart_additional_cost_name">'.$row["name"].'</div>
				</td>
				<td class="cart_price">'.($row['percent'] ? $row['percent'].'%' : $row["price"]).'</td>
				<td class="cart_summ">'.$row["summ"].'</td
			</tr>';
		}
	}

	//способы доставки
	if (! empty($result["delivery"])) 
	{
		echo '<tr><th colspan="'.($count_clm + 5).'" class="cart_delivery_title">'.$this->diafan->_('Способ доставки').'</th></tr>';
		echo '
		<tr>
			<td colspan="'.($count_clm + 4).'" class="cart_delivery">
				<div class="cart_delivery_name">'.$result["delivery"]["name"].'</div>
			</td>
			<td class="cart_summ">'.$result["delivery"]["summ"].'</td>
		</tr>';
	}
}


//итоговая строка таблицы
echo '
	<tr class="cart_last_tr">
		<td class="cart_total" colspan="2">'.$this->diafan->_('Итого к оплате').'</td>';
if(! empty($result["measure_unit"]))
{
	echo '<td></td>';
}		
echo '<td class="cart_count"></td><td class="cart_price"></td>';
	if($result["discount"])
	{
		 echo '<td class="cart_old_price"></td>';
		 echo '<td class="cart_discount"></td>';
	}
	echo '<td class="cart_summ">'.$result["summ"];
	if(! empty($result["tax"]))
	{
		echo '<small><br>'.$this->diafan->_('в т. ч. %s', true, $result["tax_name"]).'<br>'.$result["tax"].'</small>';
	}
	echo '</td>
	</tr></tbody>
</table>';
