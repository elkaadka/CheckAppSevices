<?php

namespace Tests\AppBundle\Service;

use AppBundle\Service\Redis;
use PHPUnit\Framework\TestCase;
use Predis\Client;
use Symfony\Component\DependencyInjection\Container;

/**
 * class test for Redis class
 *
 * @package  AppBundle\Service
 * @author   Adil El Kanabi
 */
class RedisTest extends TestCase
{
    public function testIsUp()
    {
        $redis =$this
            ->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();
        $redis
            ->expects($this->once())
            ->method('connect')
            ->withAnyParameters()
            ->willReturn(null);
        $redis
            ->expects($this->once())
            ->method('isConnected')
            ->withAnyParameters()
            ->willReturn(true);


        $container = $this
            ->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();
        $container
            ->expects($this->once())
            ->method('get')
            ->withAnyParameters()
            ->willReturn($redis);

        $redis = new Redis($container);

        $this->assertTrue($redis->isUp());
    }

    public function testIsUpFail()
    {
        $redis =$this
            ->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();
        $redis
            ->expects($this->once())
            ->method('connect')
            ->withAnyParameters()
            ->willReturn(null);
        $redis
            ->expects($this->once())
            ->method('isConnected')
            ->withAnyParameters()
            ->willReturn(false);


        $container = $this
            ->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();
        $container
            ->expects($this->once())
            ->method('get')
            ->withAnyParameters()
            ->willReturn($redis);

        $redis = new Redis($container);

        $this->assertFalse($redis->isUp());
    }

    public function testIsUpFailException()
    {
        $redis =$this
            ->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();
        $redis
            ->expects($this->once())
            ->method('connect')
            ->withAnyParameters()
            ->willThrowException(new \Exception('Error'));

        $container = $this
            ->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();
        $container
            ->expects($this->once())
            ->method('get')
            ->withAnyParameters()
            ->willReturn($redis);

        $redis = new Redis($container);

        $this->assertFalse($redis->isUp());
    }
}