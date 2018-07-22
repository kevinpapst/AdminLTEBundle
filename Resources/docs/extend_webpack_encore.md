## Extend Webpack Encore

If you are going to use your customized webpack-encore configuration and
want to take advantage of all the libraries imported from AdminLTEBundle, 
you can easily extend its configuration.

### Create your webpack.config.js

First of all, create your own webpack.config.js, as in [Symfony documentation](http://symfony.com/doc/current/frontend/encore/simple-example.html):

```js
var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/builds/')
    .setPublicPath('/builds')

    // this will be your app!
    .addEntry('app', './assets/js/app.js')
    .autoProvidejQuery()
    .enableSourceMaps(!Encore.isProduction())
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    // You need sass loader!
    .enableSassLoader()
;

module.exports = Encore.getWebpackConfig();
```

Now you need to create (or update) your `package.json`. If you don't have one, copy
[package.json](../../package.json) from AdminLTEBundle. If you already have one, then
integrate it with the packages listed in `vendor/kevinpapst/adminlte-bundle/package.json`.  

Then create your main app and require adminlte:
```js
// assets/js/app.js
require('../../vendor/kevinpapst/adminlte-bundle/Resources/assets/admin-lte');
```

Then, if you haven't done it already, install all packages and build your assets:

```bash
yarn install
[...]
./node_modules/.bin/encore production
```

### Correct the assets path

Now you have to update your assets path. To do this, create a new template
that is going to extend AdminLTEBundle main template:

```twig
{# templates/base.html.twig #}

{% extends '@AdminLTE/layout/default-layout.html.twig' %}

{% block stylesheets %}
    <link rel="stylesheet" href="{{ asset('builds/app.css') }}">
{% endblock %}

{% block javascripts %}
    <script src="{{ asset('builds/app.js') }}"></script>
{% endblock %}
```

And finally, in your project, extend your `templates/base.html.twig` when rendering 
your pages:

```twig
{% extends 'base.html.twig' %}
```

Now, you can edit your `webpack.config.js` as you need. 

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.
