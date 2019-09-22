# KnpMenu integration

The KnpMenu can be used instead of the regular built-in menu and breadcrumb components. 

## Install the suggested dependency

Install through composer with:

```
composer require knplabs/knp-menu-bundle
```

And add in your `config/bundles.php`:

```
<?php
return [
    Knp\Bundle\MenuBundle\KnpMenuBundle::class => ['all' => true],
];
```

## Enabling the KnpMenu support 
In order to use the KnpMenu integration you need to enable it in the configuration: 

```yaml
admin_lte:
    knp_menu:   
        enable : true
```
Enabling the KnpMenu support will disable the regular breadcrumb and menu events. 
Instead there will be a new `knp_menu.menu_builder` aliased `adminlte_main` which will dispatch a new event to hook into.

### The Event

Quite similar to the `SidebarMenuEvent`, using the knp_menu will trigger the `KnpMenuEvent` event. 

The event listener will receive the `KnpMenuEvent` gives access to the root menu item, the menu factory and if applicable the `$options` and `$childOptions` as configured in the menu builder. 

## EventSubscriber - auto-discovery with Symfony 4

In case you activated service discovery and auto-wiring in your app, you can write an EventSubscriber which will 
be automatically registered in your container:

```php
<?php
// src/EventSubscriber/KnpMenuBuilderSubscriber.php
namespace App\EventSubscriber;

use KevinPapst\AdminLTEBundle\Event\KnpMenuEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class KnpMenuBuilderSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return [
            KnpMenuEvent::class => ['onSetupMenu', 100],
        ];
    }
    
    public function onSetupMenu(KnpMenuEvent $event)
    {
        $menu = $event->getMenu();

        $menu->addChild('MainNavigationMenuItem', [
       	    'label' => 'MAIN NAVIGATION',
            'childOptions' => $event->getChildOptions()
        ])->setAttribute('class', 'header');
        
        $menu->addChild('blogId', [
            'route' => 'item_symfony_route',
            'label' => 'Blog',
            'childOptions' => $event->getChildOptions()
        ])->setLabelAttribute('icon', 'fas fa-tachometer-alt');
        
        $menu->getChild('blogId')->addChild('ChildOneItemId', [
            'route' => 'child_1_route',
            'label' => 'ChildOneDisplayName',
            'childOptions' => $event->getChildOptions()
        ])->setLabelAttribute('icon', 'fas fa-rss-square');
        
        $menu->getChild('blogId')->addChild('ChildTwoItemId', [
            'route' => 'child_2_route',
            'label' => 'ChildTwoDisplayName',
            'childOptions' => $event->getChildOptions()
        ]);
    }
}
```
For a more in depth guide on how to use the KnpMenuBundle, please refer to the [official documentation](http://symfony.com/doc/current/bundles/KnpMenuBundle/index.html). 

## EventListener and Service definition    

If your application is using the classical approach of manually registering Services and EventListener use this method.

Write an EventListener to work with the `KnpMenuEvent`.

```php
<?php
// src/EventListener/KnpMenuBuilderListener.php
namespace App\EventListener;

use KevinPapst\AdminLTEBundle\Event\KnpMenuEvent;

class KnpMenuBuilderListener
{
    public function onSetupMenu(KnpMenuEvent $event)
    {
        $menu = $event->getMenu();

        $menu->addChild('MainNavigationMenuItem', [
       	    'label' => 'MAIN NAVIGATION',
            'childOptions' => $event->getChildOptions()
        ])->setAttribute('class', 'header');
        
        $menu->addChild('blogId', [
            'route' => 'item_symfony_route',
            'label' => 'Blog',
            'childOptions' => $event->getChildOptions()
        ])->setLabelAttribute('icon', 'fas fa-tachometer-alt');
        
        $menu->getChild('blogId')->addChild('ChildOneItemId', [
            'route' => 'child_1_route',
            'label' => 'ChildOneDisplayName',
            'childOptions' => $event->getChildOptions()
        ])->setLabelAttribute('icon', 'fas fa-rss-square');
        
        $menu->getChild('blogId')->addChild('ChildTwoItemId', [
            'route' => 'child_2_route',
            'label' => 'ChildTwoDisplayName',
            'childOptions' => $event->getChildOptions()
        ]);
    }
}
```
For a more in depth guide on how to use the KnpMenuBundle, please refer to the [official documentation](http://symfony.com/doc/current/bundles/KnpMenuBundle/index.html). 

And attach your new listener to the event system in `config/services.yaml`:
```yaml
services:
    app.setup_knp_menu_listener:
        class: App\EventListener\KnpMenuBuilderListener
        tags:
            - { name: kernel.event_listener, event: theme.sidebar_setup_knp_menu, method: onSetupMenu }
```

### Enabling breadcrumb support

Breadcrumb support is deactivated by default for KnpMenu. Its behavior can be configured with the key `breadcrumb_menu`.

You have three choices:
- set it to `false` (which is the default value) will deactivate the breadcrumb
- set it to `true` will enable breadcrumb support and use the menubuilder configured in the key `main_menu` (whose default value is `adminlte_main`) 
- set it to your own menu alias (the default menu builder is aliased `adminlte_main`)

Example 1 - activate breadcrumb by using your default menu: 

```yaml
admin_lte:
    knp_menu:   
        enable : true
        breadcrumb_menu: true
```

Example 2 - activate breadcrumb and use your own menu builder: 

```yaml
admin_lte:
    knp_menu:   
        enable : true
        breadcrumb_menu: my_menu
```

### Replacing the MenuBuilder

Rather than using the menu builder provided by this bundle (which is aliased as `adminlte_main`), you could also generate your own implementation and change the bundle configuration to use your menu builder alias. 

```yaml
admin_lte:
    knp_menu:   
        enable : true
        main_menu: <your builder alias> # By default "adminlte_main" alias
        breadcrumb_menu: <true|false|your builder alias>
```

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.
