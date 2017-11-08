<?php
// @codingStandardsIgnoreFile

namespace Jnjxp\Molniya\View;

use Jnjxp\Molniya\StorageInterface;

class Helper
{
    protected $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function __invoke()
    {
        return $this->storage->getCurrent();
    }

}
