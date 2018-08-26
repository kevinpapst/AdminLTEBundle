<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Model;

interface UserInterface
{
    /**
     * @return string
     */
    public function getAvatar();

    /**
     * @return string
     */
    public function getUsername();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return \DateTime
     */
    public function getMemberSince();

    /**
     * @return bool
     */
    public function isOnline();

    /**
     * @return string
     */
    public function getIdentifier();

    /**
     * @return string
     */
    public function getTitle();
}
