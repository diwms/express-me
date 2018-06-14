<?php

use Zend\ServiceManager\ServiceManager;

$config = require_once __DIR__.'/config.php';
$dependencies = $config['dependencies'];
$dependencies['services']['config'] = $config;

return new ServiceManager($dependencies);
