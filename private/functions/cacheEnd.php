<?php
$content = ob_get_contents();

if($startedCache)
{
    file_put_contents($cacheFile, $content);
    $logger->LogInfo('saved cache at: ' . $cacheFile);
    $logger->LogInfo("took " . (round(microtime(true) * 1000) - $start) . "ms");
}
?>
