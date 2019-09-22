# The Sidebar Navigation component

__*Notice* If you would rather use the KnpMenuBundle instead, please refer to the [integration guide][1].__

Although the `MenuItemInteface` as well as the `MenuItemModel` are designed to support an unlimited depth, 
the sidebar menu is currently limited to two levels.

## Data Model

In order to use this component, your have to create a `MenuItemModel` class that implements `\KevinPapst\AdminLTEBundle\Model\MenuItemInterface`
```php
<?php
namespace App\Model;

use KevinPapst\AdminLTEBundle\Model\MenuItemInterface;

class MenuItemModel implements MenuItemInterface {
    // ...
    // implement interface methods
    // ...
}
```
The bundle provides the `MenuItemModel` as a ready to use implementation of the `MenuItemInterface`. 
You can use it to create a menu item:

```php
$menuItem = new \KevinPapst\AdminLTEBundle\Model\MenuItemModel('item', 'Item', 'item_route_name');
```

or a menu label:
```php
$menuLabel = new \KevinPapst\AdminLTEBundle\Model\MenuItemModel('label', 'Label', false);
```

## EventSubscriber - auto-discovery with Symfony 4

In case you activated service discovery and auto-wiring in your app, you can write an EventSubscriber which will 
be automatically registered in your container:

```php
<?php
// src/EventSubscriber/MenuBuilderSubscriber.php
namespace App\EventSubscriber;

use KevinPapst\AdminLTEBundle\Event\SidebarMenuEvent;
use KevinPapst\AdminLTEBundle\Model\MenuItemModel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MenuBuilderSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            SidebarMenuEvent::class => ['onSetupMenu', 100],
        ];
    }
    
    public function onSetupMenu(SidebarMenuEvent $event)
    {
        $blog = new MenuItemModel('blogId', 'Blog', 'item_symfony_route', [], 'fas fa-tachometer-alt');
    
        $blog->addChild(
            new MenuItemModel('ChildOneItemId', 'ChildOneDisplayName', 'child_1_route', [], 'fas fa-rss-square')
        )->addChild(
            new MenuItemModel('ChildTwoItemId', 'ChildTwoDisplayName', 'child_2_route')
        );
        
        $event->addItem($blog);

        $this->activateByRoute(
            $event->getRequest()->get('_route'),
            $event->getItems()
        );
    }

    /**
     * @param string $route
     * @param MenuItemModel[] $items
     */
    protected function activateByRoute($route, $items)
    {
        foreach ($items as $item) {
            if ($item->hasChildren()) {
                $this->activateByRoute($route, $item->getChildren());
            } elseif ($item->getRoute() == $route) {
                $item->setIsActive(true);
            }
        }
    }
}
```

## EventListener and Service definition    

If your application is using the classical approach of manually registering Services and EventListener use this method.

Write an EventListener to work with the `SidebarMenuEvent`.

```php
<?php
// src/EventListener/MenuBuilderListener.php
namespace App\EventListener;

use KevinPapst\AdminLTEBundle\Event\SidebarMenuEvent;
use KevinPapst\AdminLTEBundle\Model\MenuItemModel;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilderListener
{
    public function onSetupMenu(SidebarMenuEvent $event)
    {
        $request = $event->getRequest();
    
        foreach ($this->getMenu($request) as $item) {
            $event->addItem($item);
        }
    }
    
    protected function getMenu(Request $request)
    {
        $blog = new MenuItemModel('ItemId', 'ItemDisplayName', 'item_symfony_route', [], 'iconclasses fa fa-plane');
    
        $blog->addChild(
            new MenuItemModel('ChildOneItemId', 'ChildOneDisplayName', 'child_1_route', [], 'fa fa-rss-square')
        )->addChild(
            new MenuItemModel('ChildTwoItemId', 'ChildTwoDisplayName', 'child_2_route')
        );
        
        return $this->activateByRoute($request->get('_route'), [$blog]);
    }
    
    /**
     * @param string $route
     * @param MenuItemModel[] $items
     * @return MenuItemModel[]
     */
    protected function activateByRoute($route, $items)
    {
        foreach($items as $item) {
            if($item->hasChildren()) {
                $this->activateByRoute($route, $item->getChildren());
            } elseif($item->getRoute() == $route) {
                $item->setIsActive(true);
            }
        }
    
        return $items;
    }
}
```

And attach your new listener to the event system in `config/services.yaml`:
```yaml
services:
    my_admin_bundle.menu_listener:
        class: App\EventListener\MenuBuilderListener
        tags:
            - { name: kernel.event_listener, event: theme.sidebar_setup_menu, method: onSetupMenu }
```

## Translating menu items

You don't have to care about translating your menu items, simply use the translation key instead of the translated string.

The label of each menu item will be automatically displayed by applying the `|trans` filter: 
```twig
{{ item.label|trans }} 
```
The default translation domain `messages` will be used (see `Resources/views/Macros/menu.html.twig`).

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.

[1]: knp_menu.md