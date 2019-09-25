<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Event;

use KevinPapst\AdminLTEBundle\Model\MessageInterface;

/**
 * The MessageListEvent collects all MessageInterface objects that should be rendered in the messages section.
 */
class MessageListEvent extends ThemeEvent
{
    /**
     * Stores the list of messages
     *
     * @var array
     */
    protected $messages = [];

    /**
     * Stores the total amount
     *
     * @var int
     */
    protected $totalMessages = 0;

    /**
     * @var int
     */
    protected $max = null;

    /**
     * @param int $max Maximun number of messages displayed in panel
     */
    public function __construct($max = null)
    {
        $this->max = $max;
    }

    /**
     * Get the maximun number of notifications displayed in panel
     *
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Returns the message list
     *
     * @return array
     */
    public function getMessages()
    {
        if (null !== $this->max) {
            return array_slice($this->messages, 0, $this->max);
        }

        return $this->messages;
    }

    /**
     * Pushes the given message to the list of messages.
     *
     * @param MessageInterface $messageInterface
     *
     * @return $this
     */
    public function addMessage(MessageInterface $messageInterface)
    {
        $this->messages[] = $messageInterface;

        return $this;
    }

    /**
     * Returns the message count
     *
     * @return int
     */
    public function getTotal()
    {
        return $this->totalMessages === 0 ? count($this->messages) : $this->totalMessages;
    }

    /**
     * @param int $totalMessages
     */
    public function setTotal($totalMessages)
    {
        $this->totalMessages = $totalMessages;
    }
}
