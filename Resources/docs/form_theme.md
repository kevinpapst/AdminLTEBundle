# Form theme

This bundle provide a form-theme under [Resources/views/layout/form-theme.html.twig](Resources/views/layout/form-theme.html.twig).

This form theme is automatically registered and will be applied to all form elements, unless you overwrite it with an application wide form 
theme or manually overwrite it for a single form.

## Overwrite it application wide

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

## Apply it to a single form

This is used as:

```twig
{% form_theme form '@AdminLTE/layout/form-theme.html.twig' %}
```

## Overwrite one form with your layout

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
