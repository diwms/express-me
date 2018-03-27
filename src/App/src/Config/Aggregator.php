<?php
declare(strict_types=1);

namespace App\Config;

use App\ConfigProvider;
use Zend\ConfigAggregator\ArrayProvider;
use Zend\ConfigAggregator\ConfigAggregator;

class Aggregator
{
    public function getMergedConfig(): array
    {
        $applicationConfig  = ConfigProvider::class;
        $globalDependencies = new ArrayProvider(Dependency::$config);
        $globalExpressive   = new ArrayProvider(Expressive::$config);

        $aggregator = new ConfigAggregator([$applicationConfig, $globalDependencies, $globalExpressive]);

        return $aggregator->getMergedConfig();
    }
}
