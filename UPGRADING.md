# Upgrading

## From v3 to v4 (unreleased)

Read the changelogs at https://github.com/kevinpapst/AdminLTEBundle/releases

Removed all Controller: already replaced with Twig functions for performance reasons in v3. 
Templates will be now included directly.
Check that overwritten templates/partials in your project still work (see `templates/bundles/AdminLTEBundle/`). 

Made public API stricter by adding typehints and adding the final keyword to several classes. 

Inlined some FOSUserBundle translations, to reduce coupling (check your self-registration and password-reset screens).

## From v2 to v3

- Raised minimum requirement to Symfony 4.3
- Deprecated all Event identifier strings from `ThemeEvents::XYZ`, use respective Event classes directly 
- Removed deprecated config `admin_lte.options.control_sidebar`, use `admin_lte.control_sidebar` instead
- Removed deprecated file `AdminLTE/layout/login-layout.html.twig`, use `AdminLTE/layout/security-layout.html.twig` instead