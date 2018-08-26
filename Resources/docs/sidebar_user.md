# The Sidebar User component

This component uses the same setup as the [Navbar User](navbar_user.md) except for the event name it listens to.

## EventSubscriber

Edit the previously made class `NavbarUserSubscriber` and register it for another event:

```php
<?php
// src/EventSubscriber/NavbarUserSubscriber.php
class NavbarUserSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            ThemeEvents::THEME_NAVBAR_USER => ['onShowUser', 100],
            ThemeEvents::THEME_SIDEBAR_USER => ['onShowUser', 100],
        ];
    }
    
    // ... the rest of the class follows here ...
}
```

## EventListener    

Just add the following tag to your UserShowListener definition in the services.xml and you're good to go:
```yaml
services:
    app.show_user_listener:
        class: MyAdminBundle\EventListener\NavbarUserListener
        tags:
            - { name: kernel.event_listener, event: theme.sidebar_user, method: onShowUser }
```

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.
