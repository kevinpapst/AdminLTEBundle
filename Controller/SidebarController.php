<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Controller;

use KevinPapst\AdminLTEBundle\Event\ShowUserEvent;
use KevinPapst\AdminLTEBundle\Event\SidebarMenuEvent;
use KevinPapst\AdminLTEBundle\Event\SidebarUserEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class SidebarController extends EmitterController
{
    public function userPanelAction(): Response
    {
        @trigger_error('SidebarController::userPanelAction() is deprecated and will be removed with 4.0', E_USER_DEPRECATED);

        if (!$this->hasListener(SidebarUserEvent::class)) {
            return new Response();
        }

        /** @var ShowUserEvent $userEvent */
        $userEvent = $this->dispatch(new SidebarUserEvent());

        return $this->render(
            '@AdminLTE/Sidebar/user-panel.html.twig',
            [
                'user' => $userEvent->getUser(),
            ]
        );
    }

    public function searchFormAction(): Response
    {
        @trigger_error('SidebarController::searchFormAction() is deprecated and will be removed with 4.0', E_USER_DEPRECATED);

        return $this->render('@AdminLTE/Sidebar/search-form.html.twig', []);
    }

    public function menuAction(Request $request): Response
    {
        @trigger_error('SidebarController::menuAction() is deprecated and will be removed with 4.0', E_USER_DEPRECATED);

        if (!$this->hasListener(SidebarMenuEvent::class)) {
            return new Response();
        }

        /** @var SidebarMenuEvent $event */
        $event = $this->dispatch(new SidebarMenuEvent($request));

        return $this->render(
            '@AdminLTE/Sidebar/menu.html.twig',
            [
                    'menu' => $event->getItems(),
            ]
        );
    }
}
