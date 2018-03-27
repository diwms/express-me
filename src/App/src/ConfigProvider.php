<?php

declare(strict_types=1);

namespace App;

class ConfigProvider
{
    /**
     * @return array
     */
    public function __invoke()
    {
        return [
            'config'       => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container config.
     */
    public function getDependencies(): array
    {
        return [
            'factories'  => [
                Action\HomePageAction::class => Action\HomePageFactory::class,
            ],
        ];
    }

    public function getTemplates(): array
    {
        return [
            'cache' => __DIR__.'/../../../data/cache',
            'paths' => [
                'app' => __DIR__.'/../templates/app',
            ],
        ];
    }
}
