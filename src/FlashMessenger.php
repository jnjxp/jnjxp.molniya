<?php
/**
 * Molniya - Flash Messenger
 *
 * PHP version 5
 *
 * This program is free software: you can redistribute it and/or modify it
 * under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or (at your
 * option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @category  FlashMessenger
 * @package   Jnjxp\Molniya
 * @author    Jake Johns <jake@jakejohns.net>
 * @copyright 2016 Jake Johns
 * @license   http://www.gnu.org/licenses/agpl-3.0.txt AGPL V3
 * @link      https://github.com/jnjxp/jnjxp.molniya
 */

namespace Jnjxp\Molniya;

use Aura\Session\SegmentInterface;

/**
 * FlashMessenger
 *
 * @category FlashMessenger
 * @package  Jnjxp\Molniya
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://www.gnu.org/licenses/agpl-3.0.txt AGPL V3
 * @link     https://github.com/jnjxp/jnjxp.molniya
 */
class FlashMessenger
{
    /**
     * Key to store the messages under in the session
     *
     * @var string
     *
     * @access protected
     */
    protected $key = 'messages';

    /**
     * Temporary container for messages
     *
     * @var array
     *
     * @access protected
     */
    protected $container = [];

    /**
     * Aura\Session\Segment to use for message storage and retrival
     *
     * @var SegmentInterface
     *
     * @access protected
     */
    protected $segment;

    /**
     * Create a FlashMessenger
     *
     * @param SegmentInterface $segment Session segment
     *
     * @access public
     */
    public function __construct(SegmentInterface $segment)
    {
        $this->segment = $segment;
    }

    /**
     * Add a message
     *
     * @param string $message Text of the message
     * @param string $level   Optional message level. Default: info
     *
     * @return $this
     *
     * @access public
     */
    public function add($message, $level = 'info')
    {
        $this->container[$level][] = $message;
        $this->writeSession();
        return $this;
    }

    /**
     * Set all messages for a level
     *
     * @param string|array $messages Array of messages
     * @param string       $level    Message level. Default: info
     *
     * @return $this
     *
     * @access public
     */
    public function set($messages, $level = 'info')
    {
        $messages = (array) $messages;

        $this->container[$level] = $messages;
        $this->writeSession();
        return $this;
    }

    /**
     * Set all messages of all levels
     *
     * @param array $messages Multi-dimensional array of Levels/Messages
     *
     * @return $this
     *
     * @access public
     */
    public function setAll(array $messages)
    {
        $formatted = [];
        foreach ($messages as $level => $msgs) {
            $formatted[$level] = (array) $msgs;
        }
        $this->container = $formatted;
        $this->writeSession();
        return $this;
    }

    /**
     * Get messages for given level
     *
     * @param string $level Level of messages to get. Default: info
     *
     * @return array
     *
     * @access public
     */
    public function get($level = 'info')
    {
        $messages = $this->getAll();
        return isset($messages[$level]) ? $messages[$level] : [];
    }

    /**
     * Get messages of all levels
     *
     * @return array
     *
     * @access public
     */
    public function getAll()
    {
        return $this->segment->getFlash($this->key, []);
    }

    /**
     * Get messages for level set for next request
     *
     * @param string $level Level of messages to get. Default: info
     *
     * @return array
     *
     * @access public
     */
    public function getNext($level = 'info')
    {
        $messages = $this->getNextAll();
        return isset($messages[$level]) ? $messages[$level] : [];
    }

    /**
     * Get all messages set for next request
     *
     * @return array
     *
     * @access public
     */
    public function getNextAll()
    {
        return $this->segment->getFlashNext($this->key, []);
    }

    /**
     * Check if messages are set for a level
     *
     * @param string $level Level of messages to check. Default: info.
     *
     * @return bool
     *
     * @access public
     */
    public function has($level = 'info')
    {
        return (bool) count(array_filter($this->get($level)));
    }

    /**
     * Check if any messages of any level are set
     *
     * @return bool
     *
     * @access public
     */
    public function hasAny()
    {
        return (bool) count(array_filter($this->getAll()));
    }

    /**
     * Check if messages of given level are set for next request
     *
     * @param string $level Level of messages to check
     *
     * @return bool
     *
     * @access public
     */
    public function nextHas($level = 'info')
    {
        return (bool) count(array_filter($this->getNext($level)));
    }

    /**
     * Check if any messages of any level are set for next request
     *
     * @return bool
     *
     * @access public
     */
    public function nextHasAny()
    {
        return (bool) count(array_filter($this->getNextAll()));
    }

    /**
     * Clear messages for given level
     *
     * @param string $level Level of messages to clear
     *
     * @return $this
     *
     * @access public
     */
    public function clear($level = 'info')
    {
        return $this->set([], $level);
    }

    /**
     * Clear all messages of all levels
     *
     * @return $this
     *
     * @access public
     */
    public function clearAll()
    {
        return $this->setAll([]);
    }

    /**
     * Keep all current messages for next request
     *
     * @return $this
     *
     * @access public
     */
    public function keep()
    {
        $cur = $this->getAll();
        $next = $this->getNextAll();
        return $this->setAll(array_merge_recursive($cur, $next));
    }

    /**
     * __call
     *
     * @param string $name level of messages to set
     * @param string $args message to set
     *
     * @return $this
     *
     * @access public
     */
    public function __call($name, $args)
    {
        return $this->add($args[0], $name);
    }

    /**
     * Write messages to flash session storage
     *
     * @return $this
     *
     * @access protected
     */
    protected function writeSession()
    {
        $this->segment->setFlash($this->key, array_filter($this->container));
        return $this;
    }
}
