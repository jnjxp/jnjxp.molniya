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

namespace Jnjxp\Molniya;

use ArrayObject;

/**
 * Messenger
 *
 * @category Messenger
 * @package  Jnjxp\Molniya
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  https://jnj.mit-license.org/ MIT License
 * @link     https://github.com/jnjxp/jnjxp.molniya
 *
 * @see MessengerInterface
 */
class Messenger implements MessengerInterface
{
    const CONTEXT_SUCCSS  = 'success';
    const CONTEXT_DANGER  = 'danger';
    const CONTEXT_WARNING = 'warning';
    const CONTEXT_INFO    = 'info';

    /**
     * Messages
     *
     * @var ArrayObject
     *
     * @access protected
     */
    protected $messages;

    /**
     * __construct
     *
     * @param ArrayObject $messages DESCRIPTION
     *
     * @access public
     */
    public function __construct(ArrayObject $messages)
    {
        $this->messages = $messages;
    }

    /**
     * Add a message
     *
     * @param string $message DESCRIPTION
     * @param string $context DESCRIPTION
     *
     * @return void
     *
     * @access public
     */
    public function add(string $message, string $context = self::CONTEXT_INFO)
    {
        $this->messages->append(
            new Messsage($message, $context)
        );
    }

    /**
     * Add as message with context success
     *
     * @param string $message message to add
     *
     * @return void
     *
     * @access public
     */
    public function success(string $message)
    {
        $this->add($message, self::CONTEXT_SUCCSS);
    }

    /**
     * Add as message with context danger
     *
     * @param string $message message to add
     *
     * @return void
     *
     * @access public
     */
    public function danger(string $message)
    {
        $this->add($message, self::CONTEXT_DANGER);
    }

    /**
     * Add as message with context warning
     *
     * @param string $message message to add
     *
     * @return void
     *
     * @access public
     */
    public function warning(string $message)
    {
        $this->add($message, self::CONTEXT_WARNING);
    }

    /**
     * Add as message with context info
     *
     * @param string $message message to add
     *
     * @return void
     *
     * @access public
     */
    public function info(string $message)
    {
        $this->add($message, self::CONTEXT_INFO);
    }
}
