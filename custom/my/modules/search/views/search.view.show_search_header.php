<?php
/**
 * Шаблон формы поиска по сайту
 *
 * Шаблонный тег <insert name="show_search" module="search"
 * [button="надпись на кнопке"] [template="шаблон"]>:
 * форма поиска по сайту
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

echo '<div id="header-search" class="collapse">
                                <form action="'.$result["action"].'" class="search_form'.($result["ajax"] ? ' ajax" method="post"' : '" method="get"').'><input type="hidden" name="module" value="search">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></div>
                                            <input type="text" name="searchword" class="form-control" placeholder="'.$this->diafan->_('Поиск по сайту', false).'" value="'.($result["value"] ? $result["value"] : '').'">
                                            <div class="input-group-addon js-search-close"><i class="fa fa-times-circle" aria-hidden="true"></i></div>
                                        </div>
                                    </div>
                                </form>
                            </div>';