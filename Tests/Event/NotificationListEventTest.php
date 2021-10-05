<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Tests\Event;

use KevinPapst\AdminLTEBundle\Event\NotificationListEvent;
use KevinPapst\AdminLTEBundle\Helper\Constants;
use KevinPapst\AdminLTEBundle\Model\NotificationModel;
use PHPUnit\Framework\TestCase;

class NotificationListEventTest extends TestCase
{
    /**
     * @test
     */
    public function total_should_be_zero_and_max_null_when_there_are_no_notification()
    {
        $event = new NotificationListEvent();
        $this->assertEquals(0, $event->getTotal());
        $this->assertEquals(null, $event->getMax());
    }

    /**
     * @test
     */
    public function total_should_be_equal_the_number_of_notifications_if_max_is_greater_then_the_number_of_notifications()
    {
        $event = new NotificationListEvent(10);
        $notifications = $this->generateNbNotifications(7);

        foreach ($notifications as $notification) {
            $event->addNotification($notification);
        }

        $this->assertEquals(7, $event->getTotal());
        $this->assertEquals(10, $event->getMax());
        $this->assertEquals(7, \count($event->getNotifications()));
    }

    /**
     * @test
     */
    public function total_should_equal_the_number_of_notifications_and_count_notifications_should_equal_max_when_max_is_lower_then_the_number_of_notifications()
    {
        $event = new NotificationListEvent(5);
        $notifications = $this->generateNbNotifications(7);

        foreach ($notifications as $notification) {
            $event->addNotification($notification);
        }

        $this->assertEquals(7, $event->getTotal());
        $this->assertEquals(5, $event->getMax());
        $this->assertEquals(5, \count($event->getNotifications()));
    }

    /**
     * @test
     */
    public function total_equal_the_number_of_notifications_when_max_is_null()
    {
        $event = new NotificationListEvent();
        $notifications = $this->generateNbNotifications(7);

        foreach ($notifications as $notification) {
            $event->addNotification($notification);
        }

        $this->assertEquals(7, $event->getTotal());
        $this->assertEquals(null, $event->getMax());
        $this->assertEquals(7, \count($event->getNotifications()));
    }

    /**
     * @test
     */
    public function you_can_set_total_to_be_different_from_the_number_of_notifications()
    {
        $event = new NotificationListEvent();
        $notifications = $this->generateNbNotifications(7);

        foreach ($notifications as $notification) {
            $event->addNotification($notification);
        }
        $event->setTotal(15);

        $this->assertEquals(15, $event->getTotal());
        $this->assertEquals(null, $event->getMax());
        $this->assertEquals(7, \count($event->getNotifications()));
    }

    /**
     * @test
     */
    public function you_can_set_total_to_be_different_from_the_number_of_notifications_and_set_max_to_another_value()
    {
        $event = new NotificationListEvent(3);
        $notifications = $this->generateNbNotifications(7);

        foreach ($notifications as $notification) {
            $event->addNotification($notification);
        }
        $event->setTotal(15);

        $this->assertEquals(15, $event->getTotal());
        $this->assertEquals(3, $event->getMax());
        $this->assertEquals(3, \count($event->getNotifications()));
    }

    /**
     * Generate an array of nb tasks
     * @param int $number
     * @param string $type
     * @return array|NotificationModel[]
     */
    private function generateNbNotifications($number, $type = Constants::TYPE_INFO)
    {
        $tasks = [];
        for ($i = 0; $i < $number; $i++) {
            $tasks[] = new NotificationModel(
                'Message ' . $i,
                $type
            );
        }

        return $tasks;
    }
}
