<?php

declare(strict_types=1);

namespace Jnjxp\Molniya;

use Zend\Expressive\Flash\FlashMessagesInterface;

class MessageViewHelper implements MessageViewHelperInterface
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

    public function hasMessages() : bool
    {
        return (bool) count($this->getMessages());
    }

    public function getMessages() : array
    {
        return $this->flash->getFlashes();
    }

    public function __toString() : string
    {
        if (! $this->hasMessages()) {
            return '';
        }

        $messages = '';
        foreach ($this->getMessages() as $status => $message) {
            $messages .= $this->formatMessage($status, $message);
        }

        return $this->formatContainer($messages);
    }

    protected function formatMessage(string $status, string $message) : string
    {
        return sprintf($this->message, $status, $message);
    }

    protected function formatContainer(string $messages) : string
    {
        return sprintf($this->container, $messages);
    }
}
