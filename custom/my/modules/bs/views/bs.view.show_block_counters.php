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

if (empty($result)) {
    return false;
}
?>

<div class="counters-list">
    <? foreach ($result as $item): ?>
        <div class="counters-item">
            <div data-number="<?= intval(strip_tags($item["text"])) ?>" class="number"><?= intval(strip_tags($item["text"])) ?></div>
            <div class="title"><?= $item["name"] ?></div>
        </div>
    <? endforeach; ?>
</div>