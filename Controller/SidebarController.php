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

class SidebarController extends EmitterController
{
    /**
     * @return Response
     */
    public function userPanelAction(): Response
    {
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

    /**
     * @return Response
     */
    public function searchFormAction(): Response
    {
        return $this->render('@AdminLTE/Sidebar/search-form.html.twig', []);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function menuAction(Request $request): Response
    {
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
