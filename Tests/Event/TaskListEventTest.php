<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Tests\Event;

use KevinPapst\AdminLTEBundle\Event\TaskListEvent;
use KevinPapst\AdminLTEBundle\Model\TaskModel;
use PHPUnit\Framework\TestCase;

class TaskListEventTest extends TestCase
{
    /**
     * @test
     */
    public function total_should_be_zero_and_max_null_when_there_are_no_tasks()
    {
        $event = new TaskListEvent();
        $this->assertEquals(0, $event->getTotal());
        $this->assertEquals(null, $event->getMax());
    }

    /**
     * @test
     */
    public function total_should_be_equal_the_number_of_tasks_if_max_is_greater_then_the_number_of_tasks()
    {
        $event = new TaskListEvent(10);
        $tasks = $this->generateNbTasks(7);

        foreach ($tasks as $task) {
            $event->addTask($task);
        }

        $this->assertEquals(7, $event->getTotal());
        $this->assertEquals(10, $event->getMax());
        $this->assertEquals(7, \count($event->getTasks()));
    }

    /**
     * @test
     */
    public function total_should_equal_the_number_of_tasks_and_count_tasks_should_equal_max_when_max_is_lower_then_the_number_of_tasks()
    {
        $event = new TaskListEvent(5);
        $tasks = $this->generateNbTasks(7);

        foreach ($tasks as $task) {
            $event->addTask($task);
        }

        $this->assertEquals(7, $event->getTotal());
        $this->assertEquals(5, $event->getMax());
        $this->assertEquals(5, \count($event->getTasks()));
    }

    /**
     * @test
     */
    public function total_equal_the_number_of_tasks_when_max_is_null()
    {
        $event = new TaskListEvent();
        $tasks = $this->generateNbTasks(7);

        foreach ($tasks as $task) {
            $event->addTask($task);
        }

        $this->assertEquals(7, $event->getTotal());
        $this->assertEquals(null, $event->getMax());
        $this->assertEquals(7, \count($event->getTasks()));
    }

    /**
     * @test
     */
    public function you_can_set_total_to_be_different_from_the_number_of_tasks()
    {
        $event = new TaskListEvent();
        $tasks = $this->generateNbTasks(7);

        foreach ($tasks as $task) {
            $event->addTask($task);
        }
        $event->setTotal(15);

        $this->assertEquals(15, $event->getTotal());
        $this->assertEquals(null, $event->getMax());
        $this->assertEquals(7, \count($event->getTasks()));
    }

    /**
     * @test
     */
    public function you_can_set_total_to_be_different_from_the_number_of_tasks_and_set_max_to_another_value()
    {
        $event = new TaskListEvent(3);
        $tasks = $this->generateNbTasks(7);

        foreach ($tasks as $task) {
            $event->addTask($task);
        }
        $event->setTotal(15);

        $this->assertEquals(15, $event->getTotal());
        $this->assertEquals(3, $event->getMax());
        $this->assertEquals(3, \count($event->getTasks()));
    }

    /**
     * Generate an array of nb tasks
     * @param int $number
     * @return array|TaskModel[]
     */
    private function generateNbTasks($number)
    {
        $tasks = [];
        for ($i = 0; $i < $number; $i++) {
            $tasks[] = new TaskModel(
                'Title ' . $i,
                $i
            );
        }

        return $tasks;
    }
}
