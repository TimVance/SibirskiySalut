<?php
/**
 * footer
 * 
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    6.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2016 OOO «Диафан» (http://www.diafan.ru/)
 */
if (!defined("DIAFAN")) {
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
?>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-md-4 col-lg-3">
                <insert name="show_block" module="site" id="6" template="footer">
            </div>
            <div class="col-xs-6 col-md-4 col-lg-3">
                <insert name="show_block" module="site" id="7" template="footer">
            </div>
            <div class="clearfix hidden-sm-up"></div>
            <div class="col-xs-12 col-md-4 col-lg-6">
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-6">
                        <insert name="show_block" module="site" id="2" template="footer">
                        <insert name="show_block" module="site" id="3" template="footer">
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-6">
                        <insert name="show_block" module="site" id="4" template="footer">
                        <div class="footer-unit">
                            <div class="footer-header">
                                <insert name="show_block" module="site" id="14" template="footer">
                            </div>
                        </div>
                        <insert name="show_block" module="site" id="5" template="footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
