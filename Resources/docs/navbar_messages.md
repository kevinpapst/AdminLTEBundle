# The Navbar Messages component

## Routes
Just like the other theme components, this one requires some route aliases to work. Please refer to the [component overview](component_events.md) to learn about the route alias details. 

## Required aliases
* all_messages
* message

## Data Model

In order to use this component, your user class has to implement the `KevinPapst\AdminLTEBundle\Model\MessageInterface`
```php
<?php
namespace MyAdminBundle\Model;

use KevinPapst\AdminLTEBundle\Model\MessageInterface;

class MessageModel implements MessageInterface {
	// ...
	// implement interface methods
	// ...
}
```

## Event Listener
Next, you will need to create an EventListener to work with the `MessageListEvent`.
```php
<?php
namespace MyAdminBundle\EventListener;

use KevinPapst\AdminLTEBundle\Event\MessageListEvent;
use App\Model\MessageModel;

class MyMessageListListener {

	// ...

	public function onListMessages(MessageListEvent $event) {

		foreach($this->getMessages() as $message) {
			$event->addMessage($message);
		}

	}

	protected function getMessages() {
		// retrieve your message models/entities here
	}
}
```
## Service defintion

Finally, you need to attach your new listener to the event system:
```xml
<parameters>
	<!-- ... -->
	<parameter key="my_admin_bundle.message_list_listener.class">MyAdminBundle\EventListener\MyMessageListListener</parameter>
	<!-- ... -->
</parameters>
<services>
	<!-- ... -->
	<service id="my_admin_bundle.message_list_listener" class="%my_admin_bundle.message_list_listener.class%">
        <tag name="kernel.event_listener" event="theme.messages" method="onListMessages" />
    </service>
	
	<!-- ... -->
</services>
```

TODO kevin - change docu to YAML and Symfony 4
TODO kevin - add SF4 auto-wiring and service discovery docu

## Next steps

Please go back to the [AdminLTE bundle documentation](index.md) to find out more about using the theme.
