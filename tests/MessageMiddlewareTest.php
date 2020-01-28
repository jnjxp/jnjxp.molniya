<?php

declare(strict_types=1);

namespace Jnjxp\Molniya;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use stdClass;
use Mezzio\Template\TemplateRendererInterface;
use Mezzio\Flash\FlashMessageMiddleware;
use Mezzio\Flash\FlashMessages;

class MessageMiddlewareTest extends TestCase
{
    public function testConstructorExceptionIfNotClass()
    {
        $tpl = $this->prophesize(TemplateRendererInterface::class);
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('not-a-class');
        new MessageMiddleware($tpl->reveal(), 'not-a-class');
    }

    public function testConstructorExceptionIfClassIsNotOfInterface()
    {
        $tpl = $this->prophesize(TemplateRendererInterface::class);
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('stdClass');
        new MessageMiddleware($tpl->reveal(), stdClass::class);
    }

    public function testRaisesExceptionIfNotFlash()
    {
        $template = $this->prophesize(TemplateRendererInterface::class);
        $request  = $this->prophesize(ServerRequestInterface::class);
        $request->getAttribute(FlashMessageMiddleware::FLASH_ATTRIBUTE, false)->willReturn(false);

        $template->addDefaultParam(
            TemplateRendererInterface::TEMPLATE_ALL,
            MessageMiddleware::VIEW_KEY,
            Argument::type(MessageViewHelper::class)
        )->shouldNotBeCalled();

        $handler = $this->prophesize(RequestHandlerInterface::class);
        $handler->handle(Argument::type(ServerRequestInterface::class))->shouldNotBeCalled();

        $middleware = new MessageMiddleware($template->reveal());

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Flash not available');

        $middleware->process($request->reveal(), $handler->reveal());
    }

    public function testWorks()
    {
        $viewKey = 'other-view';
        $flashKey = 'other-flash';

        $template = $this->prophesize(TemplateRendererInterface::class);
        $flash = $this->prophesize(FlashMessages::class)->reveal();

        $template->addDefaultParam(
            TemplateRendererInterface::TEMPLATE_ALL,
            $viewKey,
            Argument::type(FakeMessages::class)
        )->shouldBeCalled();

        $request = $this->prophesize(ServerRequestInterface::class);
        $request->getAttribute($flashKey, false)->willReturn($flash);

        $response = $this->prophesize(ResponseInterface::class)->reveal();

        $handler = $this->prophesize(RequestHandlerInterface::class);
        $handler->handle(Argument::that([$request, 'reveal']))->willReturn($response);

        $middleware = new MessageMiddleware(
            $template->reveal(),
            FakeMessages::class,
            $flashKey,
            $viewKey
        );

        $this->assertSame(
            $response,
            $middleware->process($request->reveal(), $handler->reveal())
        );
    }
}
