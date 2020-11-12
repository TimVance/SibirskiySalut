<?php

/**
 * Шаблон постраничной навигации для пользовательской части
 * 
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    6.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2016 OOO «Диафан» (http://www.diafan.ru/)
 */
if (!defined('DIAFAN')) {
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

if (empty($result))
    return false;


echo '<nav aria-label="Page navigation" style="text-align:center">
                                <ul class="pagination paginator"'.(! empty($result["more"]) && ! empty($result["more"]["uid"]) ? ' uid="'.$result["more"]["uid"].'"' : '').'>';

foreach ($result as $l) {
    echo '<li class="page-item' . ($l['type'] == 'current' ? ' active' : '') . '">';
    switch ($l["type"]) {
		case "more":
            break;

        case "first":
            echo '<a class="page-link" href="' . BASE_PATH_HREF . $l["link"] . '" aria-label="Previous">
                                            <span aria-hidden="true"><i class="fa fa-caret-left" aria-hidden="true"></i></span>
                                            <span class="sr-only">Previous</span>
                                        </a>';
            break;

        case "current":
            echo '<span class="page-link">'.$l["name"].'</span>';
            break;

        case "previous":
            echo '<a class="page-link" href="' . BASE_PATH_HREF . $l["link"] . '" title="' . $this->diafan->_('На предыдущую страницу', false) . '">...</a> ';
            break;

        case "next":
            echo '<a class="page-link" href="' . BASE_PATH_HREF . $l["link"] . '" title="' . $this->diafan->_('На следующую страницу', false) . ' ' . $this->diafan->_('Всего %d', false, $l["nen"]) . '">...</a> ';
            break;

        case "last":
            echo '<a class="page-link" href="' . BASE_PATH_HREF . $l["link"] . '" aria-label="Next">
                                            <span aria-hidden="true"><i class="fa fa-caret-right" aria-hidden="true"></i></span>
                                            <span class="sr-only">Next</span>
                                        </a>';
            break;

        default:
            echo '<a class="page-link" href="' . BASE_PATH_HREF . $l["link"] . '">' . $l["name"] . '</a>';
            break;
    }
    echo '</li>';
}

echo '</ul>
                            </nav>';
