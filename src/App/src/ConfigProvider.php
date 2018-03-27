<?php

declare(strict_types=1);

namespace App;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    public function getDependencies(): array
    {
        return ['invokables'=>[Http\Handler\DummyHandler::class],'factories' => [

        ]];
    }

    public function getTemplates(): array
    {
        return [
            'paths' => [
                'error'   => [__DIR__ . '/../templates/error'],
                'layout'   => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
