<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Event;

use KevinPapst\AdminLTEBundle\Model\NotificationInterface;

/**
 * The NotificationListEvent should be used with the ThemeEvents::THEME_NOTIFICATIONS
 * in order to collect all NotificationInterface objects that should be rendered in the notification section.
 */
class NotificationListEvent extends ThemeEvent
{
    /**
     * @var array
     */
    protected $notifications = [];

    /**
     * @var int
     */
    protected $total = 0;

    /**
     * @var int
     */
    protected $max = null;

    /**
     * NotificationListEvent constructor.
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
     * @return array
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * @param NotificationInterface $notificationInterface
     *
     * @return $this
     */
    public function addNotification(NotificationInterface $notificationInterface)
    {
        $this->notifications[] = $notificationInterface;

        return $this;
    }

    /**
     * @param int $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total == 0 ? count($this->notifications) : $this->total;
    }
}
