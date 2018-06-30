<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AdminLTEBundle\Event;

use AdminLTEBundle\Model\MessageInterface;

/**
 * The MessageListEvent should be used with the {@link ThemeEvents::THEME_MESSAGES}
 * in order to collect all {@link MessageInterface} objects that should be rendered in the messages section.
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

    protected $max = null;

    /**
     * MessageListEvent constructor.
     *
     * @param int $max Maximun number of notifications displayed in panel
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
        return $this->totalMessages == 0 ? count($this->messages) : $this->totalMessages;
    }
}
