<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Tests\Model;

use KevinPapst\AdminLTEBundle\Model\TaskModel;
use PHPUnit\Framework\TestCase;

class TaskModelTest extends TestCase
{
    public function testGetIdentifier()
    {
        $sut = new TaskModel('foo');
        $this->assertEquals('foo', $sut->getIdentifier());
        $sut->setId('42');
        $this->assertEquals('42', $sut->getIdentifier());
    }
}
