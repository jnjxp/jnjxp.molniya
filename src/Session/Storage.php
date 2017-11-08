<?php
// @codingStandardsIgnoreFile

namespace Jnjxp\Molniya\Session;

use Jnjxp\Molniya\StorageInterface;
use Jnjxp\Molniya\Messenger;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vperyod\SessionHandler\SessionAwareTrait;

class Storage implements StorageInterface
{
    use SessionAwareTrait;

    const SEGMENT = self::class;
    const MESSAGE_KEY = self::class . '::MESSAGE_KEY';

    protected $current;

    public function read(Request $request) : void
    {
        $segment = $this->getSegment($request);
        $current = $segment->getFlash(self::MESSAGE_KEY, null);
        $this->current = $current ?? new Messenger\Messenger;
    }

    public function newMessenger(Request $request) : Messenger\MessengerInterface
    {
        $segment   = $this->getSegment($request);
        $messenger = new Messenger\Messenger;
        $segment->setFlash(self::MESSAGE_KEY, $messenger);
        return $messenger;
    }

    public function getCurrent() : Messenger\MessengerInterface
    {
        if (! $this->current) {
            throw new \Exception('No current!');
        }

        return $this->current;
    }

    public function getSegment(Request $request)
    {
        return $this->getSessionSegment($request, self::SEGMENT);
    }


}
