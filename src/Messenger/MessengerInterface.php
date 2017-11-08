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
 * @category  Trait
 * @package   Jnjxp\Molniya
 * @author    Jake Johns <jake@jakejohns.net>
 * @copyright 2017 Jake Johns
 * @license   http://jnj.mit-license.org/2017 MIT License
 * @link      https://github.com/jnjxp/jnjxp.molniya
 */

namespace Jnjxp\Molniya\Messenger;

/**
 * MessengerInterface
 *
 * @category Messenger
 * @package  Jnjxp\Molniya
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  https://jnj.mit-license.org/ MIT License
 * @link     https://github.com/jnjxp/jnjxp.molniya
 *
 * @see MessengerInterface
 */
interface MessengerInterface extends \Traversable, \Countable
{

    /**
     * Do we have messages?
     *
     * @return bool
     *
     * @access public
     */
    public function exist() : bool;

    /**
     * Add message
     *
     * @param MessageInterface $message DESCRIPTION
     *
     * @return void
     *
     * @access public
     */
    public function addMessage(Message\MessageInterface $message) : void;

    /**
     * Add a message
     *
     * @param string $message DESCRIPTION
     * @param string $context DESCRIPTION
     *
     * @return Message\MessageInterface
     *
     * @access public
     */
    public function add(
        string $message,
        string $context = Message\Context::INFO
    ) : Message\MessageInterface;

    /**
     * Add as message with context success
     *
     * @param string $message message to add
     *
     * @return Message\MessageInterface
     *
     * @access public
     */
    public function success(string $message) : Message\MessageInterface;

    /**
     * Add as message with context danger
     *
     * @param string $message message to add
     *
     * @return Message\MessageInterface
     *
     * @access public
     */
    public function danger(string $message) : Message\MessageInterface;

    /**
     * Add as message with context warning
     *
     * @param string $message message to add
     *
     * @return Message\MessageInterface
     *
     * @access public
     */
    public function warning(string $message) : Message\MessageInterface;

    /**
     * Add as message with context info
     *
     * @param string $message message to add
     *
     * @return Message\MessageInterface
     *
     * @access public
     */
    public function info(string $message) : Message\MessageInterface;

}
