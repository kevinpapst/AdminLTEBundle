<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Event;

use KevinPapst\AdminLTEBundle\Model\TaskInterface;

/**
 * The TaskListEvent collects all TaskInterface objects that should be rendered in the tasks section.
 */
class TaskListEvent extends ThemeEvent
{
    /**
     * @var TaskInterface[]
     */
    protected $tasks = [];

    /**
     * @var int
     */
    protected $max;

    /**
     * @var int
     */
    protected $total = 0;

    /**
     * @param int $max Maximun number of tasks displayed in panel
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
        if (null !== $this->max) {
            return array_slice($this->tasks, 0, $this->max);
        }

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
        return $this->total === 0 ? count($this->tasks) : $this->total;
    }
}
