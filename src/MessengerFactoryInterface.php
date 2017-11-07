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
 * @category  Factory
 * @package   Jnjxp\Molniya
 * @author    Jake Johns <jake@jakejohns.net>
 * @copyright 2017 Jake Johns
 * @license   http://jnj.mit-license.org/2017 MIT License
 * @link      http://jakejohns.net
 */

namespace Jnjxp\Molniya;

use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * MessageFactoryInterface
 *
 * @category Factory
 * @package  Jnjxp\Molniya
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  https://jnj.mit-license.org/ MIT License
 * @link     https://github.com/
 */
interface MessageFactoryInterface
{
    /**
     * Create Messenger from request
     *
     * @param Request $request PSR7 Request
     *
     * @return MessengerInterface
     *
     * @access public
     */
    public function fromRequest(Request $request) : MessengerInterface;
}
