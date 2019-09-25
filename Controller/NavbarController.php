<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Controller;

use KevinPapst\AdminLTEBundle\Event\MessageListEvent;
use KevinPapst\AdminLTEBundle\Event\NavbarUserEvent;
use KevinPapst\AdminLTEBundle\Event\NotificationListEvent;
use KevinPapst\AdminLTEBundle\Event\ShowUserEvent;
use KevinPapst\AdminLTEBundle\Event\TaskListEvent;
use KevinPapst\AdminLTEBundle\Helper\ContextHelper;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;

class NavbarController extends EmitterController
{
    /**
     * @var int|null
     */
    private $maxNotifications;
    /**
     * @var int|null
     */
    private $maxMessages;
    /**
     * @var int|null
     */
    private $maxTasks;

    public function __construct(EventDispatcherInterface $dispatcher, ContextHelper $helper)
    {
        parent::__construct($dispatcher);
        $this->maxNotifications = $helper->getOption('max_navbar_notifications');
        $this->maxMessages = $helper->getOption('max_navbar_messages');
        $this->maxTasks = $helper->getOption('max_navbar_tasks');
    }

    /**
     * @param int|null $max
     * @return Response
     */
    public function notificationsAction($max = null): Response
    {
        if (!$this->hasListener(NotificationListEvent::class)) {
            return new Response();
        }

        if (null === $max) {
            $max = (int) $this->maxNotifications;
        }

        /** @var NotificationListEvent $listEvent */
        $listEvent = $this->dispatch(new NotificationListEvent($max));

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
     * @return Response
     */
    public function messagesAction($max = null): Response
    {
        if (!$this->hasListener(MessageListEvent::class)) {
            return new Response();
        }

        if (null === $max) {
            $max = (int) $this->maxMessages;
        }

        /** @var MessageListEvent $listEvent */
        $listEvent = $this->dispatch(new MessageListEvent($max));

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
     * @return Response
     */
    public function tasksAction($max = null): Response
    {
        if (!$this->hasListener(TaskListEvent::class)) {
            return new Response();
        }

        if (null === $max) {
            $max = (int) $this->maxTasks;
        }

        /** @var TaskListEvent $listEvent */
        $listEvent = $this->dispatch(new TaskListEvent($max));

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
    public function userAction(): Response
    {
        if (!$this->hasListener(NavbarUserEvent::class)) {
            return new Response();
        }

        /** @var ShowUserEvent $userEvent */
        $userEvent = $this->dispatch(new NavbarUserEvent());

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
