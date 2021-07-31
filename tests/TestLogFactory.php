<?php


use fize\log\LogFactory;
use fize\log\LogHandler;
use PHPUnit\Framework\TestCase;

class TestLogFactory extends TestCase
{

    public function testCreate()
    {
        $loger = LogFactory::create('File');
        self::assertInstanceOf(LogHandler::class, $loger);
    }
}
