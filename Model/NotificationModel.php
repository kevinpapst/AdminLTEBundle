<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Model;

class NotificationModel implements NotificationInterface
{
    /**
     * @return string
     */
    protected $type;

    /**
     * @return string
     */
    protected $message;

    /**
     * @return string
     */
    protected $icon;

    /**
     * @param string $message
     * @param string $type
     * @param string $icon
     */
    public function __construct($message = null, $type = 'info', $icon = 'fas fa-exclamation-triangle')
    {
        $this->message = $message;
        $this->type = $type;
        $this->icon = $icon;
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $icon
     *
     * @return $this
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->message;
    }
}
