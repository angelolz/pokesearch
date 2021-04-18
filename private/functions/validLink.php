<?php
$url = str_replace(" ", "-", strtolower(trim($_POST["name"])));
$headers = get_headers($url, 1);

if(!$headers || $headers[0] == 'HTTP/1.1 404 Not Found')
{
    echo "false";
}

else
{
    echo "true";
}
?>
