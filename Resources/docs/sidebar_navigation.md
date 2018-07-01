# The Sidebar Navigation component

__*Notice* If you would rather use the KnpMenuBundle instead, please refer to the [integration guide][1].__

Although the `MenuItemInteface` as well as the `MenuItemModel` are designed to support an unlimited depth, the sidebar menu is currently limited to two levels.

## Data Model

In order to use this component, your have to create a `MenuItemModel` class that implements the `KevinPapst\AdminLTEBundle\Model\MenuItemInterface`
```php
<?php
namespace MyAdminBundle\Model;
// ...
use KevinPapst\AdminLTEBundle\Model\MenuItemInterface as ThemeMenuItem;

class MenuItemModel implements ThemeMenuItem {
	// ...
	// implement interface methods
	// ...
}
```
The bundle provides the `MenuItemModel` as a ready to use implementation of the `MenuItemInterface`. You can use it to create a menu item

```php
$menuItem = new \KevinPapst\AdminLTEBundle\Model\MenuItemModel('item', 'Item', 'item_route_name');
```

or a menu label

```php
$menuLabel = new \KevinPapst\AdminLTEBundle\Model\MenuItemModel('label', 'Label', false);
```

## Event Listener
Next, you will need to create an EventListener to work with the `MenuItemListEvent`.
```php
<?php
namespace MyAdminBundle\EventListener;

// ...

use MyAdminBundle\Model\MenuItemModel;
use KevinPapst\AdminLTEBundle\Event\SidebarMenuEvent;
use Symfony\Component\HttpFoundation\Request;

class MyMenuItemListListener {

	// ...

	public function onSetupMenu(SidebarMenuEvent $event) {

		$request = $event->getRequest();

        foreach ($this->getMenu($request) as $item) {
            $event->addItem($item);
        }

	}

	protected function getMenu(Request $request) {
		// Build your menu here by constructing a MenuItemModel array
		$menuItems = array(
            $blog = new MenuItemModel('ItemId', 'ItemDisplayName', 'item_symfony_route', array(/* options */), 'iconclasses fa fa-plane')
        );

        // Add some children

        // A child with an icon
        $blog->addChild(new MenuItemModel('ChildOneItemId', 'ChildOneDisplayName', 'child_1_route', array(), 'fa fa-rss-square'));

        // A child with default circle icon
        $blog->addChild(new MenuItemModel('ChildTwoItemId', 'ChildTwoDisplayName', 'child_2_route'));
		return $this->activateByRoute($request->get('_route'), $menuItems);
	}

	protected function activateByRoute($route, $items) {

        foreach($items as $item) {
            if($item->hasChildren()) {
                $this->activateByRoute($route, $item->getChildren());
            }
            else {
                if($item->getRoute() == $route) {
                    $item->setIsActive(true);
                }
            }
        }

        return $items;
    }

}
```

## Service defintion

Finally, you need to attach your new listener to the event system:

```yaml
# config/services.yml
services:
    my_admin_bundle.menu_listener:
        class: MyAdminBundle\EventListener\MyMenuItemListListener
        tags:
            - { name: kernel.event_listener, event:theme.sidebar_setup_menu, method:onSetupMenu }
```

TODO kevin - add SF4 auto-wiring and service discovery docu

## Next steps

Please go back to the [AdminLTE bundle documentation](index.md) to find out more about using the theme.

[1]: knp_menu.md