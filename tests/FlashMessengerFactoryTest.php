<?php
// @codingStandardsIgnoreFile

namespace Jnjxp\Molniya;

class FlashMessengerFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testInject()
    {
        $session = $this->getMockBuilder('Aura\Session\Session')
            ->disableOriginalConstructor()
            ->getMock();

        $segment = $this->getMockBuilder('Aura\Session\SegmentInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $session->expects($this->once())
            ->method('getSegment')
            ->with('Jnjxp\Molniya')
            ->will($this->returnValue($segment));

        $factory = new FlashMessengerFactory($session);

        $flash = $factory->newInstance();

        $this->assertInstanceOf(
            'Jnjxp\Molniya\FlashMessenger',
            $flash
        );
    }

    public function testSetter()
    {
        $session = $this->getMockBuilder('Aura\Session\Session')
            ->disableOriginalConstructor()
            ->getMock();

        $segment = $this->getMockBuilder('Aura\Session\SegmentInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $session->expects($this->once())
            ->method('getSegment')
            ->with('Jnjxp\Molniya')
            ->will($this->returnValue($segment));

        $factory = new FlashMessengerFactory();
        $factory->setSession($session);

        $flash = $factory->newInstance();

        $this->assertInstanceOf(
            'Jnjxp\Molniya\FlashMessenger',
            $flash
        );
    }

    public function testDefault()
    {
        $factory = new FlashMessengerFactory();

        $flash = $factory->newInstance();

        $this->assertInstanceOf(
            'Jnjxp\Molniya\FlashMessenger',
            $flash
        );
    }
}

