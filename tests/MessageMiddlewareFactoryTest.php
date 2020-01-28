<?php

declare(strict_types=1);

namespace Jnjxp\Molniya;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Mezzio\Template\TemplateRendererInterface;

class MessageMiddlewareFactoryTest extends TestCase
{

    public function testFactory()
    {
        $container = $this->prophesize(ContainerInterface::class);
        $template = $this->prophesize(TemplateRendererInterface::class);
        $container->get(TemplateRendererInterface::class)->willReturn($template);

        $factory = new MessageMiddlewareFactory();
        $middleware = $factory($container->reveal());

        $this->assertInstanceOf(MessageMiddleware::class, $middleware);
    }
}
