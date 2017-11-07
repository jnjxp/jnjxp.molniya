<?php
// @codingStandardsIgnoreFile

namespace Jnjxp\Molniya\Session;

use Aura\Session\SegmentInterface;
use Vperyod\SessionHandler\SessionAwareTrait;

abstract class AbstractSessionService
{
    use SessionAwareTrait;

    const MESSAGE_KEY = self::class . '::MESSAGE_KEY';
    const MESSAGE_SEGMENT = self::class . '::MESSAGE_SEGMENT';

    /**
     * Get Message Segment
     *
     * @param Request $request DESCRIPTION
     *
     * @return SegmentInterface
     *
     * @access protected
     */
    protected function getMessageSegment(Request $request) : SegmentInterface
    {
        return $this->getSessionSegment($request, self::MESSAGE_SEGMENT);
    }

    protected function getMessageBag(Request $request)
    {
        $segment = $this->getMessageSegment($request);
        $bag = $segment->getFlash(self::MESSAGE_KEY, null);

        if (is_null($bag)) {
            return null;
        }

        if (! $bag instanceof MessageBag) {
            throw new \Exception('Invalid Message Bag');
        }

        return $bag;
    }

    protected function newMessageBag(Request $request)
    {
        $bag = new MessageBag;
        $segment = $this->getMessageSegment($request);
        $segment->setFlash(self::MESSAGE_KEY, $bag);
        return $bag;
    }

}
