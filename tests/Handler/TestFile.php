<?php

namespace Tests\Handler;

use Fize\Log\Handler\File;
use Fize\Log\LoggerHandler;
use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;

class TestFile extends TestCase
{

    public function test__construct()
    {
        $loger = new File(['path'     => '../../temp',]);
        self::assertInstanceOf(LoggerHandler::class, $loger);
    }

    public function testLog()
    {
        $loger = new File(['path'     => '../../temp',]);
        $loger->log(LogLevel::INFO, "你的意思是->{what}", ['what' => '再冒险一次']);
        self::assertTrue(true);
    }
}
