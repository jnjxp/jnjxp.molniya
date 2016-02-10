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
 * @category  Factory
 * @package   Jnjxp\Molniya
 * @author    Jake Johns <jake@jakejohns.net>
 * @copyright 2016 Jake Johns
 * @license   http://www.gnu.org/licenses/agpl-3.0.txt AGPL V3
 * @link      https://github.com/jnjxp/jnjxp.molniya
 */

namespace Jnjxp\Molniya;

use Aura\Session\Session;
use Aura\Session\SessionFactory;

/**
 * Flash Messenger Factory
 *
 * @category Factory
 * @package  Jnjxp\Molniya
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://www.gnu.org/licenses/agpl-3.0.txt AGPL V3
 * @link     https://github.com/jnjxp/jnjxp.molniya
 */
class FlashMessengerFactory
{
    /**
     * Aura Session
     *
     * @var Session
     *
     * @access protected
     */
    protected $session;

    /**
     * Create a new flash messenger factory
     *
     * @param Session $session Optional session from which to get the segment
     *
     * @access public
     */
    public function __construct(Session $session = null)
    {
        $this->session = $session;
    }

    /**
     * Create a new flash messenger
     *
     * @param string $name Segment namespace
     *
     * @return FlashMessenger
     *
     * @access public
     */
    public function newInstance($name = 'Jnjxp\Molniya')
    {
        $session = $this->getSession();
        $segment = $session->getSegment($name);
        return new FlashMessenger($segment);
    }

    /**
     * Set Session
     *
     * @param Session $session Session instance from which to get segment
     *
     * @return mixed
     *
     * @access public
     */
    public function setSession(Session $session)
    {
        $this->session = $session;
        return $this;
    }

    /**
     * Get the session or create a new default one if one not set
     *
     * @return Session
     *
     * @access protected
     */
    protected function getSession()
    {
        if (null == $this->session) {
            $this->session = (new SessionFactory)->newInstance($_COOKIE);
        }
        return $this->session;
    }
}
