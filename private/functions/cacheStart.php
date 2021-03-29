<?php
$cacheFile = sprintf("%s/%s,id=%u.cache", CACHE_PATH, basename($_SERVER['PHP_SELF'], ".php"), $id);
$cacheTime = 3600; //1 hour
$start = round(microtime(true) * 1000);
$cache = false;

if(file_exists($cacheFile) && time()-$cacheTime <= filemtime($cacheFile))
{
    $c = @file_get_contents($cacheFile);
    $logger->LogInfo('loaded file: ' . $cacheFile);

    echo "<!-- Cached copy, generated ".date('H:i', filemtime($cacheFile))." -->\n";
    echo $c;

    $cache = true;
}

$startedCache = ob_start();
$logger->LogInfo('started cache at: ' . $cacheFile);
?>
