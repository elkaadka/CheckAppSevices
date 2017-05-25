<?php

namespace Tests\AppBundle\Service;

use AppBundle\Service\Mysql;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Container;

/**
 * class test for Mysql class
 *
 * @package  AppBundle\Service
 * @author   Adil El Kanabi
 */
class MysqlTest extends \PHPUnit\Framework\TestCase
{
    public function testIsUp()
    {
        $connection =$this
            ->getMockBuilder(Connection::class)
            ->disableOriginalConstructor()
            ->getMock();
        $connection
            ->expects($this->once())
            ->method('ping')
            ->withAnyParameters()
            ->willReturn(true);

        $doctrine =$this
            ->getMockBuilder(Registry::class)
            ->disableOriginalConstructor()
            ->getMock();
        $doctrine
            ->expects($this->once())
            ->method('getConnection')
            ->withAnyParameters()
            ->willReturn($connection);

        $container = $this
            ->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();
        $container
            ->expects($this->once())
            ->method('get')
            ->withAnyParameters()
            ->willReturn($doctrine);

        $mysql = new Mysql($container);

        $this->assertTrue($mysql->isUp());
    }

    public function testIsUpFail()
    {
        $connection =$this
            ->getMockBuilder(Connection::class)
            ->disableOriginalConstructor()
            ->getMock();
        $connection
            ->expects($this->once())
            ->method('ping')
            ->withAnyParameters()
            ->willReturn(false);

        $doctrine =$this
            ->getMockBuilder(Registry::class)
            ->disableOriginalConstructor()
            ->getMock();
        $doctrine
            ->expects($this->once())
            ->method('getConnection')
            ->withAnyParameters()
            ->willReturn($connection);

        $container = $this
            ->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();
        $container
            ->expects($this->once())
            ->method('get')
            ->withAnyParameters()
            ->willReturn($doctrine);

        $mysql = new Mysql($container);

        $this->assertFalse($mysql->isUp());
    }

    public function testIsUpFailWithException()
    {
        $doctrine =$this
            ->getMockBuilder(Registry::class)
            ->disableOriginalConstructor()
            ->getMock();
        $doctrine
            ->expects($this->once())
            ->method('getConnection')
            ->withAnyParameters()
            ->willThrowException(new InvalidArgumentException());

        $container = $this
            ->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();
        $container
            ->expects($this->once())
            ->method('get')
            ->withAnyParameters()
            ->willReturn($doctrine);

        $mysql = new Mysql($container);

        $this->assertFalse($mysql->isUp());
    }
}