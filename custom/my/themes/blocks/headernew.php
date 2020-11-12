<?php
/**
 * header
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
<header class="header header_new">
    <div class="container">
        <nav class="header__nav navbar">

            <div class="header__unit header__header">
                <div class="header__table">
                    <a href="<insert name="path">" class="navbar-brand">
                        <insert name="show_block" module="site" id="1">
                    </a>

                    <div class="header__unit header__toggler">
                        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#header-nav" aria-expanded="false" aria-controls="header-nav">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="header__unit">
                <div class="collapse navbar-toggleable-md" id="header-nav">
                    <div class="header__table hidden-xs-down">
                        <insert name="show_block" module="menu" id="2" template="header">
                        
                        <div class="header__unit">
                            <insert name="show_search" module="search" template="header">
                        </div>

                        <div class="header__unit" style="width:1%">
                            <div class="header__icons">
                                <a href="#header-search" class="js-search-show"><i class="fa fa-search" aria-hidden="true"></i></a>
                                <insert name="show_block" module="cart">
                                <insert name="show_block" module="wishlist">
                            </div>
                        </div>
                    </div>
                    <div class="hidden-sm-up mobile">
                        <div class="header__table">
                            <div class="header__unit">
                                <a href="<insert name="path">shop/cart/"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                            </div>
                            <div class="header__unit">
                                <a href="<insert name="path">shop/wishlist/"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <insert name="show_block" module="menu" id="2" count-level="1" template="footer">
                        <insert name="show_search" module="search" template="header_mobile">
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>