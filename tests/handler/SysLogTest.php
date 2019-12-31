<?php

namespace handler;

use fize\log\handler\File;
use fize\log\handler\SysLog;
use fize\log\LogHandler;
use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;

class SysLogTest extends TestCase
{

    public function test__construct()
    {
        $loger = new SysLog();
        self::assertInstanceOf(LogHandler::class, $loger);
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
