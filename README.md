# AdminLTE - a Theme bundle for Symfony 4

**WORK IN PROGRESS** Use at your own risk, this repository is in active development!

TODO: Fix all occurences of "TODO kevin"

# What this repository is

This repository is a fork from [AdminThemeBundle](https://github.com/avanzu/AdminThemeBundle), bringing the AdminLTE theme to te Symfony 4 world.

## Requirements

- Symfony 4.0 or greater
- Twig

## Why choose this repository?

First and foremost: the original repository has a strong backward compatibility in mind, maintenance is only done if Symfony 3 compatibility is kept.

That means we don't get the new shiny stuff from SF4. But the next major version of Symfony is already out and some of us are lucky enough to work on Symfony 4 projects, probably even using webpack-encore.
So thats what this bundle tries to achieve: bring the great AdminLTE theme to SF4 users.

### Why another fork?
 
Originally I tried to sent PRs for the original repository, but those weren't always accepted (which is totally fine!) but I needed an upgraded version.

So I could choose between:
- doing all the changes in my own repository and having "dev-" entries in my project composer.json
- publish this fork and release it for the community, so others could benefit from it as well

The choice was quite easy: I am doing the work now in this repository with a fresh start and with the capability of backward-compatibility breaks.

Be aware: I decided to change the projects internal and got rid of some of the "advanced features" from the original [AdminThemeBundle](https://github.com/avanzu/AdminThemeBundle).
I found the all-in-one solution to be more problematic then helpful at several places, so I took the chance to update it to my own interpretation of a theme bundle.

You will not be able to just replace the composer package. Plan ahead, you will need (depending on the size of your project) a couple of hours for the migration.
There are some shim files, which try to cover the layout integration (especially the blocks), but configuration and twig integration changed!  

### Main difference

This branch was split of the original master but with the following changes merged on top:

- auto discovery for commands (see [#215](https://github.com/avanzu/AdminThemeBundle/pull/215))
- basic symfony4 compatibility (see [#215](https://github.com/avanzu/AdminThemeBundle/pull/216))
- dynamic config options (see [#217](https://github.com/avanzu/AdminThemeBundle/pull/217))

Some of the changes were pushed separately to this repository and upstream, so all users can benefit from it:

- fix-boxed-layout (see [#218](https://github.com/avanzu/AdminThemeBundle/pull/218))
- login-layout (see [#219](https://github.com/avanzu/AdminThemeBundle/pull/219))
- page-content-class (see[#220](https://github.com/avanzu/AdminThemeBundle/pull/220))

And then the sugar I added on top in this repository: 

- replaced AliasRouting with simpler version
- changed namespaces to allow co-existence with AdminThemeBundle
- changed and extended default configuration
- updated composer.json to reflect SF4 and other bundle dependencies
- changed control-sidebar, content is now configurable both from admin-lte.yaml and ContextHelper
- Symfony Flex recipe for easier integration
- Webpack-Encore for compiling frontend-assets
- added Demo application for easier testing and living documentation for first time users

## Installation

Installation using composer is really easy:

```bash
   composer require kevinpapst/admin-lte-bundle ^0.1
```

For non-released features use:

```bash
   composer kevinpapst/admin-lte-bundle dev-master
```

## AdminLTE-Bundle Demo

In order to see some working examples, the bundle is showcased in a separate demo-application: [AdminLTEBundle-Demo](https://github.com/kevinpapst/AdminLTEBundle-Demo) 
        
## Documentation

Go ahead and [read the full documentation](Resources/docs/index.md), then install and enjoy your new theme!
