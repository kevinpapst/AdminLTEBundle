<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Model;

use KevinPapst\AdminLTEBundle\Helper\Constants;

class TaskModel implements TaskInterface
{
    /**
     * @var int
     */
    protected $progress;

    /**
     * @var string
     */
    protected $color = Constants::COLOR_AQUA;

    /**
     * @var string
     */
    protected $title;

    /**
     * @param string $title
     * @param int $progress
     * @param string $color
     */
    public function __construct($title = null, $progress = 0, $color = Constants::COLOR_AQUA)
    {
        $this->color = $color;
        $this->progress = $progress;
        $this->title = $title;
    }

    /**
     * @param string $color
     *
     * @return TaskModel
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param int $progress
     *
     * @return TaskModel
     */
    public function setProgress($progress)
    {
        $this->progress = $progress;

        return $this;
    }

    /**
     * @return int
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * @param string $title
     *
     * @return TaskModel
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->title;
    }
}
