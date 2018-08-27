<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Tests\DependencyInjection;

use KevinPapst\AdminLTEBundle\Helper\Constants;
use KevinPapst\AdminLTEBundle\Helper\ContextHelper;
use KevinPapst\AdminLTEBundle\Twig\AdminExtension;
use PHPUnit\Framework\TestCase;

class AdminExtensionTest extends TestCase
{
    /**
     * @param array $options
     * @return AdminExtension
     */
    protected function getSut(array $options = [])
    {
        $contextHelper = new ContextHelper();
        foreach($options as $key => $value) {
            $contextHelper->setOption($key, $value);
        }

        $routes = [
            'foo' => 'bar',
            'hello' => null,
        ];

        return new AdminExtension($contextHelper, $routes);
    }

    public function testGetFilters()
    {
        $sut = $this->getSut();
        $this->assertEquals(3, count($sut->getFilters()));
    }

    public function testGetRouteByAlias()
    {
        $sut = $this->getSut();
        $this->assertEquals('bar', $sut->getRouteByAlias('foo'));
        $this->assertEquals('hello', $sut->getRouteByAlias('hello'));
        $this->assertEquals('test1', $sut->getRouteByAlias('test1'));
    }

    public function testBodyClass()
    {
        $sut = $this->getSut([]);
        $this->assertEquals('test', $sut->bodyClass('test'));

        $sut = $this->getSut(['skin' => 'green']);
        $this->assertEquals('test green', $sut->bodyClass('test'));

        $sut = $this->getSut([
            'skin' => 'green',
            'fixed_layout' => true,
            'boxed_layout' => true,
            'collapsed_sidebar' => true,
            'mini_sidebar' => true,
        ]);
        $this->assertEquals('test green fixed layout-boxed sidebar-collapse sidebar-mini', $sut->bodyClass('test'));
    }

    public function testGetTextType()
    {
        $sut = $this->getSut();

        $this->assertEquals('text-', $sut->getTextType(''));
        $this->assertEquals('text-foo-bar', $sut->getTextType('foo-bar'));
        $this->assertEquals('text-blub', $sut->getTextType('blub'));
        $this->assertEquals('text-aqua', $sut->getTextType(Constants::TYPE_INFO));
        $this->assertEquals('text-green', $sut->getTextType(Constants::TYPE_SUCCESS));
        $this->assertEquals('text-yellow', $sut->getTextType(Constants::TYPE_WARNING));
        $this->assertEquals('text-red', $sut->getTextType(Constants::TYPE_ERROR));
    }
}
