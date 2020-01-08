# Configurations

After installing the theme, you have to adjust a couple of config settings to your application.

The configuration file is located at `config/packages/admin_lte.yaml` and contains these main sections:

```yaml
admin_lte: 
    options: 
    control_sidebar: 
    theme: 
    knp_menu: 
    routes: 
```

## Theme options (admin_lte.options)

The theme options define the basic layout of your side. 

Read more in the [theme options](bundle_options.md) documentation.

## Control Sidebar (admin_lte.control_sidebar)

The control sidebar on the right-hand screen will slide-in over the content area.
It can contain up to 5 tabs, all of them will display an icon in the tab header.     

Read more in the [control sidebar](control_sidebar.md) documentation.

## Theme configuration (admin_lte.theme)

Default values for several components can be set in `widget` section, find more information in the [Twig widgets](twig_widgets.md) documentation.

## KNP Menu (admin_lte.knp_menu)

If you use the KNP MenuBundle in your application, you can configure it to be used in the theme.

Please read the [KNP menu docu](knp_menu.md) for more information.

## Route aliases (admin_lte.routes)

Since most of the components do generate one or two specific links (e.g. task list and task details) we are using an alias concept for defining the link within the theme.

The specific routes must be rigged with the option `admin_lte.routes` defining the alias name like so: 

```yaml
admin_lte:
    routes:
        adminlte_welcome: dashboard
```

So the theme route name `adminlte_welcome` maps to your route `dashboard`. Without defining these routes, the theme will not be able to render.

### Available route aliases

- `adminlte_welcome`: Used for the "homepage" within the theme (defaults to: home)
- `adminlte_login`: The login route (defaults to: login, must match option: `security.firewalls.xyz.form_login.login_path`)
- `adminlte_login_check`: The login route (defaults to: login_check, must match option: `security.firewalls.xyz.form_login.check_path`)
- `adminlte_registration`: The route for the registration form (defaults to: null). If route is not defined, then the link is not shown.
- `adminlte_password_reset`: The route for the "forgot password" form (defaults to: null). If route is not defined, then the link is not shown.
- `adminlte_message`: Used to generate a link to a specific message, receives parameter `id` (defaults to: message)
- `adminlte_messages`: Used to generate the message list link (defaults to: messages)
- `adminlte_notification`: Used to generate a link to a specific notification, receives parameter `id` (defaults to: notification)
- `adminlte_notifications`: Used to generate the notification list link (defaults to: notifications)
- `adminlte_task`: Used to generate a link to a specific task, receives parameter `id` (defaults to: task)
- `adminlte_tasks`: Used to generate the task list link (defaults to: tasks)
- `adminlte_profile`: Used for the current user's profile (defaults to: profile)

## Default configuration

The key `control_sidebar` is not part of the default configuration, for more information read the [control sidebar](control_sidebar.md) chapter. 

```yaml
admin_lte: 
    options: 
        default_avatar: 'bundles/adminlte/images/default_avatar.png'
        skin: 'skin-blue'
        fixed_layout: false
        boxed_layout: false
        collapsed_sidebar: false
        mini_sidebar: false
        form_theme: default
        max_navbar_notifications: 5
        max_navbar_tasks: 5
        max_navbar_messages: 5
        
    control_sidebar: 
        [...]
        
    theme: 
        widget: 
            type: 'primary'
            bordered: true
            collapsible: false
            collapsible_title: 'Collapse'
            removable: false
            removable_title: 'Remove'
            solid: false
            use_footer: true
        button: 
            type: 'primary'
            size: false
            
    knp_menu: 
        enable: false
        main_menu: 'adminlte_main'
        breadcrumb_menu: false
        
    routes: 
        adminlte_welcome: 'home'
        adminlte_login: 'login'
        adminlte_login_check: 'login_check'
        adminlte_registration: NULL
        adminlte_password_reset: NULL
        adminlte_message: 'message'
        adminlte_messages: 'messages'
        adminlte_notification: 'notification'
        adminlte_notifications: 'notifications'
        adminlte_task: 'task'
        adminlte_tasks: 'tasks'
        adminlte_profile: 'profile'
```

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.
