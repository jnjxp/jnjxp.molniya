<?php

declare(strict_types=1);

namespace Jnjxp\Molniya;

class ConfigProvider
{
    public function __invoke() : array
    {
        return [
            'dependencies' => [
                'factories'  => [
                    MessageMiddleware::class => MessageMiddlewareFactory::class
                ],
            ]
        ];
    }
}
