<?php

/**
 * Установка модуля
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    5.4
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2014 OOO «Диафан» (http://diafan.ru)
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
class Csseditor_install extends Install
{

    /**
     * @var string название
     */
    public $title = "Цветовое оформление";

    /**
     * @var array записи в таблице {modules}
     */
    public $modules = array(
	array(
	    "name"	 => "csseditor",
	    "admin"	 => true,
	    "site"	 => false
	),
    );

    /**
     * @var array меню административной части
     */
    public $admin = array(
	array(
	    "name"		 => "Цветовое оформление",
	    "rewrite"	 => "csseditor",
	    "group_id"	 => "3",
	    "sort"		 => 25,
	    "act"		 => true,
	),
    );
    
}
