<?php
// @codingStandardsIgnoreFile

namespace Jnjxp\Molniya\Messenger\Message;

/**
 * Message
 *
 * @category Message
 * @package  Jnjxp\Molniya
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  https://jnj.mit-license.org/ MIT License
 * @link     https://github.com/jnjxp/jnjxp.molniya
 *
 * @see MessageInterface
 */
class Message implements MessageInterface
{
    /**
     * Content
     *
     * @var string
     *
     * @access protected
     */
    protected $content;

    /**
     * Context
     *
     * @var string
     *
     * @access protected
     */
    protected $context;

    /**
     * __construct
     *
     * @param string $content DESCRIPTION
     * @param string $context DESCRIPTION
     *
     * @access public
     */
    public function __construct(string $content, string $context)
    {
        $this->content = $content;
        $this->context = $context;
    }

    /**
     * Get content
     *
     * @return string
     *
     * @access public
     */
    public function getContent() : string
    {
        return $this->content;
    }

    /**
     * Get context
     *
     * @return string
     *
     * @access public
     */
    public function getContext() : string
    {
        return $this->context;
    }

    /**
     * Json serialize
     *
     * @return array
     *
     * @access public
     */
    public function jsonSerialize() : array
    {
        return [
            'content' => $this->getContent(),
            'context' => $this->getContext()
        ];
    }

    /**
     * __toString
     *
     * @return string
     *
     * @access public
     */
    public function __toString() : string
    {
        return $this->getContent();
    }
}
