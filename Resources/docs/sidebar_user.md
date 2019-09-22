# The Sidebar User component

This component uses the same setup as the [Navbar User](navbar_user.md) except for the event name it listens to.

## EventSubscriber - auto-discovery with Symfony 4

Edit the previously made class `NavbarUserSubscriber` and register it for another event:

```php
<?php
// src/EventSubscriber/NavbarUserSubscriber.php
namespace App\EventSubscriber;

use KevinPapst\AdminLTEBundle\Event\NavbarUserEvent;
use KevinPapst\AdminLTEBundle\Event\SidebarUserEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class NavbarUserSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            NavbarUserEvent::class => ['onShowUser', 100],
            SidebarUserEvent::class => ['onShowUser', 100],
        ];
    }
    
    // ... the rest of the class follows here ...
}
```

## EventListener and Service definition    

If your application is using the classical approach of manually registering Services and EventListener use this method.

Just add the following listener definition to the event system in `config/services.yaml` and you're good to go:
```yaml
services:
    app.show_user_listener:
        class: App\EventListener\NavbarUserListener
        tags:
            - { name: kernel.event_listener, event: theme.sidebar_user, method: onShowUser }
```

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.
