<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Model;

interface UserDetailsInterface
{
    /**
     * @return NavBarUserLink[]
     */
    public function getLinks(): array;

    public function getUser(): ?UserInterface;

    public function isShowProfileLink(): bool;

    public function isShowLogoutLink(): bool;
}
