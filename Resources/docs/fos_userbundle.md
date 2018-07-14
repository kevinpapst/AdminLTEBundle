# FOSUserBundle integration

This bundle is prepared for a flawless integration with FOSUserBundle, but its not coming out-of-the-box.

First follow the [installation instruction for the FOSUserBundle](http://symfony.com/doc/current/bundles/FOSUserBundle/index.html) and
configure it to your needs. 

Then integrate it with the AdminLTEBundle as follows.

## config/packages/admin_lte.yaml

```yaml
admin_lte:
    routes:
        adminlte_login: fos_user_security_login
        adminlte_login_check: fos_user_security_check
        adminlte_registration: fos_user_registration_register
        adminlte_password_reset: fos_user_resetting_request
```

If you don't want the "password reset" and/or "register account" functionality, 
simply remove the configuration keys `adminlte_password_reset` and `adminlte_registration`. 

## templates/bundles/FOSUserBundle

Create the directory with the following file structure:

```
// YouAppRoot/templates/bundles/
─ FOSUserBundle
  └── views
      ├── Registration
      │   ├── confirmed.html.twig
      │   └── register.html.twig
      ├── Resetting
      │   └── request.html.twig
      ├── Security
      │   └── login.html.twig
      └── layout.html.twig
```

Add the following files with the following minimal structure, 
you might want to overwrite the block `logo_login` to display your app name:

### Registration/register.html.twig

```
{% extends '@AdminLTE/FOSUserBundle/Registration/confirmed.html.twig' %}
```

### Registration/register.html.twig

```
{% extends '@AdminLTE/FOSUserBundle/Registration/register.html.twig' %}
```

### Resetting/request.html.twig

```
{% extends '@AdminLTE/FOSUserBundle/Resetting/request.html.twig' %}
```

### Security/login.html.twig

```
{% extends '@AdminLTE/FOSUserBundle/Security/login.html.twig' %}
```

### layout.html.twig

This example includes an (optional) changed application name: 

```
{% extends '@AdminLTE/FOSUserBundle/layout.html.twig' %}
{% block logo_login %}<b>Demo</b><br>Application{% endblock %}
```
