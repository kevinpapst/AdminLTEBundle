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
    /**
     * Used to receive the current user for the navbar
     */
    public const THEME_NAVBAR_USER = 'theme.navbar_user';
    /**
     * Used to receive breadcrumb data
     */
    public const THEME_BREADCRUMB = 'theme.breadcrumb';
    /**
     * Used to receive the current user for the sidebar
     */
    public const THEME_SIDEBAR_USER = 'theme.sidebar_user';
    /**
     * Used to receive the sidebar menu data
     */
    public const THEME_SIDEBAR_SETUP_MENU = 'theme.sidebar_setup_menu';
    /**
     * Used for the knp menu mechanics
     */
    public const THEME_SIDEBAR_SETUP_KNP_MENU = 'theme.sidebar_setup_knp_menu';
}
