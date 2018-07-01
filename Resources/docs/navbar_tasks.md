# The Navbar Tasks component

## Routes
Just like the other theme components, this one requires some route aliases to work. Please refer to the [component overview][1] to learn about the route alias details.
 
### Required aliases
* all_task
* task

## Data Model

In order to use this component, your user class has to implement the `KevinPapst\AdminLTEBundle\Model\TaskInterface`
```php
<?php
namespace MyAdminBundle\Model;
// ...
use KevinPapst\AdminLTEBundle\Model\TaskInterface as ThemeTask

class TaskModel implements  ThemeTask {
	// ...
	// implement interface methods
	// ...
}
```

## Event Listener
Next, you will need to create an EventListener to work with the `TaskListEvent`.
```php
<?php
namespace MyAdminBundle\EventListener;

// ...

use KevinPapst\AdminLTEBundle\Event\TaskListEvent;
use MyAdminBundle\Model\TaskModel;

class MyTaskListListener {

	// ...

	public function onListTasks(TaskListEvent $event) {

		foreach($this->getTasks() as $task) {
			$event->addTask($task);
		}

	}

	protected function getTasks() {
		// retrieve your task models/entities here
	}

}
```

## Service defintion

Finally, you need to attach your new listener to the event system:
```xml
<!-- Resources/config/services.xml -->
<parameters>
	<!-- ... -->
	<parameter key="my_admin_bundle.task_list_listener.class">MyAdminBundle\EventListener\MyTaskListListener</parameter>
	<!-- ... -->
</parameters>
<services>
	<!-- ... -->
	<service id="my_admin_bundle.task_list_listener" class="%my_admin_bundle.task_list_listener.class%">
        <tag name="kernel.event_listener" event="theme.tasks" method="onListTasks" />
    </service>
	
	<!-- ... -->
</services>
```

TODO kevin - change docu to YAML and Symfony 4
TODO kevin - add SF4 auto-wiring and service discovery docu

## Next steps

Please go back to the [AdminLTE bundle documentation](index.md) to find out more about using the theme.

[1]: component_events.md
