# Accessing components

The contents of the navbar and sidebar are separated into components, following an event driven approach.

The general process to use a particular component is: create an EventListener or EventSubscriber and use the given event object to add UI elements.

Each component has its own event and specific UI data interface.

## Available events

Please see the [event directory](https://github.com/kevinpapst/AdminLTEBundle/blob/master/Event/) for all available events.

| Name | Description |
|:-|-|

| Event-Class | Description | Link |
|---|---|---|
| `NotificationListEvent::class`    | Used to receive notification data                 | [read more](navbar_notifications.md) |
| `MessageListEvent::class`         | Used to receive message data                      | [read more](navbar_messages.md) |
| `TaskListEvent::class`            | Used to receive task data                         | [read more](navbar_tasks.md) |
| `NavbarUserEvent::class`          | Used to receive the current user for the navbar   | [read more](navbar_user.md) |
| `BreadcrumbMenuEvent::class`      | Used to receive breadcrumb data                   | [read more](breadcrumbs.md) |
| `SidebarUserEvent::class`         | Used to receive the current user for the sidebar  | [read more](sidebar_user.md) |
| `SidebarMenuEvent::class`         | Used to receive the sidebar menu data             | [read more](sidebar_navigation.md) |
| `KnpMenuEvent::class`             | Used for the knp menu mechanics                   | [read more](knp_menu.md) |

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.
