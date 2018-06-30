<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AdminLTEBundle\Model;

interface UserInterface
{
    public function getAvatar();

    public function getUsername();

    public function getName();

    public function getMemberSince();

    public function isOnline();

    public function getIdentifier();

    public function getTitle();
}
