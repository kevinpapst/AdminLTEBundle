<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Tests\Twig;

use KevinPapst\AdminLTEBundle\Twig\AdminExtension;
use PHPUnit\Framework\TestCase;

class AdminExtensionTest extends TestCase
{
    public function testGetFilters()
    {
        $sut = new AdminExtension();
        $this->assertEquals(3, \count($sut->getFilters()));
        $result = array_map(function ($filter) {
            return $filter->getName();
        }, $sut->getFilters());
        $this->assertEquals(['body_class', 'route_alias', 'text_type'], $result);
    }

    public function testGetFunctions()
    {
        $sut = new AdminExtension();
        $this->assertEquals(7, \count($sut->getFunctions()));
        $result = array_map(function ($function) {
            return $function->getName();
        }, $sut->getFunctions());
        $this->assertEquals(['adminlte_menu', 'adminlte_sidebar_user', 'adminlte_breadcrumbs', 'adminlte_notifications', 'adminlte_messages', 'adminlte_tasks', 'adminlte_user'], $result);
    }
}
