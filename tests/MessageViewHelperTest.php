<?php

declare(strict_types=1);

namespace Jnjxp\Molniya;

use PHPUnit\Framework\TestCase;
use Zend\Expressive\Flash\FlashMessagesInterface;

class MessageViewHelperTest extends TestCase
{

    public function setUp() : void
    {
        $this->flash = $this->prophesize(FlashMessagesInterface::class);
    }

    public function testHas()
    {
        $this->flash->getFlashes()->willReturn(['foo' => 'bar']);
        $helper = MessageViewHelper::createFromFlash($this->flash->reveal());

        $expect = '<div class="messages"><div class="alert alert-foo" role="alert">bar</div>'
            . "\n</div>";

        $this->assertIsString((string) $helper);
        $this->assertEquals($expect, (string) $helper);
    }

    public function testHasNone()
    {
        $this->flash->getFlashes()->willReturn([]);
        $helper = MessageViewHelper::createFromFlash($this->flash->reveal());

        $this->assertIsString((string) $helper);
        $this->assertEquals('', (string) $helper);
    }
}
