<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Model;

/**
 * Representation of a displayable message in the theme's messages section
 */
interface MessageInterface
{
    /**
     * Returns the sender
     *
     * @return UserInterface
     */
    public function getFrom();

    /**
     * Returns the sentAt date
     *
     * @return \DateTime
     */
    public function getSentAt();

    /**
     * Returns the subject
     *
     * @return string
     */
    public function getSubject();

    /**
     * Returns the unique identifier of this message
     *
     * @return string
     */
    public function getIdentifier();
}
