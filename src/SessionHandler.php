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
 * @category  Middleware
 * @package   Jnjxp\Molniya
 * @author    Jake Johns <jake@jakejohns.net>
 * @copyright 2016 Jake Johns
 * @license   http://www.gnu.org/licenses/agpl-3.0.txt AGPL V3
 * @link      https://github.com/jnjxp/jnjxp.molniya
 */

namespace Jnjxp\Molniya;

use Aura\Session\SessionFactory;
use Aura\Session\Session;

use Jnjxp\Molniya\FlashMessengerFactory as MessengerFactory;
use Jnjxp\Molniya\FlashMessenger as Messenger;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * SessionHandler
 *
 * @category Middleware
 * @package  Jnjxp\Molniya
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://www.gnu.org/licenses/agpl-3.0.txt AGPL V3
 * @link     https://github.com/jnjxp/jnjxp.molniya
 */
class SessionHandler
{
    /**
     * Session factory
     *
     * @var SessionFactory
     *
     * @access protected
     */
    protected $sessionFactory;

    /**
     * Flash messenger factory
     *
     * @var MessengerFactory
     *
     * @access protected
     */
    protected $messengerFactory;

    /**
     * Session attribute
     *
     * @var string
     *
     * @access protected
     */
    protected $sessionAttribute = 'aura/session:session';

    /**
     * Messenger attribute
     *
     * @var string
     *
     * @access protected
     */
    protected $messengerAttribute = 'jnjxp/molniya:messenger';

    /**
     * Messenger namespace
     *
     * @var string
     *
     * @access protected
     */
    protected $messengerNamespace = 'Jnjxp\Molniya';

    /**
     * Create a session handler
     *
     * @param SessionFactory   $sessionFactory   Session factory
     * @param MessengerFactory $messengerFactory Flash messenger factory
     *
     * @access public
     */
    public function __construct(
        SessionFactory $sessionFactory = null,
        MessengerFactory $messengerFactory = null
    ) {
        $this->sessionFactory = $sessionFactory ?: new SessionFactory();
        $this->messengerFactory = $messengerFactory ?: new MessengerFactory();
    }

    /**
     * Set session attribute
     *
     * @param string $attr name of attribute for session
     *
     * @return $this
     *
     * @access public
     */
    public function setSessionAttribute($attr)
    {
        $this->sessionAttribute = $attr;
        return $this;
    }

    /**
     * Set messenger attribute
     *
     * @param string $attr name of attribute for messenger
     *
     * @return $this
     *
     * @access public
     */
    public function setMessengerAttribute($attr)
    {
        $this->messengerAttribute = $attr;
        return $this;
    }

    /**
     * Set messenger namespace
     *
     * @param string $name namespace for messenger segment
     *
     * @return $this
     *
     * @access public
     */
    public function setMessengerNamespace($name)
    {
        $this->messengerNamespace = $name;
        return $this;
    }

    /**
     * Create session and messenger and set them as request attributes
     *
     * @param Request  $request  PSR7 Request
     * @param Response $response PSR7 Response
     * @param callable $next     Next callable middleware
     *
     * @return Response
     *
     * @access public
     */
    public function __invoke(Request $request, Response $response, callable $next)
    {
        $session = $this->newSession($request);
        $request = $this->setRequestSession($request, $session);

        $messenger = $this->newMessenger($session);
        $request = $this->setRequestMessenger($request, $messenger);

        return $next($request, $response);
    }

    /**
     * Create a new session from request
     *
     * @param Request $request PSR7 request
     *
     * @return Session
     *
     * @access protected
     */
    protected function newSession(Request $request)
    {
        return $this->sessionFactory->newInstance($request->getCookieParams());
    }

    /**
     * Store session in request attribute if attributes present
     *
     * @param Request $request PSR7 request
     * @param Session $session Session object
     *
     * @return Request
     *
     * @access protected
     */
    protected function setRequestSession(Request $request, Session $session)
    {
        if ($this->sessionAttribute !== null) {
            $request = $request->withAttribute(
                $this->sessionAttribute,
                $session
            );
        }
        return $request;
    }

    /**
     * Create new messenger from session
     *
     * @param Session $session Session object
     *
     * @return Messenger
     *
     * @access protected
     */
    protected function newMessenger(Session $session)
    {
        return $this->messengerFactory
            ->setSession($session)
            ->newInstance($this->messengerNamespace);
    }

    /**
     * Set messenger as request attribute if attribute preesent
     *
     * @param Request   $request   DESCRIPTION
     * @param Messenger $messenger DESCRIPTION
     *
     * @return Request
     *
     * @access protected
     */
    protected function setRequestMessenger(Request $request, Messenger $messenger)
    {
        if ($this->messengerAttribute !== null) {
            $request = $request->withAttribute(
                $this->messengerAttribute,
                $messenger
            );
        }
        return $request;
    }
}
