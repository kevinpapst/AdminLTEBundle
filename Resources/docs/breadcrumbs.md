## The Breadcrumb Component

The breadcrumb maps a list of route to a list of link. 
The component works in conjucntion with the [Sidebar Navigation](sidebar_navigation.md) component.

### Event Listener

You don't need to build an event listener as long as you've already made it with the [Sidebar Navigation](sidebar_navigation.md) component. 
You will reuse this listener to build the Breadcrumb list of links.

### Service defintion

Finally, you need to attach your new listener to the event system:

```yaml
# config/services.yaml
    services:
        app.breadcrumb_listener:
            class: MyAdminBundle\EventListener\MyMenuItemListListener
            tags:
                - { name: kernel.event_listener, event:theme.breadcrumb, method:onSetupMenu }
```

TODO kevin - add SF4 auto-wiring and service discovery docu

As you can see we are using the menu listener from the [Sidebar Navigation](sidebar_navigation.md) 
but attaching to the `theme.breadcrumb` event.

## Next steps

Please go back to the [AdminLTE bundle documentation](index.md) to find out more about using the theme.
