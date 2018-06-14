<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$container = require_once __DIR__ . '/../config/container.php';

/** @var \Doctrine\ORM\EntityManager $em */
$em = $container->get(EntityManager::class);

return ConsoleRunner::createHelperSet($em);
