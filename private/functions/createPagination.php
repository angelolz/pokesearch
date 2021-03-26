<?php
function createPagination(int $pageNum, int $rpp, int $maxPages, int $count, $options)
{
    echo '<div class="nav">';
    echo '<ul class="pagination">';

    //prev button
    if($pageNum == 1)
    {
        echo '<li id="prev">← prev</li>';
    }

    else
    {
        echo sprintf('<li id="prev"><a href="%s?page=%u&rpp=%u">← prev</a></li>', $_SERVER['PHP_SELF'], ($pageNum - 1), $rpp);
    }

    //if there are 10 pages or less
    if($maxPages <= 10)
    {
        for($i = 1; $i <= $maxPages; $i++)
        {
            if($i == $pageNum)
            {
                echo "<li>{$pageNum}</li>";
            }

            else
            {
                echo sprintf('<li><a href="%s?page=%u&rpp=%u">%u</a></li>', $_SERVER['PHP_SELF'], $i, $rpp, $i);
            }
        }
    }

    //more than 10 pages
    else
    {
        if($pageNum <= 5)
        {
            for($i = 1; $i < 10; $i++)
            {
                if($i == $pageNum)
                {
                    echo "<li>{$pageNum}</li>";
                }

                else
                {
                    echo sprintf('<li><a href="%s?page=%u&rpp=%u">%u</a></li>', $_SERVER['PHP_SELF'], $i, $rpp, $i);
                }
            }
        }

        //current page num is in the middle
        else
        {
            //if you're on the last 5 pages...
            if($pageNum >= $maxPages - 4)
            {
                for($i = $maxPages - 8; $i <= $maxPages; $i++)
                {
                    if($i == $pageNum)
                    {
                        echo "<li>{$pageNum}</li>";
                    }

                    else
                    {
                        echo sprintf('<li><a href="%s?page=%u&rpp=%u">%u</a></li>', $_SERVER['PHP_SELF'], $i, $rpp, $i);
                    }
                }
            }

            else
            {
                for($i = $pageNum - 4; $i <= $pageNum + 4; $i++)
                {
                    if($i == $pageNum)
                    {
                        echo "<li>{$pageNum}</li>";
                    }

                    else
                    {
                        echo sprintf('<li><a href="%s?page=%u&rpp=%u">%u</a></li>', $_SERVER['PHP_SELF'], $i, $rpp, $i);
                    }
                }
            }
        }
    }

    //next button
    if($pageNum == $maxPages)
    {
        echo '<li id="prev">next →</li>';
    }

    else
    {
        echo sprintf('<li id="next"><a href="%s?page=%u&rpp=%u">next →</a></li>', $_SERVER['PHP_SELF'], ($pageNum + 1), $rpp);
    }

    echo '</ul>';

    //results per page
    echo "<form>";
    echo '<label>show </label>';
    echo '<input id="currentPage" type="hidden" name="page" value="' . $pageNum . '">';
    echo sprintf('<select id="numResults" name="rpp" onchange="changeRPP(%s,%u);">', "this.form", $count);

    foreach($options as $option)
    {
        if($option == $rpp)
        {
            echo sprintf('<option value="%u" selected>%u</option>', $option, $option);
        }

        else
        {
            echo sprintf('<option value="%u">%u</option>', $option, $option);
        }
    }

    echo '</select>';
    echo '<label> results per page</label>';
    echo '</form>';
    echo '</div>';
}
?>
