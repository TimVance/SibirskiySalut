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

if (empty($result))
{
	return false;
}               

if(! isset($GLOBALS['include_bs_js']))
{
	$GLOBALS['include_bs_js'] = true;
	//скрытая форма для отправки статистики по кликам
	echo '<form method="POST" enctype="multipart/form-data" action="" class="ajax js_bs_form bs_form">
	<input type="hidden" name="module" value="bs">
	<input type="hidden" name="action" value="click">
	<input type="hidden" name="banner_id" value="0">
	</form>';
}

echo ' <div class="cover__wrap">
                    <div class="cover">
                        <div>
                            <div class="flexslider js-vslider">

                                <ul class="slides">';
foreach ($result as $row)
{
    $img = '';
    if(!empty($row['image'])) {
        $img = BASE_PATH.USERFILES.'/bs/'.$row['image'];
    }
    echo '<li>';
    
   // if (! empty($row['link']))
	//{
	//	echo '<a href="'.$row['link'].'" '.($img ? 'style="background-image:url('.$img.')"':'').' class="js_bs_counter cover__item" rel="'.$row['id'].'" '.(! empty($row['target_blank']) ? 'target="_blank"' : '').'>';
	//}
      //  else {
            echo '<div class="cover__item" '.($img ? 'style="background-image:url('.$img.')"':'').'>';
      //  }
        
        echo '<div class="container"><div class="cover__info">';
        if(!empty($row['name'])) {
            echo '<div class="cover__title">'.$row['name'].'</div>';
        }
        if(!empty($row['text'])) {
            echo '<div class="cover__text">'.$row['text'].'</div>';
        }
        
        if (! empty($row['link']))
	{
		echo '<a href="'.$row['link'].'" class="js_bs_counter btn" rel="'.$row['id'].'" '.(! empty($row['target_blank']) ? 'target="_blank"' : '').'>'.$this->diafan->_('Смотреть каталог').'</a>';
	}
        
        echo '</div></div>';
	
	
	
	//if (! empty($row['link']))
	//{
	//	echo '</a>';
	//} else {
            echo '</div>';
      //  }
    
    echo '</li>';
}
                                  
                                echo '</ul>
                            </div>
                        </div>
                        <div class="cover-controls js-vslider-conrols" style="display:none"></div>
                    </div>
                </div>';