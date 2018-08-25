# Theme options

The theme options define the basic layout of your side. 
If you want to change any default value, define the key in `config/packages/admin_lte.yaml` under the `admin_lte.options` key. 

See example below:

```yaml
admin_lte:
    options:
        default_avatar: 'bundles/adminlte/images/default_avatar.png'
        skin: 'skin-blue'
        fixed_layout: false
        boxed_layout: false
        collapsed_sidebar: false
        mini_sidebar: false
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

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.
