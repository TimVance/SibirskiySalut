<?php
/**
 * Шаблон форма оформления заказа в один клик
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    6.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2016 OOO «Диафан» (http://www.diafan.ru/)
 */

if (! defined('DIAFAN'))
{
    $path = __FILE__; $i = 0;
	while(! file_exists($path.'/includes/404.php'))
	{
		if($i == 10) exit; $i++;
		$path = dirname($path);
	}
	include $path.'/includes/404.php';
}

echo '<div class="js_cart_one_click modal fade" id="oneClickModal'.(isset($result['key']) ? '_'.$result['key'] : '').'" tabindex="-1" role="dialog" aria-labelledby="oneClickModalLabel'.(isset($result['key']) ? '_'.$result['key'] : '').'" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">';

echo '
<form method="POST" action="" class="js_cart_one_click_form modal-content ajax" enctype="multipart/form-data">
<input type="hidden" name="module" value="cart">
<input type="hidden" name="action" value="one_click">
<input type="hidden" name="form_tag" value="'.$result["form_tag"].'">
<input type="hidden" name="good_id" value="'.$result["good_id"].'">
<input type="hidden" name="tmpcode" value="'.md5(mt_rand(0, 9999)).'">';

echo '<div class="modal-header">
                <a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                </a>
                <h4 class="modal-title" id="oneClickModalLabel'.(isset($result['key']) ? '_'.$result['key'] : '').'">'.$this->diafan->_('Купить в 1 клик').'</h4>
            </div><div class="modal-body">';

if (! empty($result["rows_param"]))
{
	foreach ($result["rows_param"] as $row)
	{
		$value = ! empty($result["user"]['p'.$row["id"]]) ? $result["user"]['p'.$row["id"]] : '';
                
                $id = $result['form_tag'].$row['id'].(isset($result['key']) ? '_'.$result['key'] : '');

		echo '<div class="form-group order_form_param'.$row["id"].'">';

		switch ($row["type"])
		{
			case 'title':
				echo '<div class="infoform">'.$row["name"].':</label>';
				break;

			case 'text':
				echo '<label for="'.$id.'">'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</label>
				<input type="text" name="p'.$row["id"].'" class="form-control" id="'.$id.'" value="'.$value.'">';
				break;

			case "phone":
				echo '<label for="'.$id.'">'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</label>
				<input type="tel" name="p'.$row["id"].'" class="form-control" id="'.$id.'" value="'.$value.'">';
				break;

			case "email":
				echo '<label for="'.$id.'">'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</label>
				<input type="email" name="p'.$row["id"].'" class="form-control" id="'.$id.'" value="'.$value.'">';
				break;

			case 'textarea':
				echo '<label for="'.$id.'">'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</label>
				<textarea name="p'.$row["id"].'" class="form-control" id="'.$id.'" rows="10" cols="30">'.$value.'</textarea>';
				break;

			case 'date':
			case 'datetime':
				$timecalendar  = true;
				echo '<label for="'.$id.'">'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</label>
					<input type="email" name="p'.$row["id"].'" class="form-control" id="'.$id.'" value="'.$value.'" class="timecalendar" showTime="'
					.($row["type"] == 'datetime'? 'true' : 'false').'">';
				break;

			case 'numtext':
				echo '<label for="'.$id.'">'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</label>
				<input type="number" name="p'.$row["id"].'" class="form-control" id="'.$id.'" value="'.$value.'">';
				break;

			case 'checkbox':
				echo '<input name="p'.$row["id"].'" class="form-control" id="'.$id.'" id="cart_'.$result["good_id"].'_p'.$row["id"].'" value="1" type="checkbox" '.($value ? ' checked' : '').'><label for="cart_'.$result["good_id"].'_p'.$row["id"].'">'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').'</label>';
				break;

			case 'select':
				echo '<label for="'.$id.'">'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</label>
				<select name="p'.$row["id"].'" class="form-control" id="'.$id.'">
					<option value="">-</option>';
				foreach ($row["select_array"] as $select)
				{
					echo '<option value="'.$select["id"].'"'.($value == $select["id"] ? ' selected' : '').'>'.$select["name"].'</option>';
				}
				echo '</select>';
				break;

			case 'multiple':
				echo '<label for="'.$id.'">'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</label>';
				foreach ($row["select_array"] as $select)
				{
					echo '<input name="p'.$row["id"].'[]" id="cart_'.$result["good_id"].'_p'.$select["id"].'[]" value="'.$select["id"].'" type="checkbox" '.(is_array($value) && in_array($select["id"], $value) ? ' checked' : '').'><label for="cart_'.$result["good_id"].'_p'.$select["id"].'[]">'.$select["name"].'</label><br>';
				}
				break;

			case "attachments":
				echo '<label for="'.$id.'">'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</label>';
				echo '<div class="inpattachment"><input type="file" name="attachments'.$row["id"].'[]" class="inpfiles" max="'.$row["max_count_attachments"].'"></div>';
				echo '<div class="inpattachment" style="display:none"><input type="file" name="hide_attachments'.$row["id"].'[]" class="inpfiles" max="'.$row["max_count_attachments"].'"></div>';
				if ($row["attachment_extensions"])
				{
					echo '<div class="attachment_extensions">('.$this->diafan->_('Доступные типы файлов').': '.$row["attachment_extensions"].')</div>';
				}
				break;

			case "images":
				echo '<label for="'.$id.'">'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</label><div class="images"></div>';
				echo '<input type="file" name="images'.$row["id"].'" param_id="'.$row["id"].'" class="inpimages">';
				break;
		}

		echo '<div class="order_form_param_text">'.$row["text"].'</div>
		
		<small class="form-text errors error_p'.$row["id"].'"'.($result["error_p".$row["id"]] ? '>'.$result["error_p".$row["id"]] : ' style="display:none">').'</small></div>';
	}
	if(! empty($result["subscribe_in_order"]))
	{
		echo '<input type="hidden" name="subscribe_in_order" value="1">';
	}
}
echo '</div><div class="modal-footer">
<button type="button" class="btn btn-primary js_cart_one_click_form_submit">'.$this->diafan->_('Заказать').'</button>';
echo '<div class="errors error"'.($result["error"] ? '>'.$result["error"] : ' style="display:none">').'</div>

<div class="required_field"><span style="color:red;">*</span> — '.$this->diafan->_('Поля, обязательные для заполнения').'</div>
</div>
</form>';

            echo '
           
                
          
        </div>
    </div>
</div>';
