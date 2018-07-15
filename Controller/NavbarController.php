<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Controller;

use KevinPapst\AdminLTEBundle\Event\MessageListEvent;
use KevinPapst\AdminLTEBundle\Event\NotificationListEvent;
use KevinPapst\AdminLTEBundle\Event\ShowUserEvent;
use KevinPapst\AdminLTEBundle\Event\TaskListEvent;
use KevinPapst\AdminLTEBundle\Event\ThemeEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;

class NavbarController extends EmitterController
{
    public const MAX_NOTIFICATIONS = 5;
    public const MAX_MESSAGES = 5;
    public const MAX_TASKS = 5;

    /**
     * @return EventDispatcherInterface
     */
    protected function getDispatcher()
    {
        return $this->get('event_dispatcher');
    }

    public function notificationsAction($max = self::MAX_NOTIFICATIONS)
    {
        if (!$this->getDispatcher()->hasListeners(ThemeEvents::THEME_NOTIFICATIONS)) {
            return new Response();
        }

        /** @var NotificationListEvent $listEvent */
        $listEvent = $this->getDispatcher()->dispatch(ThemeEvents::THEME_NOTIFICATIONS, new NotificationListEvent());

        return $this->render(
            '@AdminLTE/Navbar/notifications.html.twig',
                [
                    'notifications' => $listEvent->getNotifications(),
                    'total' => $listEvent->getTotal(),
                ]
        );
    }

    /**
     * @param int $max
     *
     * @return Response
     */
    public function messagesAction($max = self::MAX_MESSAGES)
    {
        if (!$this->getDispatcher()->hasListeners(ThemeEvents::THEME_MESSAGES)) {
            return new Response();
        }

        /** @var MessageListEvent $listEvent */
        $listEvent = $this->getDispatcher()->dispatch(ThemeEvents::THEME_MESSAGES, new MessageListEvent());

        return $this->render(
            '@AdminLTE/Navbar/messages.html.twig',
                [
                    'messages' => $listEvent->getMessages(),
                    'total' => $listEvent->getTotal(),
                ]
        );
    }

    /**
     * @param int $max
     *
     * @return Response
     */
    public function tasksAction($max = self::MAX_TASKS)
    {
        if (!$this->getDispatcher()->hasListeners(ThemeEvents::THEME_TASKS)) {
            return new Response();
        }

        /** @var TaskListEvent $listEvent */
        $listEvent = $this->triggerMethod(ThemeEvents::THEME_TASKS, new TaskListEvent($max));

        return $this->render(
            '@AdminLTE/Navbar/tasks.html.twig',
                [
                    'tasks' => $listEvent->getTasks(),
                    'total' => $listEvent->getTotal(),
                ]
        );
    }

    /**
     * @return Response
     */
    public function userAction()
    {
        if (!$this->getDispatcher()->hasListeners(ThemeEvents::THEME_NAVBAR_USER)) {
            return new Response();
        }

        /** @var ShowUserEvent $userEvent */
        $userEvent = $this->triggerMethod(ThemeEvents::THEME_NAVBAR_USER, new ShowUserEvent());

        if ($userEvent instanceof ShowUserEvent && null !== $userEvent->getUser()) {
            return $this->render(
                '@AdminLTE/Navbar/user.html.twig',
                [
                    'user' => $userEvent->getUser(),
                    'links' => $userEvent->getLinks(),
                    'showProfileLink' => $userEvent->isShowProfileLink(),
                    'showLogoutLink' => $userEvent->isShowLogoutLink(),
                ]
            );
        }

        return new Response();
    }
}
