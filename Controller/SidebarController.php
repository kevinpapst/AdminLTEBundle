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
use KevinPapst\AdminLTEBundle\Event\ThemeEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SidebarController extends EmitterController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function userPanelAction()
    {
        if (!$this->getDispatcher()->hasListeners(ThemeEvents::THEME_SIDEBAR_USER)) {
            return new Response();
        }

        /** @var ShowUserEvent $userEvent */
        $userEvent = $this->getDispatcher()->dispatch(ThemeEvents::THEME_SIDEBAR_USER, new ShowUserEvent());

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
    public function searchFormAction()
    {
        return $this->render('@AdminLTE/Sidebar/search-form.html.twig', []);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function menuAction(Request $request)
    {
        if (!$this->getDispatcher()->hasListeners(ThemeEvents::THEME_SIDEBAR_SETUP_MENU)) {
            return new Response();
        }

        /** @var SidebarMenuEvent $event */
        $event = $this->getDispatcher()->dispatch(ThemeEvents::THEME_SIDEBAR_SETUP_MENU, new SidebarMenuEvent($request));

        return $this->render(
            '@AdminLTE/Sidebar/menu.html.twig',
                [
                    'menu' => $event->getItems(),
                ]
        );
    }
}
