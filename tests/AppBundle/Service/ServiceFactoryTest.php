<?php

namespace Tests\AppBundle\Service;

use AppBundle\Service\Exception\ServiceNotFoundException;
use AppBundle\Service\Factory;
use AppBundle\Service\Mysql;
use AppBundle\Service\Redis;
use AppBundle\Service\ServiceFactory;
use AppBundle\Service\ServiceInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;

/**
 * class test for Factory services
 *
 * @package  AppBundle\Service
 * @author   Adil El Kanabi
 */
class ServiceFactoryTest extends TestCase
{
    protected $factory;
    protected $container;


    public function setUp()
    {
        parent::setUp();
        $this->factory = new ServiceFactory();

        $this->container = $this
            ->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->container
            ->expects($this->any())
            ->method('get')
            ->withAnyParameters()
            ->willReturn(null);
    }

    public function tearDown()
    {
        unset($this->factory);
        parent::tearDown();
    }

    public function testCreateMysql()
    {
        $this->assertInstanceOf(Mysql::class, $this->factory->create(Mysql::class, $this->container));
    }

    public function testCreateRedis()
    {
        $this->assertInstanceOf(Redis::class, $this->factory->create(Redis::class, $this->container));
    }

    public function testCreateNotExist()
    {
        $this->expectException(ServiceNotFoundException::class);
        $this->factory->create('Oracle', $this->container);
    }
    public function testCreateNotExistClassExist()
    {
        $this->expectException(ServiceNotFoundException::class);
        $this->factory->create(Container::class, $this->container);
    }

    public function testGetAllServices()
    {
        foreach ($this->factory->getAllServices($this->container) as $service) {
            $this->assertInstanceOf(ServiceInterface::class, $service);
        }
    }
}