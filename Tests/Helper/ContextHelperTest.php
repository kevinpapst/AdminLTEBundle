<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Tests\DependencyInjection;

use KevinPapst\AdminLTEBundle\Helper\ContextHelper;
use PHPUnit\Framework\TestCase;

class ContextHelperTest extends TestCase
{
    public function testOptions()
    {
        $context = new ContextHelper([
            'foo' => 'bar',
        ]);

        $this->assertFalse($context->hasOption('test'));
        $this->assertNull($context->getOption('test'));

        $this->assertTrue($context->hasOption('foo'));
        $this->assertEquals('bar', $context->getOption('foo'));
        $this->assertEquals(['foo' => 'bar'], $context->getOptions());

        $context->setOption('test', 'bla');
        $this->assertTrue($context->hasOption('test'));
        $this->assertEquals('bla', $context->getOption('test'));
    }
}
