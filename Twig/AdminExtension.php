<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AdminExtension extends AbstractExtension
{
    /**
     * @return TwigFilter[]
     */
    public function getFilters()
    {
        return [
            new TwigFilter('body_class', [RuntimeExtension::class, 'bodyClass']),
            new TwigFilter('route_alias', [RuntimeExtension::class, 'getRouteByAlias']),
            new TwigFilter('text_type', [RuntimeExtension::class, 'getTextType']),
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('adminlte_menu', [EventsExtension::class, 'getMenu']),
            new TwigFunction('adminlte_sidebar_user', [EventsExtension::class, 'getSidebarUser']),
        ];
    }
}
