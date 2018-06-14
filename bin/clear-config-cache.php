<?php

require __DIR__.'/../vendor/autoload.php';

$config = require_once __DIR__.'/../config/config.php';

if (!isset($config['config_cache_path'])) {
    echo 'No configuration cache path found'.PHP_EOL;
    exit(0);
}

if (false === unlink($config['config_cache_path'])) {
    printf(
        "Error removing config cache file '%s'%s",
        $config['config_cache_path'],
        PHP_EOL
    );

    exit(1);
}

printf(
    "Removed configured config cache file '%s'%s",
    $config['config_cache_path'],
    PHP_EOL
);

exit(0);
