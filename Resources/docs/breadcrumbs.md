# The Breadcrumb component

The breadcrumb maps a list of route to a list of link. 

You don't need to build a new EventListener/EventSubscriber as long as you've already made it with the [Sidebar Navigation](sidebar_navigation.md) component. 
If it fits your needs, you can re-use this class to build the Breadcrumb list of links.

## EventSubscriber

Edit the previously made class `MenuBuilderSubscriber` and register it for another event:

```php
<?php
// src/EventSubscriber/MenuBuilderSubscriber.php
namespace App\EventSubscriber;

use KevinPapst\AdminLTEBundle\Event\BreadcrumbMenuEvent;
use KevinPapst\AdminLTEBundle\Event\SidebarMenuEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MenuBuilderSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            SidebarMenuEvent::class => ['onSetupMenu', 100],
            BreadcrumbMenuEvent::class => ['onSetupNavbar', 100],
        ];
    }
    
    // ... the rest of the class follows here ...
}
```

## EventListener

If you are using an EventListener, you have to register it as new listener to the event system. 

```yaml
# config/services.yaml
services:
    app.breadcrumb_listener:
        class: App\EventListener\MenuBuilderListener
        tags:
            - { name: kernel.event_listener, event: theme.breadcrumb, method: onSetupMenu }
```

As you can see we are using the menu listener from the [Sidebar Navigation](sidebar_navigation.md) 
but attaching to the `theme.breadcrumb` event.

## Translating breadcrumb items

You don't have to care about translating your breadcrumb, each item will be automatically displayed by applying the `|trans` filter. 
We apply the same principle like we do in the [Sidebar Navigation](sidebar_navigation.md). 

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.
