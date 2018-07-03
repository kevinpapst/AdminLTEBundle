# The Navbar User component

## Routes
Just like the other theme components, this one requires some route aliases to work. Please refer to the [component overview][1] to learn about the route alias details. 

### Required aliases
* profile
* logout

## Data Model

In order to use this component, your user class has to implement the `KevinPapst\AdminLTEBundle\Model\UserInterface`
```php
<?php
namespace MyAdminBundle\Model;
// ...
use KevinPapst\AdminLTEBundle\Model\UserInterface as ThemeUser

class UserModel implements  ThemeUser {
	// ...
	// implement interface methods
	// ...
}
```

## Event Listener
Next, you will need to create an EventListener to work with the `ShowUserEvent`.
```php
<?php
namespace MyAdminBundle\EventListener;

// ...

use KevinPapst\AdminLTEBundle\Event\ShowUserEvent;
use KevinPapst\AdminLTEBundle\Model\NavBarUserLink;
use MyAdminBundle\Model\UserModel;

class MyShowUserListener {

	// ...

	public function onShowUser(ShowUserEvent $event) {

		$user = $this->getUser();
		$event->setUser($user);
		
		$event->setShowProfileLink(false);

		$event->addLink(new NavBarUserLink('Followers', 'logout'));
		$event->addLink(new NavBarUserLink('Sales', 'logout'));
		$event->addLink(new NavBarUserLink('Friends', 'logout', ['id' => 2]));

	}

	protected function getUser() {
		// retrieve your concrete user model or entity
	}

}
```

## Service defintion

Finally, you need to attach your new listener to the event system:

```yaml
# config/services.yml
services:
    my_admin_bundle.show_user_listener:
        class: MyAdminBundle\EventListener\MyShowUserListener
        tags:
            - { name: kernel.event_listener, event: theme.navbar_user, method: onShowUser }
```

TODO kevin - add SF4 auto-wiring and service discovery docu

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.

[1]: component_events.md
