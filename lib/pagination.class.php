<?php
/**
 * Pagination class `write less do more`
 * @author ionutvmi@gmail.com
 */

class pag
{
    var $pages = null;

    function __construct($total, $page, $perpage = 10)
    {
        $total_pages = ceil($total / $perpage);
        foreach ($_GET as $k => $v)
            if ($k != 'p')
                $query .= "&$k=$v";


        if ($page > 1)
            $this->pages .= "<a href='?p=" . ($page - 1) . "'>Prev</a> ";

        for ($i = max(1, $page - 3); $i <= min($page + 3, $total_pages); $i++)
            $this->pages .= ($i == $page ? '<b>' . $i . '</b>' : " <a href='?p=$i'>$i</a> ");

        if ($page < $total_pages)
            $this->pages .= "<a href='?p=" . ($page + 1) . "'>Next</a>";


        return true;
    }
}