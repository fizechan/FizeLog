<?php

namespace Tests;

use Fize\Log\LoggerFactory;
use Fize\Log\LoggerHandler;
use PHPUnit\Framework\TestCase;

class TestLoggerFactory extends TestCase
{

    public function testCreate()
    {
        $factory = new LoggerFactory();
        $loger = $factory->create('File');
        self::assertInstanceOf(LoggerHandler::class, $loger);
    }
}
