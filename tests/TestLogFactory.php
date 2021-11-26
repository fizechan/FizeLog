<?php

namespace Tests;

use Fize\Log\LogFactory;
use Fize\Log\LogHandler;
use PHPUnit\Framework\TestCase;

class TestLogFactory extends TestCase
{

    public function testCreate()
    {
        $loger = LogFactory::create('File');
        self::assertInstanceOf(LogHandler::class, $loger);
    }
}
