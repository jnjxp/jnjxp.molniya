<?php
// @codingStandardsIgnoreFile

namespace Jnjxp\Molniya;

use JsonSerializable;

class Message implements JsonSerializable
{
    protected $content;

    protected $context;

    public function __construct(string $content, string $context)
    {
        $this->content = $content;
        $this->context = $context;
    }

    public function getContent() : string
    {
        return $this->content;
    }

    public function getContext() : string
    {
        return $this->context;
    }

    public function jsonSerialize()
    {
        return [
            'content' => $this->content,
            'context' => $this->context
        ];
    }

    public function __toString()
    {
        return $this->getContent();
    }
}
