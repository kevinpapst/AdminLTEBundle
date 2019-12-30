# Upgrading

## From v3 to v4

This updates the bundle to AdminLTE v3. Be prepared for necessary changes!

- Removed `admin_lte.theme.widget.use_footer` setting, use block `box_footer`
- Removed `admin_lte.theme.widget.bordered` setting
- Search form moved from left navbar to top navbar: requires minor HTML changes
- Right "control sidebar" should not use more than one tab: HTML changes required
- Custom dropdowns in the top navbar need HTML changes
- Check colors for usages of "embed" widget `@AdminLTE/Widgets/box-widget.html.twig` (use `admin_lte.theme.widget.type` to change it globally)

## From v2 to v3

- Raised minimum requirement to Symfony 4.3
- Deprecated all Event identifier strings from `ThemeEvents::XYZ`, use respective Event classes directly 
- Removed deprecated config `admin_lte.options.control_sidebar`, use `admin_lte.control_sidebar` instead
- Removed deprecated file `AdminLTE/layout/login-layout.html.twig`, use `AdminLTE/layout/security-layout.html.twig` instead