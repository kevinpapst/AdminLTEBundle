<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Twig;

use KevinPapst\AdminLTEBundle\Helper\Constants;
use KevinPapst\AdminLTEBundle\Helper\ContextHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AdminExtension extends AbstractExtension
{
    /**
     * @var ContextHelper
     */
    protected $context;
    /**
     * @var array
     */
    private $routes;

    /**
     * @param ContextHelper $contextHelper
     * @param array $routes
     */
    public function __construct(ContextHelper $contextHelper, array $routes)
    {
        $this->context = $contextHelper;
        $this->routes = $routes;
    }

    /**
     * @return TwigFilter[]
     */
    public function getFilters()
    {
        return [
            new TwigFilter('body_class', [$this, 'bodyClass']),
            new TwigFilter('route_alias', [$this, 'getRouteByAlias']),
            new TwigFilter('text_type', [$this, 'getTextType']),
        ];
    }

    /**
     * @param string $routeName
     * @return string
     */
    public function getRouteByAlias($routeName)
    {
        return $this->routes[$routeName] ?? $routeName;
    }

    /**
     * @param string $type
     * @return string
     */
    public function getTextType($type)
    {
        switch ($type) {
            case Constants::TYPE_INFO:
                $type = Constants::COLOR_AQUA;
                break;
            case Constants::TYPE_WARNING:
                $type = Constants::COLOR_YELLOW;
                break;
            case Constants::TYPE_SUCCESS:
                $type = Constants::COLOR_GREEN;
                break;
            case Constants::TYPE_ERROR:
                $type = Constants::COLOR_RED;
                break;
        }

        return 'text-' . $type;
    }

    /**
     * @param string $classes
     * @return string
     */
    public function bodyClass($classes = '')
    {
        $classList = explode(' ', $classes);
        $options = $this->context->getOptions();

        if (isset($options['skin'])) {
            $classList[] = $options['skin'];
        }

        $configs = [
            'fixed_header' => 'layout-navbar-fixed',
            'fixed_menu' => 'layout-fixed',
            'fixed_footer' => 'layout-footer-fixed',
            'boxed_layout' => 'layout-boxed',
            'collapsed_sidebar' => 'sidebar-collapse',
            'mini_sidebar' => 'sidebar-mini',
        ];

        foreach ($configs as $name => $class) {
            if (array_key_exists($name, $options) && $options[$name] === true) {
                $classList[] = $class;
            }
        }

        return implode(' ', array_unique(array_values($classList)));
    }
}
