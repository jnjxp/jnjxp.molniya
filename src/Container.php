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
 * @category  Container
 * @package   Jnjxp\Molniya
 * @author    Jake Johns <jake@jakejohns.net>
 * @copyright 2017 Jake Johns
 * @license   http://jnj.mit-license.org/2017 MIT License
 * @link      http://jakejohns.net
 */

namespace Jnjxp\Molniya;

/**
 * Container
 *
 * @category Container
 * @package  Jnjxp\Molniya
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  https://jnj.mit-license.org/ MIT License
 * @link     https://github.com/
 */
class Container
{
    /**
     * Collector
     *
     * @var CollectorInterface
     *
     * @access protected
     */
    protected $collector;

    /**
     * New MessengerFactory
     *
     * @return MessengerFactoryInterface
     *
     * @access public
     */
    public function newMessengerFactory() : MessengerFactoryInterface
    {
        return new Session\MessengerFactory;
    }

    /**
     * Get Collector
     *
     * @return CollectorInterface
     *
     * @access public
     */
    public function getCollector() : CollectorInterface
    {
        if (! $this->collector) {
            $this->collector = new Session\Collector;
        }
        return $this->collector;
    }

    /**
     * New view helper
     *
     * @return ViewHelper
     *
     * @access public
     */
    public function newViewHelper() : ViewHelper
    {
        $collector = $this->getCollector();
        $collected = $collector->getCollected();
        return new ViewHelper($collected);
    }

    /**
     * New Message Handler
     *
     * @return mixed
     *
     * @access public
     */
    public function newMessageHandler() : MessageHandler
    {
        $collector = $this->getCollector();
        $factory   = $this->newMessengerFactory();
        return new MessageHandler($collector, $factory);
    }
}
