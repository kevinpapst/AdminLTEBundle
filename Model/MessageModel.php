<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Model;

class MessageModel implements MessageInterface
{
    /**
     * Holds the sender
     *
     * @var UserInterface
     */
    protected $from;

    /**
     * holds the Recipient
     *
     * @var UserInterface
     */
    protected $to;

    /**
     * holds the date sent
     *
     * @var \DateTime
     */
    protected $sentAt;

    /**
     * holds the subject
     *
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $id;

    /**
     * Creates a new MessageModel object with the given values.
     *
     * SentAt will be set to the current DateTime when null is given.
     *
     * @param UserInterface $from
     * @param string $subject
     * @param \DateTime $sentAt
     * @param UserInterface $to
     */
    public function __construct(UserInterface $from = null, $subject = '', $sentAt = null, UserInterface $to = null)
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->sentAt = $sentAt ?: new \DateTime();
        $this->from = $from;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return MessageModel
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set the sender
     *
     * @param UserInterface $from
     *
     * @return $this
     */
    public function setFrom(UserInterface $from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get the Sender
     *
     * @return UserInterface
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set the date sent
     *
     * @param \DateTime $sentAt
     *
     * @return $this
     */
    public function setSentAt(\DateTime $sentAt)
    {
        $this->sentAt = $sentAt;

        return $this;
    }

    /**
     * Get the date sent
     *
     * @return \DateTime
     */
    public function getSentAt()
    {
        return $this->sentAt;
    }

    /**
     * Set the subject
     *
     * @param string $subject
     *
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get the subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set the recipient
     *
     * @param UserInterface $to
     *
     * @return $this
     */
    public function setTo(UserInterface $to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get the recipient
     *
     * @return UserInterface
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Get the identifier
     *
     * @return string
     */
    public function getIdentifier()
    {
        if (!empty($this->id)) {
            return $this->id;
        }

        return $this->getSubject();
    }
}
