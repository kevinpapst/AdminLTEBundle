[![Latest Stable Version](https://poser.pugx.org/kevinpapst/adminlte-bundle/v/stable)](https://packagist.org/packages/kevinpapst/adminlte-bundle)
[![Build Status](https://travis-ci.org/kevinpapst/AdminLTEBundle.svg?branch=master)](https://travis-ci.org/kevinpapst/AdminLTEBundle)
[![Total Downloads](https://poser.pugx.org/kevinpapst/adminlte-bundle/downloads)](https://packagist.org/packages/kevinpapst/adminlte-bundle)
[![License](https://poser.pugx.org/kevinpapst/adminlte-bundle/license)](LICENSE)

# AdminLTE Bundle for Symfony 4

This repository is an upgraded version of the AvanzuAdminThemeBundle, bringing the AdminLTE theme to Symfony 4.

## Minimum requirements

- Symfony 4.0
- PHP 7.1.3
- Twig 2.0

## Documentation

Go ahead and [read the full documentation](Resources/docs/), then install and enjoy your new theme!

__AdminLTE-Bundle Demo__

In order to see a working example this bundle is showcased in a separate demo-application: [AdminLTEBundle-Demo](https://github.com/kevinpapst/AdminLTEBundle-Demo).

## Features

Some of the main features of this theme bundle:

- Two main layouts for main application and security (login, forgot password, register account...)
- Support for Symfony 4.x
- Support for KNPMenuBundle 
- Support for FOSUserBundle
- Webpack-Encore support for building assets
- Event-driven handling of menu entries, tasks and notifications
- Translations for: english, german, italian, czech, russian, arabic, japanese, swedish, portuguese (please help translating it to more languages)
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

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Afterwards copy the default config to your `config/packages/` directory:

```bash
cp vendor/kevinpapst/adminlte-bundle/config/packages/admin_lte.yaml config/packages/
```

Then, enable the bundle by adding it to the list of registered bundles in the `config/bundles.php` file of your project:

```php
<?php

return [
    // ...
    KevinPapst\AdminLTEBundle\AdminLTEBundle::class => ['all' => true],
];
```

## Why choose this repository over the original?

First and foremost: the original repository has a strong backward compatibility in mind, maintenance is only done if Symfony 2 and 3 compatibility is kept ([see this issues](https://github.com/avanzu/AdminThemeBundle/pull/216)).

That means you don't get the new shiny stuff for SF4. As I work on a Symfony 4 project, utilizing webpack-encore I needed a solution. 

First I tried to sent PRs for the original repository, but [those were not always accepted](https://github.com/avanzu/AdminThemeBundle/pulls/kevinpapst). 
As I really needed an upgraded version, I tried to managed a branch in a fork for a couple of weeks, but that wasn't working well 
and I found myself overwriting more and more stuff in my project until there was a point were I had to choose between:
1. doing all the changes in my project 
2. doing the changes in my forked repository and having "dev-" entries in my composer.json
3. cleanup the fork, merge it with my project changes and release it for the community

The choice **3** was easy and obvious for me: I am doing the work now in this repository with a fresh start and some backward-compatibility breaks (for the users migrating from the AdminThemeBundle).

### Main differences

This repository was created from the original master, but with the following PRs merged on top:

- Auto discovery for commands (see [#215](https://github.com/avanzu/AdminThemeBundle/pull/215))
- Symfony4 compatibility (see [#215](https://github.com/avanzu/AdminThemeBundle/pull/216))
- Dynamic config options (see [#217](https://github.com/avanzu/AdminThemeBundle/pull/217))

And a lot of other changes which I added in this repository: 

- upgraded to AdminLTE 2.4.8
- added support for [FOSUserBundle](Resources/docs/fos_userbundle.md)
- added Symfony Flex recipe for easier integration
- using Webpack-Encore for compiling frontend-assets
- fixed KNPMenu integration
- replaced AliasRouting with simpler version
- changed namespaces to allow co-existence with AdminThemeBundle for migration
- changed and extended default configuration
- huge cleanup of the codebase
- changed all twig block-names (with additional layout shim files for migration)   
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
