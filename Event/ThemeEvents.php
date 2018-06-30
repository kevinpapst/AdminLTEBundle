<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AdminLTEBundle\Event;

/**
 * Holds all events used by the theme
 */
class ThemeEvents
{
    /**
     * Used to receive notification data
     */
    public const THEME_NOTIFICATIONS = 'theme.notifications';
    /**
     * Used to receive message data
     */
    public const THEME_MESSAGES = 'theme.messages';
    /**
     * Used to receive task data
     */
    public const THEME_TASKS = 'theme.tasks';

    public const THEME_NAVBAR_USER = 'theme.navbar_user';
    /**
     * used to receive breadcrumb data
     */
    public const THEME_BREADCRUMB = 'theme.breadcrumb';
    /**
     * used to receive the current user for the sidebar
     *
     * macro: avanzu_sidebar_user
     * template: @AvanzuAdminTheme/Sidebar/user-panel.html.twig
     */
    public const THEME_SIDEBAR_USER = 'theme.sidebar_user';

    /**
     * Used to receive the sidebar menu data
     */
    public const THEME_SIDEBAR_SETUP_MENU = 'theme.sidebar_setup_menu';
    /**
     * used for the knp menu mechanics
     */
    public const THEME_SIDEBAR_SETUP_KNP_MENU = 'theme.sidebar_setup_knp_menu';
}
