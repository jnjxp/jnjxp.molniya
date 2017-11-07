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

use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Messenger aware trait
 *
 * Trait for objects that need to know where the mesenger is
 *
 * @category Trait
 * @package  Jnjxp\Molniya
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://jnj.mit-license.org/2016 MIT License
 * @link     https://github.com/jnjxp/jnjxp.molniya
 */
trait MessageAwareTrait
{

    /**
     * Get Messenger from request
     *
     * @param Request $request PSR7 Request
     *
     * @return MessengerInterface
     * @throws Exception if Messenger attribute is invalid
     *
     * @access protected
     */
    protected function getMessenger(Request $request) : MessengerInterface
    {
        $messenger = $request->getAttribute(MessageHandler::MESSENGER_ATTRIBUTE);

        if (! $messenger instanceof MessengerInterface) {
            throw new \Exception(
                'Messenger not available in request at: '
                . MessageHandler::MESSENGER_ATTRIBUTE
            );
        }

        return $messenger;
    }
}
