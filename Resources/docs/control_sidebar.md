# Control-Sidebar

The control sidebar on the right-hand screen will slide-in over the content area.
It can contain up to 5 tabs, all of them will display an icon in the tab header.     

It can be configured with the package config `admin_lte.yaml` at the node:
```yaml
admin_lte:
    control_sidebar:
```

The `control_sidebar` key is an array, where each key represents a tab. It must contain an combination of two keys:

- either `icon` and `template`
- or `icon` and `controller`

Both variants can be mixed through the tabs, so this would be a valid configuration:
 
```yaml
admin_lte:
    control_sidebar:
        home:
            icon: fas fa-home
            template: control-sidebar/home.html.twig
        settings:
            icon: fas fa-cogs
            controller: 'App\Controller\DefaultController::controlSidebarSettings'
```

The first tab `home` will use the FontAwesome icon `home` and render the content from the template located at `templates/control-sidebar/home.html.twig`.

The second tab `settings` will use the FontAwesome icon `cogs` and render the content from the result of the call to the `DefaultController` and its action `controlSidebarSettings()`.

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.
