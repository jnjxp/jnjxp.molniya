<?php
// @codingStandardsIgnoreFile

namespace Jnjxp\Molniya;

use Psr\Http\Message\ServerRequestInterface as Request;

interface StorageInterface
{
    public function read(Request $request);

    public function newMessenger(Request $request);
}
