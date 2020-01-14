# Twig widgets

In order to simplify the usage of widget and info boxes, and to help with a consitent look and feel throughout your application, 
the bundle provides an [embeddable][3] template for the [box-widget][1] and the [infobox-widget][2]. 

## Global configuration
The global/general configuration for the box-widget can be defined using the bundle configuration. 
The values in this configuration example are the default settings. 

```yaml
admin_lte:
    theme:
        widget:
            # relates to box-<type>, default: primary
            type: primary 
            # will add .with-border to .box-header, default: true
            bordered: true
            # will add a collapse button to the widget toolbar, default: true
            collapsible: true
            # sets the title attribute for the collapse button
            collapsible_title: Collapse
            # will ad a remove button to the widget toolbar
            removable: false
            # defines the title attribute for the remove button
            removable_title: Remove
            # will add .box-solid 
            solid: false
            # will avoid rendering the .box-footer without content
            use_footer: true
```

## box-widget.html.twig

```twig
{% embed '@AdminLTE/Widgets/box-widget.html.twig' %}
    {% block box_title %}
        {# Title goes here #}
    {% endblock %}
    {% block box_body %}
        {# Content goes here #}
    {% endblock %}
{% endembed %}
```

The box widget comes with several variables and blocks to define content and customize the rendering and behavior individually. 

### Variables
_**Notice:** since FALSE will not be considered a value by Twig and therefor activate the default filter, you will have to use `0` instead_ 
<dl>
<dt>collapsed
<dd>Will render the Widget in a collapsed state and add and expander toolbutton. 

<dt>solid
<dd>Will render the widget as solid box if set to true. 

<dt>border
<dd>Will add .with-border to the box header. 

<dt>use_footer
<dd>Will render the .box-footer even if it has no content.

<dt>collapsible & collapsible_title
<dd>Will add a collapse toolbutton. This setting will alwas be true if the box is defined as `collapsed`. The `collapsible_title` will be set as the button's `title` attribute.

<dt>removable & removable_title
<dd>Will add a remove toolbutton. The `removable_title` will be set as the button's `title` attribute. 

<dt>boxtype
<dd>Sets the color-type of the box. The value should only be the type name without prefix. 
</dl>

### Blocks

<dl>

<dt>box_before
<dd>Content just before the box's openig div. 

<dt>box_title
<dd>Content inside of `.box-title`. 

<dt>box_tools
<dd>Content inside the `.box-tools` just before the collapse and/or remove buttons. 

<dt>box_body
<dd>The block for the actual box content. 

<dt>box_footer
<dd>Content inside the `.box-footer`. Using this block will force the footer rendering, regardless of the `footer` variable or configuration setting. 

<dt>box_after
<dd>Content just after the box's closing `div`

<dt>box_body_class
<dd>Addiotional css class for the box_body HTML element

<dt>box_attributes
<dd>Additional HTML attributes for the outer box HTML element

<dt>box_tools_attributes
<dd>Additional attributes for the tools HTML element

</dl>

## infobox-widget
The infobox widget has no default configuration. The very nature of this widget type is to be distinguishable from each other hence, the configuration would be overridden anyways.
```twig
{% embed '@AdminLTE/Widgets/infobox-widget.html.twig'  with {
    'color' : 'aqua',
    'icon'  : 'comments-o',
    }%}
    {% block box_text %}
        {# text goes here #}
    {% endblock %}
    {% block box_number %}
        {# number goes here #}
    {% endblock %}
    {% block progress_description %}
        {# progress text goes here#}
    {% endblock %}
{% endembed %}

```
### Variables
<dl>

<dt>solid
<dd>If you want to define a solid box, this variable should contain the color name. 

<dt>color
<dd>Defines the `.info-box-icon` color and should be the color name (obsolete if you have a `solid` box).

<dt>icon
<dd>Defines the fontawesome icon name. The value should only be the actual icon name including the prefix (e.g. `fas fa-tachometer-alt`) 

<dt>progress
<dd>Defines the progress value. The progress bar will only be rendered if the progress variable is defined. 

</dl>

### Blocks
<dl>

<dt>box_before
<dd>Content just before the opening `div`.

<dt>box_text
<dd>Content of `.info-box-text`. 

<dt>box_number
<dd>Content of `.info-box-number`.

<dt>progress_description
<dd>Content of `.progress_description`. 

<dt>box_after
<dd>Content just after the closing `div`


</dl>

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.

[1]: https://almsaeedstudio.com/themes/AdminLTE/documentation/index.html#component-box
[2]: https://almsaeedstudio.com/themes/AdminLTE/documentation/index.html#component-info-box
[3]: http://twig.sensiolabs.org/doc/tags/embed.html
