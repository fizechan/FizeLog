<?php

namespace Tests\Handler;

use Fize\Log\Handler\SysLog;
use Fize\Log\LoggerHandler;
use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;

class TestSysLog extends TestCase
{

    public function test__construct()
    {
        $loger = new SysLog();
        self::assertInstanceOf(LoggerHandler::class, $loger);
    }

    public function test__destruct()
    {
        $loger = new SysLog();
        unset($loger);
        self::assertTrue(true);
    }

    public function testLog()
    {
        $loger = new SysLog();
        $loger->log(LogLevel::INFO, "你的意思是->{what}", ['what' => '再冒险走一波']);
        self::assertTrue(true);
    }
}
