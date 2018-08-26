<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Model;

interface NotificationInterface
{
    /**
     * @return string
     */
    public function getMessage();

    /**
     * @return string
     */
    public function getType();

    /**
     * @return string
     */
    public function getIcon();

    /**
     * @return string
     */
    public function getIdentifier();
}
