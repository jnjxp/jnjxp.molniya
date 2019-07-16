<?php

declare(strict_types=1);

namespace Jnjxp\Molniya;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Flash\FlashMessageMiddleware;
use Zend\Expressive\Template\TemplateRendererInterface;

class MessageMiddleware implements MiddlewareInterface
{
    protected $template;

    protected $factory;

    protected $flashKey;

    protected $viewKey;

    public function __construct(
        TemplateRendererInterface $template,
        string $helper = MessageViewHelper::class,
        string $flashKey = FlashMessageMiddleware::FLASH_ATTRIBUTE,
        string $viewKey = 'messages'
    ) {
        if (! class_exists($helper)
            || ! in_array(MessageViewHelperInterface::class, class_implements($helper), true)
        ) {
            throw new \Exception($helper);
        }

        $this->factory  = [$helper, 'createFromFlash'];
        $this->template = $template;
        $this->flashKey = $flashKey;
        $this->viewKey  = $viewKey;
    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ) : ResponseInterface {

        $flash  = $request->getAttribute($this->flashKey);
        $helper = ($this->factory)($flash);
        $this->addToView($helper);

        return $handler->handle($request);
    }

    protected function addToView(MessageViewHelperInterface $helper) : void
    {
        $this->template->addDefaultParam(
            TemplateRendererInterface::TEMPLATE_ALL,
            $this->viewKey,
            $helper
        );
    }
}
