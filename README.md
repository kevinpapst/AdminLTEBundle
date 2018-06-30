# AdminThemeBundle - for Symfony 4 / FontAwesome 5

**WORD IN PROGRESS** Do not use this repository, it is not yet functional!

Remove me:
- ThemeManager & avanzu_admin_theme
- DependencyResolver
- RouteAliasCollection
- |trans({}, 'AvanzuAdminTheme'

# What this repository is

This repsitory is a fork from [AdminThemeBundle](https://github.com/avanzu/AdminThemeBundle), bringing the AdminLTE theme to Symfony 4.

## Requirements

- Symfony 4.0 or greater
- Twig

## Why choose this repository?

First and foremost: the original repository has a strong backward compatibility in mind, maintenance is only done if Symfony 3 compatibility is kept.

But the mext major version of Symfony is out and some of us work on Symfony 4 projects, probably even using webpack-encore.

Originally I tried to sent PRs for the original repository, but those weren't always accepted (which is totally fine!) but I needed an upgraded version.
So I could choose between:
- doing all the changes in my own repository and having "dev-" entries in my project composer.json
- publish this fork and use it also for releasing, so others could benefit from it as well

The choice was quite easy: I am doing the work now in this repository without staying up-to-date with the original repository.

But be aware: I decided to change the projects internal to my needs and to get rid of some of the advanced features from the original AdminThemeBundle.
I found the all-in-one solution to be more problematic then helpful at several places, so I take the chance to update it to my own interpretation of a theme bundle.

## Main difference

This branch was split of the original master but with the following changes merged on top:

- auto discovery for commands (see [#215](https://github.com/avanzu/AdminThemeBundle/pull/215))
- basic symfony4 compatibility (see [#215](https://github.com/avanzu/AdminThemeBundle/pull/216))
- dynamic config options (see [#217](https://github.com/avanzu/AdminThemeBundle/pull/217))

### Changes for upstream

Some of the changes were pushed seperately to this repository and upstream, so all users can benefit from it:

- fix-boxed-layout (see [#218](https://github.com/avanzu/AdminThemeBundle/pull/218))
- login-layout (see [#219](https://github.com/avanzu/AdminThemeBundle/pull/219))
- page-content-class (see[#220](https://github.com/avanzu/AdminThemeBundle/pull/220))

# Documentation (FIXME)

Admin Theme based on the AdminLTE Template for easy integration into symfony.
This bundle integrates several commonly used javascripts and the awesome [AdminLTE Template](https://github.com/almasaeed2010/AdminLTE).

## Installation

Installation using composer is really easy. 
This command will add `"kevinpapst/admin-lte-bundle": "dev-master"` to your composer.json and will download the bundle:

```bash
   composer require kevinpapst/admin-lte-bundle ^0.1
```

For non-released features use:

```bash
   composer kevinpapst/admin-lte-bundle dev-master
```

### Changing default values from templates
If you want to change any default value as for example `admin_skin` all you need to do is define the same at `app/config/config.yml` under `[twig]` section. See example below:

```yaml
# Twig Configuration
twig:
    debug:            "%kernel.debug%"
    strict_variables: "%kernel.debug%"
    globals:
        admin_skin: skin-blue
```

You could also define those values at `app/config/parameters.yml`:

```yaml
admin_skin: skin-blue
```

and then use as follow in `app/config/config.yml`:

```yaml
# Twig Configuration
twig:
    debug:            "%kernel.debug%"
    strict_variables: "%kernel.debug%"
    globals:
        admin_skin: "%admin_skin%"
```

AdminLTE skins are: skin-blue (default for this bundle), skin-blue-light, skin-yellow, skin-yellow-light, skin-green, skin-green-light, skin-purple, skin-purple-light, skin-red, skin-red-light, skin-black and skin-black-light. If you want to know more then go ahead and check docs for AdminLTE [here][1].

There are a few values you could change for sure without need to touch anything at bundle, just take a look under `Resources/views`. That's all.
        
### Next Steps
* [Using the layout](Resources/docs/layout.md)
* [Rebuilding the assets](Resources/docs/rebuild.md)
* [Using the ThemeManager](Resources/docs/theme_manager.md)
* [Components](Resources/docs/component_events.md)
* [Navbar User](Resources/docs/navbar_user.md)
* [Navbar Tasks](Resources/docs/navbar_tasks.md)
* [Navbar Messages](Resources/docs/navbar_messages.md)
* [Navbar Notifications](Resources/docs/navbar_notifications.md)
* [Sidebar User](Resources/docs/sidebar_user.md)
* [Sidebar Navigation](Resources/docs/sidebar_navigation.md)
* [Breadcrumb Menu](Resources/docs/breadcrumbs.md)
* [Form theme](Resources/docs/form_theme.md)

 [1]: https://almsaeedstudio.com/themes/AdminLTE/documentation/index.html
 [2]: https://img.shields.io/badge/Symfony-%202.x%20&%203.x-green.svg
 [3]: https://github.com/kevinpapst/AdminLTEBundle/issues?utf8=%E2%9C%93&q=is%3Aopen%20is%3Aissue
