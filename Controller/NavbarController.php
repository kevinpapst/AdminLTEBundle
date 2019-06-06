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
use KevinPapst\AdminLTEBundle\Helper\ContextHelper;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;

class NavbarController extends EmitterController
{
    protected $max_notifications;
    protected $max_messages;
    protected $max_tasks;

    public function __construct(EventDispatcherInterface $dispatcher, ContextHelper $helper)
    {
        parent::__construct($dispatcher);
        $this->max_notifications = $helper->getOption('max_navbar_notifications');
        $this->max_messages = $helper->getOption('max_navbar_messages');
        $this->max_tasks = $helper->getOption('max_navbar_tasks');
    }

    /**
     * @param int|null $max
     * @return Response
     */
    public function notificationsAction($max = null)
    {
        if (!$this->getDispatcher()->hasListeners(ThemeEvents::THEME_NOTIFICATIONS)) {
            return new Response();
        }

        if (null === $max) {
            $max = (int) $this->max_notifications;
        }

        /** @var NotificationListEvent $listEvent */
        $listEvent = $this->getDispatcher()->dispatch(ThemeEvents::THEME_NOTIFICATIONS, new NotificationListEvent($max));

        return $this->render(
            '@AdminLTE/Navbar/notifications.html.twig',
                [
                    'notifications' => $listEvent->getNotifications(),
                    'total' => $listEvent->getTotal(),
                ]
        );
    }

    /**
     * @param int|null $max
     *
     * @return Response
     */
    public function messagesAction($max = null)
    {
        if (!$this->getDispatcher()->hasListeners(ThemeEvents::THEME_MESSAGES)) {
            return new Response();
        }

        if (null === $max) {
            $max = (int) $this->max_messages;
        }

        /** @var MessageListEvent $listEvent */
        $listEvent = $this->getDispatcher()->dispatch(ThemeEvents::THEME_MESSAGES, new MessageListEvent($max));

        return $this->render(
            '@AdminLTE/Navbar/messages.html.twig',
                [
                    'messages' => $listEvent->getMessages(),
                    'total' => $listEvent->getTotal(),
                ]
        );
    }

    /**
     * @param int|null $max
     *
     * @return Response
     */
    public function tasksAction($max = null)
    {
        if (!$this->getDispatcher()->hasListeners(ThemeEvents::THEME_TASKS)) {
            return new Response();
        }

        if (null === $max) {
            $max = (int) $this->max_tasks;
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
