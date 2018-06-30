<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AdminLTEBundle\Event;

use AdminLTEBundle\Model\TaskInterface;

class TaskListEvent extends ThemeEvent
{
    protected $tasks = [];

    protected $max;

    protected $total = 0;

    /**
     * TaskListEvent constructor.
     *
     * @param int $max Maximun number of notifications displayed in panel
     */
    public function __construct($max = null)
    {
        $this->max = $max;
    }

    /**
     * Get the maximun number of notifications displayed in panel
     *
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @return array
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * @param TaskInterface $taskInterface
     *
     * @return $this
     */
    public function addTask(TaskInterface $taskInterface)
    {
        $this->tasks[] = $taskInterface;

        return $this;
    }

    /**
     * @param int $total
     *
     * @return $this
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total == 0 ? count($this->tasks) : $this->total;
    }
}
