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
 * @copyright  Copyright (c) 2003-2018 OOO «Диафан» (http://www.diafan.ru/)
 */

if (! defined('DIAFAN'))
{
	$path = __FILE__;
	while(! file_exists($path.'/includes/404.php'))
	{
		$parent = dirname($path);
		if($parent == $path) exit;
		$path = $parent;
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

echo '<div id="tworighslider" class="carousel slide" data-ride="carousel">';

echo '<div class="carousel-inner" role="listbox">';
foreach ($result as $i => $row)
{
	if (! empty($row['html']) || ! empty($row['image']) || ! empty($row['swf']))
	{

		//вывод ссылки на баннер, если задана
		if (! empty($row['link']))
		{
			echo '<div class="carousel-item '.(! $i ? ' active' : '').'"><a href="'.$row['link'].'" class="js_bs_counter bs_counter button" rel="'.$row['id'].'" '.(! empty($row['target_blank']) ? 'target="_blank"' : '').'><img class="d-block img-fluid" src="'.BASE_PATH.USERFILES.'/bs/'.$row['image'].'" alt="'.(! empty($row['alt']) ? $row['alt'] : '').'" title="'.(! empty($row['title']) ? $row['title'] : '').'"></a></div>';
		}elseif (! empty($row['image']))
		{
			echo '<div class="carousel-item '.(! $i ? ' active' : '').'" style="background-image:url('.(! empty($row['image']) ? BASE_PATH.USERFILES.'/bs/'.$row['image'] : '').')">';
			if (! empty($row['text']))
						{
							echo '<div class="right_slid_text">';
								echo $row['text'];
							echo '</div>';
						}
						echo '</div>';
		}

	}
}
echo '</div>
<!-- Controls -->
<a class="carousel-control-prev" href="#tworighslider" role="button" data-slide="prev">
<i class="fa fa-chevron-left" aria-hidden="true"></i>
</a>
<a class="carousel-control-next" href="#tworighslider" role="button" data-slide="next">
<i class="fa fa-chevron-right" aria-hidden="true"></i>
</a>
</div>';