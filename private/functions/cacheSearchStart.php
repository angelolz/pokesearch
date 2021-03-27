<?php
$cacheFile = sprintf("%s/%s,search=%s,type=%s.cache", CACHE_PATH, basename($_SERVER['PHP_SELF'], ".php"), strtolower($_GET['q']), $_GET['type']);
$cacheTime = 3600; //1 hour
$cache = false;
$start = round(microtime(true) * 1000);

if(file_exists($cacheFile) && time()-$cacheTime <= filemtime($cacheFile))
{
    $c = @file_get_contents($cacheFile);
    $logger->LogInfo('loaded file: ' . $cacheFile);

    echo "<!-- Cached copy, generated ".date('H:i', filemtime($cacheFile))." -->\n";
    echo $c;

    $cache = true;
}

if(count($list->results) > 0)
{
    $startedCache = ob_start();
    $logger->LogInfo('started cache at: ' . $cacheFile);
}

else
{
    $startedCache = false;
    $logger->LogInfo('no results. no cache saved');
}
?>
