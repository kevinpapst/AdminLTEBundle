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
 * Class SidebarMenuEvent
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

    public function __construct($request = null)
    {
        $this->request = $request;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return array
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
     * @param $id
     */
    public function getRootItem($id)
    {
        return isset($this->menuRootItems[$id]) ? $this->menuRootItems[$id] : null;
    }

    /**
     * @return MenuItemInterface|null
     */
    public function getActive()
    {
        foreach ($this->getItems() as $item) { /** @var $item MenuItemInterface */
            if ($item->isActive()) {
                return $item;
            }
        }

        return null;
    }
}
