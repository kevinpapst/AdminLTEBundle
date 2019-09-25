<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Tests\Controller;

use KevinPapst\AdminLTEBundle\Controller\NavbarController;
use KevinPapst\AdminLTEBundle\Event\MessageListEvent;
use KevinPapst\AdminLTEBundle\Event\NotificationListEvent;
use KevinPapst\AdminLTEBundle\Event\TaskListEvent;
use KevinPapst\AdminLTEBundle\Helper\ContextHelper;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Contracts\EventDispatcher\Event;
use Twig\Environment;

class NavbarControllerTest extends TestCase
{
    protected function getContainerMock()
    {
        $container = $this->getMockBuilder(Container::class)->setMethods(['get', 'has', 'hasListeners'])->getMock();
        $container->method('has')->willReturnCallback(function ($serviceName) {
            return $serviceName === 'twig';
        });
        $twig = $this->getMockBuilder(Environment::class)->setMethods(['render'])->disableOriginalConstructor()->getMock();
        $twig->expects(self::once())->method('render')->willReturnCallback(function ($templateName, $values) {
            return json_encode($values);
        });
        $container->expects(self::once())->method('get')->willReturn($twig);

        return $container;
    }

    protected function getContextHelper($notifications, $messages, $tasks)
    {
        return new ContextHelper([
            'max_navbar_notifications' => $notifications,
            'max_navbar_messages' => $messages,
            'max_navbar_tasks' => $tasks,
        ]);
    }

    public function getTestData()
    {
        yield [$this->getContextHelper(7, 23, 2), 7, NotificationListEvent::class, 'notificationsAction', null, 'notifications'];
        yield [$this->getContextHelper(7, 23, 2), 23, MessageListEvent::class, 'messagesAction', null, 'messages'];
        yield [$this->getContextHelper(7, 23, 2), 2, TaskListEvent::class, 'tasksAction', null, 'tasks'];
        yield [$this->getContextHelper(1, 20, 30), 7, NotificationListEvent::class, 'notificationsAction', 7, 'notifications'];
        yield [$this->getContextHelper(1, 20, 30), 23, MessageListEvent::class, 'messagesAction', 23, 'messages'];
        yield [$this->getContextHelper(1, 20, 30), 2, TaskListEvent::class, 'tasksAction', 2, 'tasks'];
    }

    /**
     * @dataProvider getTestData
     */
    public function testMessagesAction(Contexthelper $helper, $expectedMax, $expectedEventClass, $action, $actionParam, $responseKey)
    {
        $dispatcher = $this->getMockBuilder(EventDispatcher::class)->setMethods(['dispatch', 'hasListeners'])->getMock();
        $dispatcher->expects(self::once())->method('hasListeners')->willReturnCallback(
            function ($eventName) use ($expectedEventClass) {
                self::assertEquals($expectedEventClass, $eventName);

                return true;
            }
        );

        $dispatcher->expects(self::once())->method('dispatch')->willReturnCallback(
            /** @var Event $event */
            function ($event) use ($expectedMax, $expectedEventClass) {
                self::assertInstanceOf($expectedEventClass, $event);
                self::assertEquals($expectedMax, $event->getMax());

                return $event;
            }
        );

        $sut = new NavbarController($dispatcher, $helper);
        $sut->setContainer($this->getContainerMock());
        $response = $sut->{$action}($actionParam);
        $result = json_decode($response->getContent(), true);
        $this->assertEquals([$responseKey => [], 'total' => 0], $result);
    }
}
