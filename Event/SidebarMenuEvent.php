<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Event;

use KevinPapst\AdminLTEBundle\Model\MenuItemInterface;
use Knp\Menu\MenuItem;
use Symfony\Component\HttpFoundation\Request;

/**
 * The SidebarMenuEvent should be used with the ThemeEvents::THEME_SIDEBAR_SETUP_MENU
 * in order to collect all MenuItemInterface objects that should be rendered in the menu section.
 */
class SidebarMenuEvent extends ThemeEvent
{
    /**
     * @var array
     */
    protected $menuRootItems = [];

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request = null)
    {
        $this->request = $request;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return MenuItemInterface[]|MenuItem[]
     */
    public function getItems()
    {
        return $this->menuRootItems;
    }

    /**
     * @param MenuItemInterface|MenuItem $item
     */
    public function addItem($item)
    {
        $this->menuRootItems[$item->getIdentifier()] = $item;
    }

    /**
     * @param string $id
     * @return MenuItemInterface|MenuItem|null
     */
    public function getRootItem($id)
    {
        return isset($this->menuRootItems[$id]) ? $this->menuRootItems[$id] : null;
    }

    /**
     * @return MenuItemInterface|MenuItem|null
     */
    public function getActive()
    {
        foreach ($this->getItems() as $item) {
            if ($item->isActive()) {
                return $item;
            }
        }

        return null;
    }
}
