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
        $redisClient =$this
            ->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();
        $redisClient
            ->expects($this->once())
            ->method('connect')
            ->withAnyParameters()
            ->willReturn(null);
        $redisClient
            ->expects($this->once())
            ->method('isConnected')
            ->withAnyParameters()
            ->willReturn(true);

        $redis = new Redis($redisClient);

        $this->assertTrue($redis->isUp());
    }

    public function testIsUpFail()
    {
        $redisClient =$this
            ->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();
        $redisClient
            ->expects($this->once())
            ->method('connect')
            ->withAnyParameters()
            ->willReturn(null);
        $redisClient
            ->expects($this->once())
            ->method('isConnected')
            ->withAnyParameters()
            ->willReturn(false);

        $redis = new Redis($redisClient);

        $this->assertFalse($redis->isUp());
    }

    public function testIsUpFailException()
    {
        $redisClient =$this
            ->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();
        $redisClient
            ->expects($this->once())
            ->method('connect')
            ->withAnyParameters()
            ->willThrowException(new \Exception('Error'));

        $redis = new Redis($redisClient);

        $this->assertFalse($redis->isUp());
    }

    public function testGetServiceName()
    {
        $redisClient = $this
            ->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();

        $redis = new Redis($redisClient);

        $this->assertEquals($redis->getServiceName(), 'REDIS');
    }
}