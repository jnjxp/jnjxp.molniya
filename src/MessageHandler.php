<?php
/**
 * Molniya Messenger
 *
 * PHP version 5
 *
 * Copyright (C) 2017 Jake Johns
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 *
 * @category  Middleware
 * @package   Jnjxp\Molniya
 * @author    Jake Johns <jake@jakejohns.net>
 * @copyright 2017 Jake Johns
 * @license   http://jnj.mit-license.org/2017 MIT License
 * @link      http://jakejohns.net
 */

namespace Jnjxp\Molniya;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * MessageHandler
 *
 * @category Middleware
 * @package  Jnjxp\Molniya
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  https://jnj.mit-license.org/ MIT License
 * @link     https://github.com/
 */
class MessageHandler
{
    const MESSAGE_ATTRIBUTE = MessengerInterface::class;

    /**
     * Collector
     *
     * @var CollectorInterface
     *
     * @access protected
     */
    protected $collector;

    /**
     * Factory
     *
     * @var MessengerFactoryInterface
     *
     * @access protected
     */
    protected $factory;

    /**
     * __construct
     *
     * @param CollectorInterface      $collector DESCRIPTION
     * @param MessageFactoryInterface $factory   DESCRIPTION
     *
     * @return mixed
     *
     * @access public
     */
    public function __construct(
        CollectorInterface $collector,
        MessageFactoryInterface $factory
    ) {
        $this->collector = $collector;
        $this->factory = $factory;
    }

    /**
     * __invoke
     *
     * @param Request  $request  DESCRIPTION
     * @param Response $response DESCRIPTION
     * @param callable $next     DESCRIPTION
     *
     * @return Response
     *
     * @access public
     */
    public function __invoke(
        Request $request,
        Response $response,
        callable $next
    ) : Response {

        $collector = $this->collector;
        $factory   = $this->factory;

        $collector->collect($request);

        $messenger = $factory->fromRequest($request);
        $request   = $request->withAttribute(self::MESSAGE_ATTRIBUTE, $messenger);

        return $next($request, $response);
    }
}
