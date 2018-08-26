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

use KevinPapst\AdminLTEBundle\Model\NotificationInterface as ThemeNotification;

class NotificationModel implements ThemeNotification
{
    // implement interface methods
}
```

## Event Listener
Next, you will need to create an EventListener to work with the `NotificationListEvent`.
```php
<?php
namespace App\EventListener;

use KevinPapst\AdminLTEBundle\Event\NotificationListEvent;
use App\Model\NotificationModel;

class NotificationListListener
{
    public function onListNotifications(NotificationListEvent $event) {
        foreach($this->getNotifications() as $Notification) {
            $event->addNotification($Notification);
        }
    }
    
    protected function getNotifications() {
        // return your Notification models/entities here
    }
}
```
## Service definition

Finally, you need to attach your new listener to the event system:
```yaml
services:
    app.notification_list_listener:
        class: App\EventListener\NotificationListListener
        tags:
            - { name: kernel.event_listener, event: theme.notifications, method: onListNotifications }
```

TODO kevin - add SF4 auto-wiring and service discovery docu

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.
