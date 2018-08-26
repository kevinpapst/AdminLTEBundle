# Accessing components

The contents of the navbar and sidebar are separated into components, following an event driven approach.

The general process to use a particular component is: create an EventListener /EventSubscriber and use the given event object to add UI elements.

Each component has its own event and specific UI data interface.

## Available events

Please see the [theme events](https://github.com/kevinpapst/AdminLTEBundle/blob/master/Event/ThemeEvents.php) interface for all available events.

- `theme.notifications` : Used to receive notification data ([read more](navbar_notifications.md))
- `theme.messages` : Used to receive message data ([read more](navbar_messages.md))
- `theme.tasks` : Used to receive task data ([read more](navbar_tasks.md))
- `theme.navbar_user` : Used to receive the current user for the navbar ([read more](navbar_user.md))
- `theme.breadcrumb` : Used to receive breadcrumb data ([read more](breadcrumbs.md))
- `theme.sidebar_user` : Used to receive the current user for the sidebar ([read more](sidebar_user.md))
- `theme.sidebar_setup_menu` : Used to receive the sidebar menu data ([read more](sidebar_navigation.md))
- `theme.sidebar_setup_knp_menu` : Used for the knp menu mechanics ([read more](knp_menu.md))

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.
