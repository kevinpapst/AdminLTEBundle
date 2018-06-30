<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AdminLTEBundle\Twig;

use AdminLTEBundle\Helper\ContextHelper;
use AdminLTEBundle\Routing\RouteAliasCollection;

class AdminExtension extends \Twig_Extension
{
    /**
     * @var ContextHelper
     */
    protected $context;
    /**
     * @var string
     */
    protected $env;
    /**
     * @var RouteAliasCollection
     */
    private $aliasRouter;

    /**
     * @param ContextHelper $contextHelper
     * @param $env
     * @param RouteAliasCollection $aliasRouter
     */
    public function __construct(ContextHelper $contextHelper, $env, RouteAliasCollection $aliasRouter)
    {
        $this->context = $contextHelper;
        $this->env = $env;
        $this->aliasRouter = $aliasRouter;
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('body_class', [$this, 'bodyClass']),
            new \Twig_SimpleFilter('route_alias', [$this->aliasRouter, 'getRouteByAlias']),
        ];
    }

    public function bodyClass($classes = '')
    {
        $classList = [$classes];
        $options = $this->context->getOptions();

        if (isset($options['skin'])) {
            $classList[] = $options['skin'];
        }
        if (isset($options['fixed_layout']) && true == $options['fixed_layout']) {
            $classList[] = 'fixed';
        }
        if (isset($options['boxed_layout']) && true == $options['boxed_layout']) {
            $classList[] = 'layout-boxed';
        }
        if (isset($options['collapsed_sidebar']) && true == $options['collapsed_sidebar']) {
            $classList[] = 'sidebar-collapse';
        }
        if (isset($options['mini_sidebar']) && true == $options['mini_sidebar']) {
            $classList[] = 'sidebar-mini';
        }

        return implode(' ', array_filter($classList));
    }
}
