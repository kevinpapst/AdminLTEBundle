# The Navbar Tasks component

## Routes
Just like the other theme components, this one requires some route aliases to work. 
Please refer to the [configurations overview](configurations.md) to learn about the route alias details. 
 
### Required aliases
* all_task
* task

## Data Model

In order to use this component, your user class has to implement the `KevinPapst\AdminLTEBundle\Model\TaskInterface`
```php
<?php
namespace App\Model;

use KevinPapst\AdminLTEBundle\Model\TaskInterface as ThemeTask;

class TaskModel implements ThemeTask
{
	// implement interface methods
}
```

## Event Listener
Next, you will need to create an EventListener to work with the `TaskListEvent`.
```php
<?php
namespace App\EventListener;

use KevinPapst\AdminLTEBundle\Event\TaskListEvent;
use App\Model\TaskModel;

class TaskListListener
{
    public function onListTasks(TaskListEvent $event) {
        foreach($this->getTasks() as $task) {
            $event->addTask($task);
        }
    }
    
    protected function getTasks() {
        // return your task models/entities here
    }
}
```

## Service definition

Finally, you need to attach your new listener to the event system:
```yaml
services:
    app.task_list_listener:
        class: App\EventListener\TaskListListener
        tags:
            - { name: kernel.event_listener, event: theme.tasks, method: onListTasks }
```

TODO kevin - add SF4 auto-wiring and service discovery docu

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.
