# AdminLTE - a theme bundle for Symfony 4

This repository is an upgraded fork of the great [AdminThemeBundle](https://github.com/avanzu/AdminThemeBundle), bringing the AdminLTE theme to the Symfony 4 world.

## Requirements

- Symfony 4.0 or greater
- PHP 7.1.3
- Twig bundle

## Why choose this repository over the original?

First and foremost: the original repository has a strong backward compatibility in mind, maintenance is only done if Symfony 2/3 compatibility is kept ([see this issues](https://github.com/avanzu/AdminThemeBundle/pull/216)).

That means we don't get the new shiny stuff from SF4. As some of us already ork on Symfony 4 projects (probably even using webpack-encore) we needed a solution. 

### Why another fork?
 
Originally I tried to sent PRs for the original repository, but those weren't always accepted (which is totally fine!) but I needed an upgraded version.
So I could choose between:
- doing all the changes in my own repository and having "dev-" entries in my projects composer.json
- publish this fork and release it for the community, so others could benefit from it as well

The choice was quite easy: I am doing the work now in this repository with a fresh start and with the capability of backward-compatibility breaks.

Be aware: I decided to change the projects internal and got rid of some of the "advanced features" from the original [AdminThemeBundle](https://github.com/avanzu/AdminThemeBundle).
I found the all-in-one solution to be more problematic then helpful at several places, so I took the chance to update it to my own interpretation of a theme bundle.

If you previously used the `AvanzuAdminTheme` you will not be able to "just replace" the composer package. 
Plan ahead, you will probably need a couple of hours [for the migration](Resources/docs/migration_guide.md) for the migration (depending on the size of your project).

### Main differences

This branch was split of the original master but with the following PRs merged on top:

- auto discovery for commands (see [#215](https://github.com/avanzu/AdminThemeBundle/pull/215))
- basic symfony4 compatibility (see [#215](https://github.com/avanzu/AdminThemeBundle/pull/216))
- dynamic config options (see [#217](https://github.com/avanzu/AdminThemeBundle/pull/217))

And then the sugar I added in this repository: 

- replaced AliasRouting with simpler version
- changed namespaces to allow co-existence with AdminThemeBundle
- changed and extended default configuration
- updated composer.json to reflect SF4 and other bundle dependencies
- changed control-sidebar, content is now configurable both from admin-lte.yaml and ContextHelper
- Symfony Flex recipe for easier integration
- Webpack-Encore for compiling frontend-assets
- added Demo application as living documentation for first time users and easier testing

## Installation with Composer

Installation using composer is really easy:

```bash
   composer require kevinpapst/adminlte-bundle ^0.4
```

For non-released features use:

```bash
   composer kevinpapst/adminlte-bundle dev-master
```

Afterwards copy the default config to your `config/packages/` directory:

```bash
cp vendor/kevinpapst/adminlte-bundle/config/packages/admin_lte.yaml config/packages/
```

## Installation with Symfony Flex

Installation using Symfony flex is even easier:

```bash
composer config extra.symfony.allow-contrib true
composer req "kevinpapst/adminlte-bundle:^0.5"
```


## AdminLTE-Bundle Demo

In order to see a working example this bundle is showcased in a separate demo-application: [AdminLTEBundle-Demo](https://github.com/kevinpapst/AdminLTEBundle-Demo) 
        
## Documentation

Go ahead and [read the full documentation](Resources/docs/), then install and enjoy your new theme!
