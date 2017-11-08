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

use ArrayIterator;
use IteratorAggregate;

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
class Messenger implements IteratorAggregate, MessengerInterface
{
    use MessengerTrait;

    /**
     * Messages
     *
     * @var array
     *
     * @access protected
     */
    protected $messages = [];

    /**
     * Add a message
     *
     * @param MessageInterface $message DESCRIPTION
     *
     * @return void
     *
     * @access public
     */
    public function addMessage(Message\MessageInterface $message) : void
    {
        $this->messages[] = $message;
    }

    /**
     * Count
     *
     * @return mixed
     *
     * @access public
     */
    public function count() : int
    {
        return count($this->messages);
    }

    /**
     * Get Iterator
     *
     * @return ArrayIterator
     *
     * @access public
     */
    public function getIterator() : ArrayIterator
    {
        return new ArrayIterator($this->messages);
    }
}
