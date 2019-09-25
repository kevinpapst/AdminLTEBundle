<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Event;

/**
 * This class SHOULD extend the MenuEvent, but for BC reasons we extend SidebarMenuEvent.
 * This can be changed for 4.0.
 */
class BreadcrumbMenuEvent extends SidebarMenuEvent
{
}
