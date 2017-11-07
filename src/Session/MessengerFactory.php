<?php
// @codingStandardsIgnoreFile

namespace Jnjxp\Molniya\Session;

class MessengerFactory extends AbstarctSessionService implements MessageFactoryInterface
{
    public function fromRequest(Request $request) : MessengerInterface
    {
        $bag = $this->newMessageBag($request);
        return new Messenger($bag);
    }
}
