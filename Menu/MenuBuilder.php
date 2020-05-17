<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Menu;

use KevinPapst\AdminLTEBundle\Event\KnpMenuEvent;
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
     * @param FactoryInterface $factory
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(FactoryInterface $factory, EventDispatcherInterface $eventDispatcher)
    {
        $this->factory = $factory;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root', [
            'childrenAttributes' => [
                'class' => 'nav nav-sidebar flex-column',
                'data-widget' => 'treeview',
                'data-accordion' => false,
                'role' => 'menu'
            ],
        ]);

        $childOptions = [
            'attributes' => ['class' => 'show treeview'],
            'childrenAttributes' => ['class' => 'list-unstyled show menu-open branch'],
            'labelAttributes' => ['safe_html'=>true, 'data-toggle' => 'collapse'],
        ];

        $this->eventDispatcher->dispatch(new KnpMenuEvent($menu, $this->factory, $options, $childOptions));

        return $menu;
    }
}
