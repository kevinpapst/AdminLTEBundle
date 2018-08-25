# Using the layout

In order to use the layout, your views should extend from the provided `default-layout`
```twig
{% extends '@AdminLTE/layout/default-layout.html.twig' %}
```
## Twig Context-Helper
 
Instead of fully relying on blocks and includes, you are provided with a twig global named `admin_lte_context` to retrieve 
several configuration values throughout the page rendering.
 
This is basically a parameter bag with some pre-defined values based on the bundle configuration.
It contains the following configuration keys:

- everything from `admin_lte.options`
- `button` from `admin_lte.theme.button`
- `widget` from `admin_lte.theme.widget`
- `control_sidebar` from `admin_lte.control_sidebar`
- `knp_menu` from `admin_lte.knp_menu`

To see all available settings, simply dump it in one of your templates:

```twig
{{ dump(admin_lte_context.options) }}
```

## Layout files

This bundle ships with two main template files which you need to extend in your theme:

- `default-layout.html.twig` for all default files
```
{% extends '@AdminLTE/layout/default-layout.html.twig' %}
```
- `security-layout.html.twig` for the security screens (login, register, forgot password)
```
{% extends '@AdminLTE/layout/security-layout.html.twig' %}
```
See [FOSUserBundle](fos_userbundle.md) for an easy integration of the security functionality.


## Partials

In order to make overriding some of the template regions easier, there are several partials included within the layout 
which can be overridden individually as described [here](http://symfony.com/doc/current/templating/overriding.html). 

Listed in the order of appearance, these are:

<dl>

<dt>@AdminLTE/Sidebar/knp-menu.html.twig
<dd>Renders the knp menu using the builder defined as `main_menu`. 
<br/>___Notice___ *this partial will only be included when the knp_menu is enabled.*

<dt>@AdminLTE/Breadcrumb/knp-breadcrumb.html.twig
<dd>Renders the knp menu using the builder defined as `breadcrumb_menu` 
<br/>___Notice___ *this partial will only be included when the knp_menu is enabled.*

<dt>@AdminLTE/Partials/_footer.html.twig
<dd>Renders the main footer

<dt>@AdminLTE/Partials/_control-sidebar.html.twig
<dd>Renders the control sidebar (right-hand panel) WHEN there are configured panels in the config `admin_lte.options.control_sidebar`

</dl>

## Layout blocks

The blocks are defined in the layout in order of appearance. Some of them do contain some of the major components like the sidebar or navbar. 
In order to redefine the block and to keep the default content, don't forget to use `{{parent()}}`.

### security-layout.html.twig

<dl>

<dt>login_box
<dd>The main content block, containing the complete body of the   

<dt>logo_login
<dd>The welcome title, should hold your application name or logo icon

<dt>login_box_msg
<dd>The box (inside) title, e.g. when you have different forms add a short title/explanation here

<dt>login_box_error
<dd>Security errors will be rendered in this block

<dt>login_form
<dd>

<dt>login_form_start
<dd>

<dt>login_form_end
<dd>

<dt>login_social_auth
<dd>

<dt>login_actions
<dd>

</dl>


### default-layout.html.twig

<dl>

<dt>html_start
<dd>Allows to add additional attributes to the `html` tag (like `ng-app` for Angular)

<dt>title
<dd>Defines the `title` and defaults to the contents of the block `page_title`

<dt>stylesheets
<dd>Defines all stylesheet tags that will be embedded in the `head` section

<dt>head
<dd>additional tags that go into the `head` section

<dt>body_start
<dd>Can be used to add additional attributes in the `body` tag (like `ng-app` for Angular)

<dt>after_body_start
<dd>comes right after the opening `body` tag

<dt>logo_path
<dd>The href value of `a.logo`

<dt>logo_mini
<dd>Contents of `.logo-mini`

<dt>logo_large
<dd>Contents of `.logo-lg`

<dt>navbar_toggle
<dd>Renders the `.sidebar-toggle` button

<dt>navbar_messages
<dd>Renders the `messages` component

<dt>navbar_notifications
<dd>Renders the `notifications` component

<dt>navbar_tasks
<dd>Renders the `tasks` component

<dt>navbar_user
<dd>Renders the `user` component

<dt>navbar_control_sidebar_toggle
<dd>Renders the toggle for the `control_sidebar` (if enabled)

<dt>sidebar_user
<dd>Renders the `userPanel` component 

<dt>sidebar_search
<dd>Renders the `searchPanel` component

<dt>sidebar_nav
<dd>Renders the `menu` component _or_ includes `@AdminLTE/Sidebar/knp-menu.html.twig` depending on wether the `knp_menu` is enabled or not. 

<dt>page_title
<dd>Defines the page header inside `.content-header` and implicitly the `title` if you haven't changed the content of `title`

<dt>page_subtitle
<dd>Defines the `small` portion of `.content-header`

<dt>breadcrumb
<dd>Renders either the `breadcrumb` component or includes `@AdminLTE/Breadcrumb/knp-breadcrumb.html.twig` based on your configuration.

<dt>page_content
<dd>The main content area.

<dt>page_content_class
<dd>The CSS class for the content block `page_content`.

<dt>page_content_before
<dd>A block to add additional content right before the start of `page_content`.

<dt>page_content_after
<dd>A block to add additional content right after the end of `page_content`.

<dt>footer
<dd>The main footer. Includes `@AdminLTE/Partials/_footer.html.twig` by default.

<dt>control_sidebar
<dd>Includes `@AdminLTE/Partials/_control-sidebar.html.twig`

<dt>javascripts
<dd>block to render `script` tags right before the closing `body`

</dl>

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.
