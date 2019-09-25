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
 * Collect the UserInterface object that should be rendered in the user section.
 */
abstract class ShowUserEvent extends ThemeEvent
{
    /**
     * @var UserInterface
     */
    private $user;
    /**
     * @var bool
     */
    private $showProfileLink = true;
    /**
     * @var bool
     */
    private $showLogoutLink = true;
    /**
     * @var NavBarUserLink[]
     */
    private $links = [];

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
     * @return UserInterface|null
     */
    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    /**
     * @return NavBarUserLink[]
     */
    public function getLinks(): array
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
    public function isShowProfileLink(): bool
    {
        return $this->showProfileLink;
    }

    /**
     * @param bool $showProfileLink
     * @return ShowUserEvent
     */
    public function setShowProfileLink(bool $showProfileLink)
    {
        $this->showProfileLink = $showProfileLink;

        return $this;
    }

    /**
     * @return bool
     */
    public function isShowLogoutLink(): bool
    {
        return $this->showLogoutLink;
    }

    /**
     * @param bool $showLogoutLink
     * @return ShowUserEvent
     */
    public function setShowLogoutLink(bool $showLogoutLink)
    {
        $this->showLogoutLink = $showLogoutLink;

        return $this;
    }
}
