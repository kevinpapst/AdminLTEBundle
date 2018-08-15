[![Latest Stable Version](https://poser.pugx.org/kevinpapst/adminlte-bundle/v/stable)](https://packagist.org/packages/kevinpapst/adminlte-bundle)
[![Total Downloads](https://poser.pugx.org/kevinpapst/adminlte-bundle/downloads)](https://packagist.org/packages/kevinpapst/adminlte-bundle)
[![License](https://poser.pugx.org/kevinpapst/adminlte-bundle/license)](LICENSE)

# AdminLTE Bundle for Symfony 4

This repository is an upgraded version of the AvanzuAdminThemeBundle, bringing the AdminLTE theme to Symfony 4.

## Requirements

- Symfony 4.0
- PHP 7.1.3
- Twig 2.0

## Documentation

Go ahead and [read the full documentation](Resources/docs/), then install and enjoy your new theme!

## Features

Some of the main features of this theme bundle:

- Two main layouts for main application and security (login, forgot password, register account...)
- Support for Symfony 4.x
- Support for KNPMenuBundle 
- Support for FOSUserBundle
- Webpack-Encore support for building assets
- Event-driven handling of menu entries, tasks and notifications
- Translations for english and german (please help translating it to more languages)
- Based on AdminLTE 2.4.8

## Installation with Symfony Flex

Installation using Symfony flex is the recommended way:

```bash
composer config extra.symfony.allow-contrib true
composer req "kevinpapst/adminlte-bundle:^2.0"
```

## Installation with Composer

Installation using the traditional composer approach is almost as simple:

```bash
   composer require kevinpapst/adminlte-bundle ^2.0
```

Afterwards copy the default config to your `config/packages/` directory:

```bash
cp vendor/kevinpapst/adminlte-bundle/config/packages/admin_lte.yaml config/packages/
```

## AdminLTE-Bundle Demo

In order to see a working example this bundle is showcased in a separate demo-application: [AdminLTEBundle-Demo](https://github.com/kevinpapst/AdminLTEBundle-Demo).

The demo is neither fully functional nor showcasing all options right now, but I am working on it!

## Why choose this repository over the original?

First and foremost: the original repository has a strong backward compatibility in mind, maintenance is only done if Symfony 2/3 compatibility is kept ([see this issues](https://github.com/avanzu/AdminThemeBundle/pull/216)).

That means you don't get the new shiny stuff for SF4. As some of us already ork on Symfony 4 projects (probably even using webpack-encore) there needed to be a solution. 

### Why another fork?
 
Originally I tried to sent PRs for the original repository, but those were not always accepted (which is totally fine!) but I needed an upgraded version.
For some time I tried to manage a branch in a fork, but that wasn't working well and I found myself overwriting more and more stuff in my project.  
There came a point were I had to choose between:
- doing all the changes in my project or when possible in my own forked repository and having "dev-" entries in my projects composer.json
- cleanup the fork and merge it with my project changes and then publish this fork and release it for the community

The choice was quite easy: I am doing the work now in this repository with a fresh start and with the capability of backward-compatibility breaks (for the users migrating from the AdminThemeBundle).

### Main differences

This branch was split of the original master but with the following PRs merged on top:

- Auto discovery for commands (see [#215](https://github.com/avanzu/AdminThemeBundle/pull/215))
- Symfony4 compatibility (see [#215](https://github.com/avanzu/AdminThemeBundle/pull/216))
- Dynamic config options (see [#217](https://github.com/avanzu/AdminThemeBundle/pull/217))

And a lot of other changes which I added in this repository: 

- upgraded to AdminLTE 2.4.8
- added support for [FOSUserBundle](Resources/docs/fos_userbundle.md)
- added Symfony Flex recipe for easier integration
- using Webpack-Encore for compiling frontend-assets
- replaced AliasRouting with simpler version
- changed namespaces to allow co-existence with AdminThemeBundle
- changed and extended default configuration
- huge cleanup of the codebase
- changed all codeblock-names (with additional shim files for migration)   
- changed control-sidebar, content is now configurable from admin_lte.yaml or the ContextHelper
- a [Demo application](https://github.com/kevinpapst/AdminLTEBundle-Demo) as living documentation for first time users and easier testing
- updated composer.json to reflect more up-to-date bundle dependencies

### Migration from AvanzuAdminTheme

Be aware: I decided to change some project internals and got rid of some features from the original AdminThemeBundle.
I found the all-in-one solution to be more problematic then helpful at several places, so I took the chance to update it to my own interpretation of a theme bundle.

If you previously used the `AvanzuAdminTheme` you will not be able to "just replace" the composer package. 
Plan ahead, you will need (depending on the size of your project) a couple of hours [for the migration](Resources/docs/migration_guide.md).

I migrated my own project within ~4 hours, but I had to move a lot of the customization to the bundle (e.g. the webpack-encore build) in the same time. 
See the PRs [#202](https://github.com/kevinpapst/kimai2/pull/202/files) and [#206](https://github.com/kevinpapst/kimai2/pull/206/files) for migration examples. 

## License and contributors

Published under the MIT, read the [LICENSE](LICENSE) file for more information.

This repository is based on the work of [AdminThemeBundle](https://github.com/avanzu/AdminThemeBundle), please check their contributor list as well and give them a star!
