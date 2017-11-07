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
 * @category  Interface
 * @package   Jnjxp\Molniya
 * @author    Jake Johns <jake@jakejohns.net>
 * @copyright 2017 Jake Johns
 * @license   http://jnj.mit-license.org/2017 MIT License
 * @link      http://jakejohns.net
 */

namespace Jnjxp\Molniya;

use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * CollectorInterface
 *
 * @category CategoryName
 * @package  Jnjxp\Molniya
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  https://jnj.mit-license.org/ MIT License
 * @link     https://github.com/pedl
 */
interface CollectorInterface
{
    /**
     * Collect Messages from request
     *
     * @param Request $request DESCRIPTION
     *
     * @return void
     *
     * @access public
     */
    public function collect(Request $request) : void;

    /**
     * Get collected messages
     *
     * @return array
     *
     * @throws \Exception if collect was not called
     *
     * @access public
     */
    public function getCollected();
}
