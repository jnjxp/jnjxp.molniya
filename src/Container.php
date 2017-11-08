<?php
// @codingStandardsIgnoreFile


namespace Jnjxp\Molniya;

class Container
{
    protected $storage;

    public function getStorage() : StorageInterface
    {
        if (! $this->storage) {
            $this->storage = new Session\Storage;
        }
        return $this->storage;
    }

    public function newMessageHandler() : MessageHandler
    {
        $storage = $this->getStorage();
        return new MessageHandler($storage);
    }

    public function newViewHelper() : View\Helper
    {
        $storage = $this->getStorage();
        return new View\Helper($storage);
    }

}
