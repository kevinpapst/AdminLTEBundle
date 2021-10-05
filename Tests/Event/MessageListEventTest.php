<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Tests\Event;

use KevinPapst\AdminLTEBundle\Event\MessageListEvent;
use KevinPapst\AdminLTEBundle\Model\MessageModel;
use KevinPapst\AdminLTEBundle\Model\UserModel;
use PHPUnit\Framework\TestCase;

class MessageListEventTest extends TestCase
{
    /**
     * @test
     */
    public function total_should_be_zero_and_max_null_when_there_are_no_messages()
    {
        $event = new MessageListEvent();
        $this->assertEquals(0, $event->getTotal());
        $this->assertEquals(null, $event->getMax());
    }

    /**
     * @test
     */
    public function total_should_be_equal_the_number_of_messages_if_max_is_greater_then_the_number_of_messages()
    {
        $event = new MessageListEvent(10);
        $messages = $this->generateNbMessages(7);

        foreach ($messages as $message) {
            $event->addMessage($message);
        }

        $this->assertEquals(7, $event->getTotal());
        $this->assertEquals(10, $event->getMax());
        $this->assertEquals(7, \count($event->getMessages()));
    }

    /**
     * @test
     */
    public function total_should_be_equal_the_number_of_messages_and_count_message_should_equal_max_when_max_is_lower_then_the_number_of_messages()
    {
        $event = new MessageListEvent(5);
        $messages = $this->generateNbMessages(7);

        foreach ($messages as $message) {
            $event->addMessage($message);
        }

        $this->assertEquals(7, $event->getTotal());
        $this->assertEquals(5, $event->getMax());
        $this->assertEquals(5, \count($event->getMessages()));
    }

    /**
     * @test
     */
    public function total_is_equal_the_number_of_messages_when_max_is_null()
    {
        $event = new MessageListEvent();
        $messages = $this->generateNbMessages(7);

        foreach ($messages as $message) {
            $event->addMessage($message);
        }

        $this->assertEquals(7, $event->getTotal());
        $this->assertEquals(null, $event->getMax());
        $this->assertEquals(7, \count($event->getMessages()));
    }

    /**
     * @test
     */
    public function you_can_set_total_to_be_different_from_the_number_of_messages()
    {
        $event = new MessageListEvent();
        $messages = $this->generateNbMessages(7);

        foreach ($messages as $message) {
            $event->addMessage($message);
        }
        $event->setTotal(15);

        $this->assertEquals(15, $event->getTotal());
        $this->assertEquals(null, $event->getMax());
        $this->assertEquals(7, \count($event->getMessages()));
    }

    /**
     * @test
     */
    public function you_can_set_total_to_be_different_from_the_number_of_messages_and_set_max_to_another_value()
    {
        $event = new MessageListEvent(3);
        $messages = $this->generateNbMessages(7);

        foreach ($messages as $message) {
            $event->addMessage($message);
        }
        $event->setTotal(15);

        $this->assertEquals(15, $event->getTotal());
        $this->assertEquals(3, $event->getMax());
        $this->assertEquals(3, \count($event->getMessages()));
    }

    /**
     * Generate an array of nb messages
     * @param int $number
     * @return array|MessageModel[]
     */
    private function generateNbMessages($number)
    {
        $messages = [];
        for ($i = 0; $i < $number; $i++) {
            $messages[] = new MessageModel(
                $this->generateUser('User' . $i),
                'Subject ' . $i
            );
        }

        return $messages;
    }

    /**
     * Generate a ModelUser with the given username
     * @param string $username
     * @return UserModel
     */
    private function generateUser($username)
    {
        $user = new UserModel();
        $user->setUsername($username);

        return $user;
    }
}
