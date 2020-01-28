<?php

declare(strict_types=1);

namespace Jnjxp\Molniya;

use Mezzio\Flash\FlashMessagesInterface;

interface MessageViewHelperInterface
{
    public static function createFromFlash(
        FlashMessagesInterface $flash
    ) : MessageViewHelperInterface;

    public function __toString() : string;
}
