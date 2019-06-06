<?php

/*
 * This file is part of the AdminLTE bundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinPapst\AdminLTEBundle\Tests\Model;

use KevinPapst\AdminLTEBundle\Model\NotificationModel;
use PHPUnit\Framework\TestCase;

class NotificationModelTest extends TestCase
{
    public function testGetIdentifier()
    {
        $sut = new NotificationModel('foo');
        $this->assertEquals('foo', $sut->getIdentifier());
        $sut->setId('42');
        $this->assertEquals('42', $sut->getIdentifier());
    }
}
