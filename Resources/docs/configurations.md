# Configurations

After installing the theme, you have to adjust a couple of config settings to your application.

The configuration file is located at `config/packages/admin_lte.yaml` 

## Theme options (admin_lte.options)

If you want to change any default value as for example `admin_skin` all you need to do is define the value at `config/packages/admin_lte.yaml` under `options` section. 

See example below:

```yaml
admin_lte:
    options:
        skin: skin-blue
```

Available AdminLTE skins are: 

- skin-blue (default)
- skin-blue-light
- skin-yellow
- skin-yellow-light
- skin-green
- skin-green-light
- skin-purple
- skin-purple-light
- skin-red
- skin-red-light
- skin-black
- skin-black-light

All available options can be seen in the [admin_lte.yaml](https://github.com/kevinpapst/AdminLTEBundle/blob/master/config/packages/admin_lte.yaml) file. 

There are a more values you could change without the need to touch the bundle templates, take a look through the files under `Resources/views`.

## KNP Menu (admin_lte.knp_menu)

Pleas read the [KNP menu docu](knp_menu.md) for more information.

## Route aliases (admin_lte.routes)

Since most of the components do generate one or two specific links (e.g. task list and task details) we are using an alias concept for defining the link within the theme.

The specific routes must be rigged with the option `admin_lte.routes` defining the alias name like so: 

```yaml
# admin_lte.yaml
admin_lte:
    routes:
        adminlte_welcome: dashboard
```

Here the theme route name `welcome` maps to your route `dashboard` here. Without defining these routes, the theme will not be able to render.

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

## Next steps

Please go back to the [AdminLTE bundle documentation](index.md) to find out more about using the theme.
