<?php
// @codingStandardsIgnoreFile

use ArrayObject;
use Countable;
use IteratorAggregate;

class ViewHelper implements Countable, IteratorAggregate
{
    protected $messages;

    public function __construct(ArrayObject $messages)
    {
        $this->messages = $messages;
    }

    public function __invoke()
    {
        return $this;
    }

    public function has()
    {
        return (bool) $this->messages->count();
    }

    public function count()
    {
        $count = 0;
        foreach ($this->messages as $context) {
            $count += count($context);
        }
    }

    public function get()
    {
        return $this->messages->getArrayCopy();
    }
}
