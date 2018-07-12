# The Sidebar User component

This component uses the same setup as the [Navbar User](navbar_user.md) except for the event name it listens to.

## Service defintion

Just add the following tag to your UserShowListener definition in the services.xml and you're good to go:
```yaml
services:
    app.show_user_listener:
        class: App\EventListener\SidebarUserListener
        tags:
            - { name: kernel.event_listener, event:theme.sidebar_user, method:onShowUser }
```

TODO kevin - add SF4 auto-wiring and service discovery docu

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.
