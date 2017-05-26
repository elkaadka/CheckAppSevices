<?php

namespace Tests\AppBundle\Service;

use AppBundle\Service\Mysql;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception\InvalidArgumentException;
use Doctrine\ORM\EntityManager;
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


        $entityManager = $this
            ->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $entityManager
            ->expects($this->once())
            ->method('getConnection')
            ->withAnyParameters()
            ->willReturn($connection);

        $mysql = new Mysql($entityManager);

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


        $entityManager = $this
            ->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $entityManager
            ->expects($this->once())
            ->method('getConnection')
            ->withAnyParameters()
            ->willReturn($connection);

        $mysql = new Mysql($entityManager);

        $this->assertFalse($mysql->isUp());
    }

    public function testIsUpFailWithException()
    {
        $connection =$this
            ->getMockBuilder(Connection::class)
            ->disableOriginalConstructor()
            ->getMock();
        $connection
            ->expects($this->once())
            ->method('ping')
            ->withAnyParameters()
            ->willThrowException(new InvalidArgumentException());


        $entityManager = $this
            ->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $entityManager
            ->expects($this->once())
            ->method('getConnection')
            ->withAnyParameters()
            ->willReturn($connection);

        $mysql = new Mysql($entityManager);

        $this->assertFalse($mysql->isUp());
    }

    public function testGetServiceName()
    {
        $entityManager = $this
            ->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mysql = new Mysql($entityManager);

        $this->assertEquals($mysql->getServiceName(), 'MYSQL');
    }
}