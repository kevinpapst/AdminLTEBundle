# Upgrading

## From v2 to v3

- Raised minimum requirement to Symfony 4.3
- Deprecated all Event identifier strings from `ThemeEvents::XYZ`, use respective Event classes directly 
- Removed deprecated config `admin_lte.options.control_sidebar`, use `admin_lte.control_sidebar` instead
- Removed deprecated file `AdminLTE/layout/login-layout.html.twig`, use `AdminLTE/layout/security-layout.html.twig` instead