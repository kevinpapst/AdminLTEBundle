# Form theme

This bundle provides two form-themes:
- [Resources/views/layout/form-theme.html.twig](Resources/views/layout/form-theme.html.twig)
- [Resources/views/layout/form-theme-horizontal.html.twig](Resources/views/layout/form-theme-horizontal.html.twig)

The first one `form-theme.html.twig` is the default theme, which is automatically registered and will be applied to all form elements, 
unless you overwrite it with an application wide form theme or manually overwrite it for a single form.

## Deactivate or switch default theme

Some users might not be comfortable with the default registration of the form theme, eg. because:
- they want to use the horizontal layout by default
- they want to activate the form theme only for single forms and not globally

With v4 you can now change that with the following config key:
```yaml
admin_lte:
    options:
        form_theme: ~
```
The allowed values are `default`, `horizontal` and the value null (here represented by `~`).

## Use the horizontal theme

To use the horizontal theme everywhere in your application edit `config/packages/twig.yaml`:

```yaml
twig:
    form_themes:
        - '@AdminLTE/layout/form-theme-horizontal.html.twig'
```

To use it only for one form, change your twig file:

```twig
    {% form_theme form '@AdminLTE/layout/form-theme-horizontal.html.twig' %}
    {{ form_start(form) }}
```

## Overwrite form theme in your application

Create a new twig file, e.g. at `templates/form/theme.html.twig`:

```twig
{% extends "@AdminLTE/layout/form-theme.html.twig" %}

{% block form_label %}
    {% if form.vars.docu is defined and form.vars.docu is not empty %}
        <a href="{{ path('help_chapter', {'chapter': form.vars.docu}) }}"><i class="{{ 'help'|icon }}"></i></a>
    {% endif %}
    {{ parent() }}
{% endblock form_label %}
``` 

and register it in `config/packages/twig.yaml`:

```yaml
twig:
    form_themes:
        - 'form/theme.html.twig'
```

### Overwrite one form with your layout

To override the default theme in any twig template you add a line like this to your twig file:

```twig
{% form_theme form 'form/theme.html.twig' %}
```

## Links 
It is also possible to overwrite the form theme by referencing 
[multiple templates](https://symfony.com/doc/current/form/form_customization.html#multiple-templates) in order of priority 
or only customize/override some child elements in the form like:

```twig
{% form_theme form.submit '@AdminLTE/layout/form-theme.html.twig' %}
```

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.
