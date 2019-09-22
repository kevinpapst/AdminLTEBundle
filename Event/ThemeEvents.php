<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Event;

/**
 * Holds all events used by the theme
 * @deprecated since 3.0, use new Event classes directly
 */
interface ThemeEvents
{
    /**
     * Used to receive notification data
     *
     * @deprecated since 3.0, use new Event classes directly
     */
    public const THEME_NOTIFICATIONS = NotificationListEvent::class;
    /**
     * Used to receive message data
     *
     * @deprecated since 3.0, use new Event classes directly
     */
    public const THEME_MESSAGES = MessageListEvent::class;
    /**
     * Used to receive task data
     *
     * @deprecated since 3.0, use new Event classes directly
     */
    public const THEME_TASKS = TaskListEvent::class;
    /**
     * Used to receive the current user for the navbar
     *
     * @deprecated since 3.0, use new Event classes directly
     */
    public const THEME_NAVBAR_USER = NavbarUserEvent::class;
    /**
     * Used to receive breadcrumb data
     *
     * @deprecated since 3.0, use new Event classes directly
     */
    public const THEME_BREADCRUMB = BreadcrumbMenuEvent::class;
    /**
     * Used to receive the current user for the sidebar
     *
     * @deprecated since 3.0, use new Event classes directly
     */
    public const THEME_SIDEBAR_USER = SidebarUserEvent::class;
    /**
     * Used to receive the sidebar menu data
     *
     * @deprecated since 3.0, use new Event classes directly
     */
    public const THEME_SIDEBAR_SETUP_MENU = SidebarMenuEvent::class;
    /**
     * Used for the knp menu mechanics
     *
     * @deprecated since 3.0, use new Event classes directly
     */
    public const THEME_SIDEBAR_SETUP_KNP_MENU = KnpMenuEvent::class;
}
