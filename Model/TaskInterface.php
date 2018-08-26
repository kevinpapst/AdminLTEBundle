<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Model;

interface TaskInterface
{
    /**
     * @return string
     */
    public function getColor();

    /**
     * @return int
     */
    public function getProgress();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return string
     */
    public function getIdentifier();
}
