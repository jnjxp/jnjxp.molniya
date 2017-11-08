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

/**
 * MessageHandler
 *
 * @category Middleware
 * @package  Jnjxp\Molniya
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  https://jnj.mit-license.org/ MIT License
 * @link     https://github.com/
 */
trait MessageAwareTrait
{
    /**
     * GetMessenger
     *
     * @param Request $request DESCRIPTION
     *
     * @return mixed
     * @throws \Exception if no mesenger available
     *
     * @access public
     */
    public function getMessenger(Request $request)
    {
        $messenger = $request->getAttribute(MessageHandler::MESSENGER_ATTRIBUTE);
        if (! $messenger instanceof Messenger\MessengerInterface) {
            throw new \Exception('Invalid Messenger');
        }
        return $messenger;
    }

    /**
     * SafeGetMessenger
     *
     * @param Request $request DESCRIPTION
     *
     * @return mixed
     *
     * @access public
     */
    public function safeGetMessenger(Request $request)
    {
        $messenger = $request->getAttribute(MessageHandler::MESSENGER_ATTRIBUTE);
        if (! $messenger instanceof Messenger\MessengerInterface) {
            $messenger = new Messenger\Messenger;
        }
        return $messenger;
    }
}
