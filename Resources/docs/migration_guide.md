# Migration from the AdminThemeBundle

This is not a step-by-step migration guide but a collection of hints what needs to be done. 
Many of you will have a highly adjusted version of the AdminThemeBundle, so the best tip is to search for `avanzu` and 
check if you need to change this occurence.

The following hints should be reviewed carefully, as they apply for all of your projects. 

## New requirements

- PHP >= 7.1.3
- Symfony >= 4.0
- FontAwesome 5
- npm (for rebuilding the frontend assets)

## Replace composer package

First you want to start-off with changing the composer package:

```
composer remove avanzu/admin-theme-bundle
composer require kevinpapst/adminlte-bundle
``` 

The bundle in your `config/bundles.php` should be auto-replaced, it changes from:
```
<?php
return [
    ...
    Avanzu\AdminThemeBundle\AvanzuAdminThemeBundle::class => ['all' => true],
];
```
to
```
<?php
return [
    ...
    KevinPapst\AdminLTEBundle\AdminLTEBundle::class => ['all' => true],
];
```

## Changed bundle name

Due to the changes in the bundle, you have to replace all class and view references.

### Namespaces

Replace `use Avanzu\AdminThemeBundle\` with `use KevinPapst\AdminLTEBundle\`.

### Template references

Replace `@AdminThemeBundle/` with `@AdminLTE`, as example before
```
{% include('@AdminThemeBundle/Partials/_footer.html.twig') %}
```
and afterwards
```
{% include('@AdminLTE/Partials/_footer.html.twig') %}
```

Also the controller references need to be changed from `AdminThemeBundle:` to `AdminLTEBundle:`, as example from:
```
controller('AdminThemeBundle:Navbar:messages')
```
to
```
controller('AdminLTEBundle:Navbar:messages')
```

Some macro files were updated and moved, replace:

```
{% import "@AvanzuAdminTheme/layout/macros.html.twig" as macro %}
```
to
```
{% import "@AdminLTE/Macros/default.html.twig" as macro %}
```

## Changed config

The configuration is now based in the file `admin_lte.yaml` with the main key `admin_lte`, 
which was previously `avanzu_admin_theme` in the file `avanzu_admin_theme.yaml` (depending on your setup this might be located somewhere else).

They following keys are not supported any longer and can be removed:

- `use_twig: true`
- `use_assetic: false`
- `bower_bin: "/usr/local/bin/bower"`

The config key `control_sidebar: true` was a boolean before and is now an array (see below in "Configurable control-sidebar").

NOTE: only `YAML` configs are shipped and `XML` is not supported any longer.

## Changed route aliases

The file `routes.yml` was removed and the route-aliases were moved to the file `admin-lte.yaml` in the config key `admin_lte.routes`.

The configuration was simplified, it is now a key-value definition, where the key is the theme-internal name and the value is the route name for your application.

For example you need to replace:
```
avanzu_admin_profile:
  path: /{_locale}/profile/{username}
  options:
    avanzu_admin_route: profile
``` 
with
``` 
admin_lte:
    routes:
        adminlte_profile: user_profile
```
where the route is defined via annotation:
```
class ProfileController extends AbstractController
{
    /**
     * @Route("/profile/{username}", name="user_profile")
     */
    public function indexAction(User $profile)
    {
        return $this->getProfileView($profile, 'charts');
    }

}
```

More information can be found in the [configurations docu](configurations.md).

## Removed components

The following files were removed, please check your references:

- all demo classes, files and configs (replaced by the [demo application](https://github.com/kevinpapst/AdminLTEBundle-Demo))
- class: WidgetHelper
- class: ExceptionController
- class: DefaultController
- class: WidgetController
- class: RouteAliasCollection
- class: ThemeManager
- class: WidgetExtension
- class: DependencyResolver

## Templates and layouts

There are shim files, which you can use while you are migrating your application. 
If you previously relied on the AvanzuAdminTheme layouts, then these files are a replacement for the default twig layouts:

- Use `default-layout-avanzu.html.twig` instead of `default-layout.html.twig` 
- Use `login-layout-avanzu.html.twig` instead of `login-layout.html.twig` 

Make sure that you don't call `{{ parent() }}` in all blocks start start with the prefix `avanzu_`, as these blocks are only called virtually and don't exist any longer.

Further modifications:

- removed include `Partials/_head.html.twig` (use blocks `head`, `document_title`, `stylesheets` and `javascripts`)
- removed include `Partials/_scripts.html.twig`

The default layouts were modified to be more compatible with other themes, so the block names were changed and they do not contain `avanzu_` any longer as prefix.

### Changed blocks 

Removed blocks:

- `avanzu_javascripts` 
- `avanzu_javascripts_inline`

Use `javascripts` instead and don't forget to call `{{ parent() }}` (unless you compile the assets yourself).

## Configurable control-sidebar

The implementation of the control-sidebar is now dynamically and you can add tabs by defining their icon and content (either by include or controller action).

If you previously use your own `Partials/_control-sidebar.html.twig` then please check if you can replace it with the theme version.
Considering you cannot or don't want to change to the theme's implenetation then you might need to overwrite the block `{% block avanzu_navbar_control_sidebar_toggle %}` or create an empty fake configuration:

```yaml
# admin-lte.yaml
admin_lte:
    options:
        control_sidebar:
            fake:
                icon: foo
                template: bar
```

Please check the [configurations](configurations.md) and [control-sidebar](control_sidebar.md) docu to for more information.

## Frontend assets

The frontend-assets are pre-compiled into one CSS and one Javascript file. There is no `ThemeManager` any longer!

If you have your own assets or need to run your application in a subdirectory, you need to adjust the build process.
Read the [building frontend assets](frontend_assets.md) documentation and see the [demo application](https://github.com/kevinpapst/AdminLTEBundle-Demo) on how that can be achieved.

### FontAwesome 5

Compared to the original theme, this bundle was upgraded to use FontAwesome 5.

Please read the [upgrading from v4](https://fontawesome.com/how-to-use/on-the-web/setup/upgrading-from-version-4) documentation carefully, most icon definitions are incompatible as the previous prefix `fa` was replaced by `far` / `fas` / `fab`.

You have to find the proper font and icon and replace it from this:

```html
<i class="fa fa-tachometer"></i>
```

to the new version:

```html
<i class="fas fa-tachometer-alt"></i>
```

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.
