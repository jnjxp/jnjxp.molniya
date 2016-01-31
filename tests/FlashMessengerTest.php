<?php
// @codingStandardsIgnoreFile

namespace Jnjxp\Molniya;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class FlashMessengerTest extends \PHPUnit_Framework_TestCase
{
    protected $segment;

    protected $flash;

    public function setUp()
    {
        $this->segment = $this->getMockBuilder('Aura\Session\SegmentInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $this->flash = new FlashMessenger($this->segment);
    }

    protected function expectWrite($msgs)
    {
        $this->segment->expects($this->once())
            ->method('setFlash')
            ->with(
                $this->equalTo('messages'),
                $this->equalTo($msgs)
            );
        return $this;
    }

    protected function expectRead($msgs)
    {
        $this->segment->expects($this->once())
            ->method('getFlash')
            ->with(
                $this->equalTo('messages'),
                $this->equalTo([])
            )->will($this->returnValue($msgs));
        return $this;
    }

    protected function expectReadNext($msgs)
    {
        $this->segment->expects($this->once())
            ->method('getFlashNext')
            ->with(
                $this->equalTo('messages'),
                $this->equalTo([])
            )->will($this->returnValue($msgs));
        return $this;
    }

    protected function assertFluent($result)
    {
        $this->assertSame($this->flash, $result);
        return $this;
    }

    public function testAdd()
    {
        $this->expectWrite(['bar' => ['foo']])
            ->assertFluent($this->flash->add('foo', 'bar'));
    }

    public function testSet()
    {
        $this->flash->add('foo', 'info');

        $msg = ['info' => ['boo', 'bah']];
        $this->expectWrite($msg);
        $this->assertFluent($this->flash->set(['boo', 'bah']));
    }

    public function testSetAll()
    {
        $this->flash->add('foo', 'bar');

        $msg = ['boo' => ['bah']];
        $this->expectWrite($msg);
        $this->assertFluent($this->flash->setAll($msg));
    }

    public function testGet()
    {
        $msgs = [
            'foo' => ['bar', 'baz'],
            'bing' => ['bam', 'boom'],
            'info' => ['mation']
        ];

        $this->expectRead($msgs)
            ->assertEquals(
                $msgs['foo'],
                $this->flash->get('foo')
            );
    }

    public function testGetNext()
    {
        $msgs = [
            'foo' => ['bar', 'baz'],
            'bing' => ['bam', 'boom'],
            'info' => ['mation']
        ];

        $this->expectReadNext($msgs)
            ->assertEquals(
                $msgs['foo'],
                $this->flash->getNext('foo')
            );
    }

    public function testGetDefault()
    {
        $msgs = [
            'foo' => ['bar', 'baz'],
            'bing' => ['bam', 'boom'],
            'info' => ['mation']
        ];

        $this->expectRead($msgs)
            ->assertEquals(
                $msgs['info'],
                $this->flash->get()
            );
    }

    public function testGetAll()
    {
        $msgs = [
            'foo' => ['bar', 'baz'],
            'bing' => ['bam', 'boom']
        ];

        $this->expectRead($msgs)
            ->assertEquals(
                $msgs,
                $this->flash->getAll()
            );
    }


    public function testGetNextAll()
    {
        $msgs = [
            'foo' => ['bar', 'baz'],
            'bing' => ['bam', 'boom']
        ];

        $this->expectReadNext($msgs)
            ->assertEquals(
                $msgs,
                $this->flash->getNextAll()
            );
    }

    public function testHas()
    {
        $msgs = [
            'foo' => ['bar', 'baz'],
            'bing' => ['bam', 'boom'],
            'info' => ['mation']
        ];

        $this->expectRead($msgs)
            ->assertTrue($this->flash->has('foo'));
    }

    public function testNextHas()
    {
        $msgs = [
            'foo' => ['bar', 'baz'],
            'bing' => ['bam', 'boom'],
            'info' => ['mation']
        ];

        $this->expectReadNext($msgs)
            ->assertTrue($this->flash->nextHas('foo'));
    }

    public function testHasDefault()
    {
        $msgs = [
            'foo' => ['bar', 'baz'],
            'bing' => ['bam', 'boom'],
            'info' => ['mation']
        ];

        $this->expectRead($msgs)
            ->assertTrue($this->flash->has());
    }

    public function testNotHas()
    {
        $msgs = [
            'foo' => ['bar', 'baz'],
            'bing' => ['bam', 'boom'],
            'info' => ['mation']
        ];

        $this->expectRead($msgs)
            ->assertFalse($this->flash->has('bar'));
    }

    public function testHasAny()
    {
        $msgs = [
            'foo' => ['bar', 'baz'],
            'bing' => ['bam', 'boom'],
            'info' => ['mation']
        ];

        $this->expectRead($msgs)
            ->assertTrue($this->flash->hasAny());
    }

    public function testNextHasAny()
    {
        $msgs = [
            'foo' => ['bar', 'baz'],
            'bing' => ['bam', 'boom'],
            'info' => ['mation']
        ];

        $this->expectReadNext($msgs)
            ->assertTrue($this->flash->nextHasAny());
    }

    public function testNotHasAny()
    {
        $msgs = [
            'info' => []
        ];

        $this->expectRead($msgs)
            ->assertFalse($this->flash->hasAny());
    }

    public function testClear()
    {
        $this->flash->add('asd')
            ->add('bar', 'foo');

        $this->expectWrite(['foo' => ['bar']])
            ->assertFluent($this->flash->clear());
    }

    public function testClearAll()
    {
        $this->flash->add('asd');

        $this->expectWrite([])
            ->assertFluent($this->flash->clearAll());
    }

    public function testCall()
    {
        $expect = ['baz' => ['foo']];

        $this->expectWrite($expect)
            ->assertFluent($this->flash->baz('foo'));
    }

    public function testKeep()
    {
        $cur = [
            'info' => ['foo']
        ];

        $next = [
            'info' => ['bar'],
            'warning' => [
                'baz', 'bing'
            ]
        ];

        $new = array_merge_recursive($cur, $next);

        $this->expectRead($cur)
            ->expectReadNext($next)
            ->expectWrite($new)
            ->assertFluent($this->flash->keep());
    }

}

