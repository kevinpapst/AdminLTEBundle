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
        $this->assertEquals(3, count($sut->getFilters()));
    }

    public function testGetFunctions()
    {
        $sut = new AdminExtension();
        $this->assertEquals(2, count($sut->getFunctions()));
    }
}
