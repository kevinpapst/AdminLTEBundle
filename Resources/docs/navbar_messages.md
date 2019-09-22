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

The bundle provides the `MessageModel` as a ready to use implementation of the `MessageInterface`. 


## EventSubscriber - auto-discovery with Symfony 4

In case you activated service discovery and auto-wiring in your app, you can write an EventSubscriber which will 
be automatically registered in your container:


```php
<?php
// src/EventSubscriber/MessageSubscriber.php
namespace App\EventSubscriber;

use KevinPapst\AdminLTEBundle\Event\MessageListEvent;
use KevinPapst\AdminLTEBundle\Model\MessageModel;
use KevinPapst\AdminLTEBundle\Model\UserModel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;
use App\Entity\User;

class MessageSubscriber implements EventSubscriberInterface
{
    protected $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            MessageListEvent::class => ['onMessages', 100],
        ];
    }

    public function onMessages(MessageListEvent $event)
    {
        if (null === $this->security->getUser()) {
            return;
        }

        /* @var $myUser User */
        $myUser = $this->security->getUser();

        $userModel = new UserModel();
        $userModel->setName($myUser->getUsername());
        $message = new MessageModel($userModel, 'Hello world');
        $event->addMessage($message);
        
        /*
         * You can also set the total number of messages which could be different from those displayed in the navbar
         * If no total is set, the total will be calculated on the number of messages added to the event
         */ 
        $event->setTotal(15);
    }
}
```

## EventListener and Service definition    

If your application is using the classical approach of manually registering Services and EventListener use this method.

Write an EventListener to work with the `MessageListEvent`:

```php
<?php
// src/EventListener/MessageListListener.php
namespace App\EventListener;

use KevinPapst\AdminLTEBundle\Event\MessageListEvent;
use KevinPapst\AdminLTEBundle\Model\MessageModel;

class MessageListListener
{
    public function onListMessages(MessageListEvent $event)
    {
        foreach($this->getMessages() as $message) {
            $event->addMessage($message);
        }
    }
    
    protected function getMessages()
    {
        // see above in MessageSubscriber for a full example
        return [];
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

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.
