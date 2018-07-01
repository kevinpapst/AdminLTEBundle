# Accessing components

The contents of the navbar and sidebar are separated into components, following an event driven approach.

The general process to use a particular component is to create an event listener and to use the given event object to add ui elements.

Each component has its own event and specific ui data interfaces.

## Route aliases

Since most of the components do generate one or two specific links (e.g. task list and task details) the specific routes must be rigged with the option `admin_lte.routes` which defines the alias name like so: 

```yaml
# admin_lte.yaml
admin_lte:
    routes:
        welcome: dashboard
```

The theme route name `welcome` maps to your route `dashboard` here. Without defining these routes, the theme will not be able to render.

### Available aliases

- `adminlte_welcome`: Used for the "homepage" within the theme (defaults to: home)
- `adminlte_login`: The login route (defaults to: login)
- `adminlte_message`: Used to generate a link to a specific message, receives parameter `id` (defaults to: message)
- `adminlte_messages`: Used to generate the message list link (defaults to: messages)
- `adminlte_notification`: Used to generate a link to a specific notification, receives parameter `id` (defaults to: notification)
- `adminlte_notifications`: Used to generate the notification list link (defaults to: notifications)
- `adminlte_task`: Used to generate a link to a specific task, receives parameter `id` (defaults to: task)
- `adminlte_tasks`: Used to generate the task list link (defaults to: tasks)
- `adminlte_profile`: Used for the current user's profile (defaults to: profile)

## Available components

* [Navbar User](navbar_user.md)
* [Navbar Tasks](navbar_tasks.md)
* [Navbar Notifications](navbar_notifications.md)
* [Navbar Messages](navbar_messages.md)
* [Sidebar User](sidebar_user.md)
* [Sidebar Search](sidebar_search.md)
* [Sidebar Navigation](sidebar_navigation.md)
* [Breadcrumb Menu](breadcrumbs.md)

### Demonstration

In order to see some working examples, the bundle is showcased in a separate demo-application: [AdminLTEBundle-Demo](https://github.com/kevinpapst/AdminLTEBundle-Demo) 
