<?php

declare(strict_types=1);

namespace Jnjxp\Molniya;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class MessageMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : MessageMiddleware
    {
        return new MessageMiddleware(
            $container->get(TemplateRendererInterface::class)
        );
    }
}
