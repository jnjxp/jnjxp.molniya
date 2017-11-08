<?php
// @codingStandardsIgnoreFile

namespace Jnjxp\Molniya\Messenger\Message;

use JsonSerializable;

/**
 * MessageInterface
 *
 * @category Message
 * @package  Jnjxp\Molniya
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  https://jnj.mit-license.org/ MIT License
 * @link     https://github.com/
 */
interface MessageInterface extends JsonSerializable
{
    /**
     * Get message content
     *
     * @return string
     *
     * @access public
     */
    public function getContent() : string;

    /**
     * Get message context
     *
     * @return string
     *
     * @access public
     */
    public function getContext() : string;

    /**
     * Convert message to string
     *
     * @return string
     *
     * @access public
     */
    public function __toString() : string;
}
