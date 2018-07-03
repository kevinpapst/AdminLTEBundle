## Form theme

This bundle provide a form-theme under [Resources/views/layout/form-theme.html.twig](Resources/views/layout/form-theme.html.twig) which
allow customize the form elements in AdminLTE.

This is used as:

```twig
{% form_theme form '@AdminLTE/layout/form-theme.html.twig' %}
```

For override the default theme in twig template you need put in the template which you want the new form theme

```twig
{% form_theme form 'your-custom-form-theme-layout.html.twig' %}
```

For example:

```twig
{% form_theme form 'bootstrap_3_layout.html.twig' %}
```

You also could apply this, only checking if a form is defined:

```twig
{% if form is defined %}
    {% form_theme form '@AdminLTE/layout/form-theme.html.twig' %}
{% endif %}
```

Also is possible override the form theme by referencing 
[multiple templates](http://symfony.com/doc/current/cookbook/form/form_customization.html#multiple-templates) in order of priority or
only customize/override some child elements in the form like:

```twig
{% form_theme form.submit '@AdminLTE/layout/form-theme.html.twig' %}
```

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.
