<?php

namespace handler;

use fize\log\handler\File;
use fize\log\LogHandler;
use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;

class FileTest extends TestCase
{

    public function test__construct()
    {
        $loger = new File(['path'     => '../../temp',]);
        self::assertInstanceOf(LogHandler::class, $loger);
    }

    public function testLog()
    {
        $loger = new File(['path'     => '../../temp',]);
        $loger->log(LogLevel::INFO, "你的意思是->{what}", ['what' => '再冒险一次']);
        self::assertTrue(true);
    }
}
