<?php

use fize\log\Log;
use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;

class TestLog extends TestCase
{

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        new Log('File', ['path'     => '../temp',]);
    }

    public function test__construct()
    {
        new Log('File');
        self::assertTrue(true);
    }

    public function testEmergency()
    {
        Log::emergency('系统无法使用');
        self::assertTrue(true);
    }

    public function testAlert()
    {
        Log::alert('必须立即采取行动');
        self::assertTrue(true);
    }

    public function testCritical()
    {
        Log::critical('临界条件');
        self::assertTrue(true);
    }

    public function testError()
    {
        Log::error('运行时错误');
        self::assertTrue(true);
    }

    public function testWarning()
    {
        Log::warning('例外事件不是错误');
        self::assertTrue(true);
    }

    public function testNotice()
    {
        Log::notice('正常但重要的事件');
        self::assertTrue(true);
    }

    public function testInfo()
    {
        Log::info('有趣的事件');
        self::assertTrue(true);
    }

    public function testDebug()
    {
        Log::debug('详细的调试信息');
        self::assertTrue(true);
    }

    /**
	 * 测试1
	 */
	public function testLog()
    {
        Log::log('info', '测试一下');
        Log::log(LogLevel::DEBUG, 'DEBUG一下');
        //Log::log('info2', '这个是会抛出错误的');
        Log::log(LogLevel::INFO, "你的意思是->{what}", ['what' => '冒险']);

        self::assertTrue(true);
	}
}
