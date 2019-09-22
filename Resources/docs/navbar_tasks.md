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

use KevinPapst\AdminLTEBundle\Model\TaskInterface;

class TaskModel implements TaskInterface
{
    // implement interface methods
}
```

The bundle provides the `TaskModel` as a ready to use implementation of the `TaskInterface`. 

## EventSubscriber - auto-discovery with Symfony 4

In case you activated service discovery and auto-wiring in your app, you can write an EventSubscriber which will 
be automatically registered in your container:

```php
<?php
// src/EventSubscriber/TaskSubscriber.php
namespace App\EventSubscriber;

use KevinPapst\AdminLTEBundle\Event\TaskListEvent;
use KevinPapst\AdminLTEBundle\Helper\Constants;
use KevinPapst\AdminLTEBundle\Model\TaskModel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TaskSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            TaskListEvent::class => ['onTasks', 100],
        ];
    }

    public function onTasks(TaskListEvent $event)
    {
        $task = new TaskModel();
        $task
            ->setId(1)
            ->setTitle('My task')
            ->setColor(Constants::COLOR_AQUA)
            ->setProgress(80)
        ;
        $event->addTask($task);
        
        /*
         * You can also set the total number of tasks which could be different from those displayed in the navbar
         * If no total is set, the total will be calculated on the number of tasks added to the event
         */ 
        $event->setTotal(15);
    }
}
```

## EventListener and Service definition    

If your application is using the classical approach of manually registering Services and EventListener use this method.

Write an EventListener to work with the `TaskListEvent`:

```php
<?php
// src/EventListener/TaskListListener.php
namespace App\EventListener;

use KevinPapst\AdminLTEBundle\Event\TaskListEvent;
use KevinPapst\AdminLTEBundle\Model\TaskModel;

class TaskListListener
{
    public function onListTasks(TaskListEvent $event)
    {
        foreach($this->getTasks() as $task) {
            $event->addTask($task);
        }
    }
    
    protected function getTasks()
    {
        // see above in TaskSubscriber for a full example
        return [new TaskModel()];
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

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.
