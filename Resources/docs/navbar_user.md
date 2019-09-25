# The Navbar User component

## Routes
Just like the other theme components, this one requires some route aliases to work. 
Please refer to the [configurations overview](configurations.md) to learn about the route alias details. 

### Required aliases
* profile
* logout

## Data Model

In order to use this component, your user class has to implement the `KevinPapst\AdminLTEBundle\Model\UserInterface`
```php
<?php
namespace App\Model;

use KevinPapst\AdminLTEBundle\Model\UserInterface;

class UserModel implements UserInterface {
    // ...
    // implement interface methods
    // ...
}
```

The bundle provides the `UserModel` as a ready to use implementation of the `UserInterface`. 

## EventSubscriber - auto-discovery with Symfony 4

In case you activated service discovery and auto-wiring in your app, you can write an EventSubscriber which will 
be automatically registered in your container:

```php
<?php
// src/EventSubscriber/NavbarUserSubscriber.php
namespace App\EventSubscriber;

use App\Entity\User;
use KevinPapst\AdminLTEBundle\Event\ShowUserEvent;
use KevinPapst\AdminLTEBundle\Event\NavbarUserEvent;
use KevinPapst\AdminLTEBundle\Event\SidebarUserEvent;
use KevinPapst\AdminLTEBundle\Model\UserModel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class NavbarUserSubscriber implements EventSubscriberInterface
{
    protected $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            NavbarUserEvent::class => ['onShowUser', 100],
            SidebarUserEvent::class => ['onShowUser', 100],
        ];
    }

    public function onShowUser(ShowUserEvent $event)
    {
        if (null === $this->security->getUser()) {
            return;
        }

        /* @var $myUser User */
        $myUser = $this->security->getUser();

        $user = new UserModel();
        $user
            ->setId($myUser->getId())
            ->setName($myUser->getUsername())
            ->setUsername($myUser->getUsername())
            ->setIsOnline(true)
            ->setTitle('demo user')
            ->setAvatar($myUser->getAvatar())
            ->setMemberSince($myUser->getRegisteredAt())
        ;

        $event->setUser($user);
    }
}
```

## EventListener and Service definition    

If your application is using the classical approach of manually registering Services and EventListener use this method.

Write an EventListener to work with the `ShowUserEvent`:

```php
<?php
// src/EventListener/NavbarUserListener.php
namespace App\EventListener;

use KevinPapst\AdminLTEBundle\Event\ShowUserEvent;
use KevinPapst\AdminLTEBundle\Model\NavBarUserLink;
use KevinPapst\AdminLTEBundle\Model\UserModel;

class NavbarUserListener
{
    public function onShowUser(ShowUserEvent $event)
    {
        $user = $this->getUser();
        $event->setUser($user);
        
        $event->setShowProfileLink(false);
    
        $event->addLink(new NavBarUserLink('Followers', 'logout'));
        $event->addLink(new NavBarUserLink('Sales', 'logout'));
        $event->addLink(new NavBarUserLink('Friends', 'logout', ['id' => 2]));
    }
    
    protected function getUser()
    {
        // retrieve your concrete user model or entity
        // see above in NavbarUserSubscriber for a full example
        return new UserModel();
    }

}
```

And attach your new listener to the event system:

```yaml
# config/services.yml
services:
    my_admin_bundle.show_user_listener:
        class: App\EventListener\NavbarUserListener
        tags:
            - { name: kernel.event_listener, event: theme.navbar_user, method: onShowUser }
```

## Customizing the HTML output

Considering you want to change the generated HTML of the user dropdown, you can simply overwrite the template.

Create the file `templates/bundles/AdminLTEBundle/Navbar/user.html.twig` and add your own HTML.

Or you can even replace some blocks inside the themes template by extending it:
```twig
{% extends "@!AdminLTE/Navbar/user.html.twig" %}
{% block member_since %}
    {# I do not want to display the member since information #}
{% endblock %}
```

Right now, there is only the one block `member_since`, but if you need more: just drop a PR for new ones!

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.
