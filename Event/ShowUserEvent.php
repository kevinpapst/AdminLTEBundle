<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Event;

use KevinPapst\AdminLTEBundle\Model\NavBarUserLink;
use KevinPapst\AdminLTEBundle\Model\UserInterface;

/**
 * The ShowUserEvent should be used with the ThemeEvents::THEME_SIDEBAR_USER and ThemeEvents::THEME_NAVBAR_USER
 * in order to collect the UserInterface object that should be rendered in the user section.
 */
class ShowUserEvent extends ThemeEvent
{
    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var bool
     */
    protected $showProfileLink = true;

    /**
     * @var bool
     */
    protected $showLogoutLink = true;

    /**
     * @var NavBarUserLink[]
     */
    protected $links = [];

    /**
     * @param UserInterface $user
     * @return ShowUserEvent
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return NavBarUserLink[]
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @param NavBarUserLink $link
     * @return ShowUserEvent
     */
    public function addLink(NavBarUserLink $link)
    {
        $this->links[] = $link;

        return $this;
    }

    /**
     * @return bool
     */
    public function isShowProfileLink()
    {
        return $this->showProfileLink;
    }

    /**
     * @param bool $showProfileLink
     * @return ShowUserEvent
     */
    public function setShowProfileLink($showProfileLink)
    {
        $this->showProfileLink = $showProfileLink;

        return $this;
    }

    /**
     * @return bool
     */
    public function isShowLogoutLink()
    {
        return $this->showLogoutLink;
    }

    /**
     * @param bool $showLogoutLink
     * @return ShowUserEvent
     */
    public function setShowLogoutLink($showLogoutLink)
    {
        $this->showLogoutLink = $showLogoutLink;

        return $this;
    }
}
