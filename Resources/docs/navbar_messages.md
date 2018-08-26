# The Navbar Messages component

## Routes
Just like the other theme components, this one requires some route aliases to work. 
Please refer to the [configurations overview](configurations.md) to learn about the route alias details. 

## Required aliases
* all_messages
* message

## Data Model

In order to use this component, your user class has to implement the `KevinPapst\AdminLTEBundle\Model\MessageInterface`
```php
<?php
namespace App\Model;

use KevinPapst\AdminLTEBundle\Model\MessageInterface;

class MessageModel implements MessageInterface 
{
    // implement interface methods
}
```

## Event Listener
Next, you will need to create an EventListener to work with the `MessageListEvent`.
```php
<?php
namespace App\EventListener;

use KevinPapst\AdminLTEBundle\Event\MessageListEvent;
use App\Model\MessageModel;

class MessageListListener
{
    public function onListMessages(MessageListEvent $event) {
        foreach($this->getMessages() as $message) {
            $event->addMessage($message);
        }
    }
    
    protected function getMessages() {
        // return your message models/entities here
    }
}
```
## Service definition

Finally, you need to attach your new listener to the event system:
```yaml
services:
    app.message_list_listener:
        class: App\EventListener\MessageListListener
        tags:
            - { name: kernel.event_listener, event: theme.messages, method: onListMessages }
```

TODO kevin - add SF4 auto-wiring and service discovery docu

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.
