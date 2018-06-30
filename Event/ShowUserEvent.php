<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AdminLTEBundle\Event;

use AdminLTEBundle\Model\NavBarUserLink;
use AdminLTEBundle\Model\UserInterface;

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
     * @param \AdminLTEBundle\Model\UserInterface $user
     *
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return \AdminLTEBundle\Model\UserInterface
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
     */
    public function addLink(NavBarUserLink $link)
    {
        $this->links[] = $link;
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
     */
    public function setShowProfileLink($showProfileLink)
    {
        $this->showProfileLink = $showProfileLink;
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
     */
    public function setShowLogoutLink($showLogoutLink)
    {
        $this->showLogoutLink = $showLogoutLink;
    }
}
