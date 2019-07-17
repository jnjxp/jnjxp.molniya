<?php

declare(strict_types=1);

namespace Jnjxp\Molniya;

use Zend\Expressive\Flash\FlashMessagesInterface;

class FakeMessages implements MessageViewHelperInterface
{
    protected $container = '<div class="messages">%s</div>';

    protected $message = '<div class="alert alert-%s" role="alert">%s</div>' . PHP_EOL;

    protected $flash;

    private function __construct(FlashMessagesInterface $flash)
    {
        $this->flash = $flash;
    }

    public static function createFromFlash(
        FlashMessagesInterface $flash
    ) : MessageViewHelperInterface {
        return new self($flash);
    }

    public function __toString() : string
    {
        return '';
    }
}
