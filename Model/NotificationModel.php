<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Model;

use KevinPapst\AdminLTEBundle\Helper\Constants;

class NotificationModel implements NotificationInterface
{
    /**
     * @return string
     */
    protected $type = Constants::TYPE_INFO;

    /**
     * @return string
     */
    protected $message;

    /**
     * @return string
     */
    protected $icon;

    /**
     * @var string
     */
    protected $id;

    /**
     * @param string $message
     * @param string $type
     * @param string $icon
     */
    public function __construct($message = null, $type = Constants::TYPE_INFO, $icon = 'fas fa-exclamation-triangle')
    {
        $this->message = $message;
        $this->type = $type;
        $this->icon = $icon;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return NotificationModel
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string $message
     *
     * @return NotificationModel
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
     * @return NotificationModel
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
     * @return NotificationModel
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
        if (!empty($this->id)) {
            return $this->id;
        }

        return $this->message;
    }
}
