<?php
// @codingStandardsIgnoreFile

namespace Jnjxp\Molniya;

use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory;

class SessionHandlerTest extends \PHPUnit_Framework_TestCase
{

    public function testHandler()
    {
        $handler = new SessionHandler();

        $handler->setSessionAttribute('session')
            ->setMessengerAttribute('messenger')
            ->setMessengerNamespace('namespace');

        $handler(
            ServerRequestFactory::fromGlobals(),
            new Response(),
            [$this, 'checkRequest']
        );
    }

    public function checkRequest($request, $response)
    {
        $this->assertInstanceOf(
            'Aura\Session\Session',
            $request->getAttribute('session')
        );

        $this->assertInstanceOf(
            'Jnjxp\Molniya\FlashMessenger',
            $request->getAttribute('messenger')
        );

        return $response;
    }
}

