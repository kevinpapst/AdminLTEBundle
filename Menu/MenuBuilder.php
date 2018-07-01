<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Menu;

use KevinPapst\AdminLTEBundle\Event\KnpMenuEvent;
use KevinPapst\AdminLTEBundle\Event\ThemeEvents;
use Knp\Menu\FactoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class MenuBuilder
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * MenuBuilder constructor.
     *
     * @param FactoryInterface $factory
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        FactoryInterface $factory,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->factory = $factory;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root', [
            'childrenAttributes' => ['class' => 'sidebar-menu'],
        ]);

        $childOptions = [
            'attributes' => ['class' => 'treeview'],
            'childrenAttributes' => ['class' => 'treeview-menu'],
            'labelAttributes' => [],
        ];

        $this->eventDispatcher->dispatch(
            ThemeEvents::THEME_SIDEBAR_SETUP_KNP_MENU,
           new KnpMenuEvent($menu, $this->factory, $options, $childOptions)
        );

        return $menu;
    }
}
