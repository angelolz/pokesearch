<?php
function formatNum($num)
{
    $numDigits = strlen((string) $num);
    $entryNum = "#" . str_pad((string) $num, 3, "0", STR_PAD_LEFT);

    return $entryNum;
}
?>
