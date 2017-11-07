<?php
// @codingStandardsIgnoreFile

class Collector extends AbstarctSessionService
{
    protected $messages = [];

    protected $hasCollected = false;

    public function collect(Request $request) : void
    {
        $this->hasCollected = true;
        $bag = $this->getMessageBag($request);

        if (is_null($bag)) {
            return;
        }

        $this->messages = $bag->getArrayCopy();
        return;
    }

    public function getCollected()
    {
        if (! $this->hasCollected) {
            throw new \Exception('Messages not collected');
        }

        return $this->collected;
    }
}
