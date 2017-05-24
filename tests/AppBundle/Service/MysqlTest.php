<?php

class MysqlTest extends \PHPUnit\Framework\TestCase
{
    public function testIsUp()
    {
        $mysql = new Mysql();

        $this->assertTrue($mysql->isUp());
    }

    public function testIsUpFail()
    {
        $mysql = new Mysql();

        $this->assertFalse($mysql->isUp());
    }
}