<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AdminLTEBundle\Event;

use AdminLTEBundle\Model\NotificationInterface;

/**
 * Class NotificationListEvent
 */
class NotificationListEvent extends ThemeEvent
{
    /**
     * @var array
     */
    protected $notifications = [];

    protected $total = 0;

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
