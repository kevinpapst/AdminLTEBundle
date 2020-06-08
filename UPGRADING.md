# Upgrading

## From v3 to v4

This updates the bundle to AdminLTE v3. Be prepared for necessary changes!

- Removed `admin_lte.theme.widget.use_footer` setting, use block `box_footer`
- Removed `admin_lte.theme.widget.bordered` setting (no replacement available)
- Search form moved from left navbar to top navbar: requires minor HTML changes in your form (check AdminLTE docs & examples)
- Right "control sidebar" should not use more than one tab: HTML changes required (no alternative available)
- Custom dropdowns in the top navbar need HTML changes (check AdminLte docs & examples)
- Check colors in usages of "embed" widget `@AdminLTE/Widgets/box-widget.html.twig` (use `admin_lte.theme.widget.type` to change it globally)
- Badge colors for Menu items changed names (TODO: how, give example ????)
- Replaced config key `admin_lte.options.fixed_layout` with three new configs : `fixed_header`, `fixed_menu`, `fixed_footer` (remove `fixed_layout` from your config)
- Switched config `mini_sidebar` from `false` to `true` by default 

## From v2 to v3

- Raised minimum requirement to Symfony 4.3
- Deprecated all Event identifier strings from `ThemeEvents::XYZ`, use respective Event classes directly 
- Removed deprecated config `admin_lte.options.control_sidebar`, use `admin_lte.control_sidebar` instead
- Removed deprecated file `AdminLTE/layout/login-layout.html.twig`, use `AdminLTE/layout/security-layout.html.twig` instead
