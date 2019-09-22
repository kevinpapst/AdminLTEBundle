# The Navbar Notifications component

## Routes

Just like the other theme components, this one requires some route aliases to work. 
Please refer to the [configurations overview](configurations.md) to learn about the route alias details. 

## Required aliases

* all_notifications
* notification

## Data Model

In order to use this component, your user class has to implement the `KevinPapst\AdminLTEBundle\Model\NotificationInterface`
```php
<?php
namespace App\Model;

use KevinPapst\AdminLTEBundle\Model\NotificationInterface;

class NotificationModel implements NotificationInterface
{
    // implement interface methods
}
```

The bundle provides the `NotificationModel` as a ready to use implementation of the `NotificationInterface`. 

## EventSubscriber - auto-discovery with Symfony 4

In case you activated service discovery and auto-wiring in your app, you can write an EventSubscriber which will 
be automatically registered in your container:

```php
<?php
// src/EventSubscriber/NotificationSubscriber.php
namespace App\EventSubscriber;

use KevinPapst\AdminLTEBundle\Event\NotificationListEvent;
use KevinPapst\AdminLTEBundle\Helper\Constants;
use KevinPapst\AdminLTEBundle\Model\NotificationModel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class NotificationSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            NotificationListEvent::class => ['onNotifications', 100],
        ];
    }

    public function onNotifications(NotificationListEvent $event)
    {
        $notification = new NotificationModel();
        $notification
            ->setId(1)
            ->setMessage('A demo message')
            ->setType(Constants::TYPE_SUCCESS)
            ->setIcon('far fa-envelope')
        ;
        $event->addNotification($notification);
        
        /*
         * You can also set the total number of notifications which could be different from those displayed in the navbar
         * If no total is set, the total will be calculated on the number of notifications added to the event
         */ 
        $event->setTotal(15);
    }
}
```

## EventListener and Service definition    

If your application is using the classical approach of manually registering Services and EventListener use this method.

Write an EventListener to work with the `NotificationListEvent`:

```php
<?php
// src/EventListener/NotificationListListener.php
namespace App\EventListener;

use KevinPapst\AdminLTEBundle\Event\NotificationListEvent;
use KevinPapst\AdminLTEBundle\Model\NotificationModel;

class NotificationListListener
{
    public function onListNotifications(NotificationListEvent $event)
    {
        foreach($this->getNotifications() as $Notification) {
            $event->addNotification($Notification);
        }
    }
    
    protected function getNotifications()
    {
        // see above in NotificationSubscriber for a full example
        return [new NotificationModel()];
    }
}
```

And attach your new listener to the event system:

```yaml
services:
    app.notification_list_listener:
        class: App\EventListener\NotificationListListener
        tags:
            - { name: kernel.event_listener, event: theme.notifications, method: onListNotifications }
```

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.
