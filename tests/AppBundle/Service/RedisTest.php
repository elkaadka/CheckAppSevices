<?php

class RedisTest extends \PHPUnit\Framework\TestCase
{
    public function testIsUp()
    {
        $redis = new Redis();

        $this->assertTrue($redis->isUp());
    }

    public function testIsUpFail()
    {
        $redis = new Redis();

        $this->assertFalse($redis->isUp());
    }
}