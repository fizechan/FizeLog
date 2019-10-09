<?php

namespace app\controller;

use PHPUnit\Framework\TestCase;
use fize\log\Log;
use fize\log\LogHandler;


class LogTest extends TestCase
{

    /**
     * @var LogHandler
     */
    protected $log;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->log = Log::getInstance('File');
    }

    /**
	 * 测试1
	 */
	public function testWrite()
    {
		$rst1 = $this->log->write('cfz1');
		self::assertTrue($rst1);

        $rst2 = $this->log->write('cfz2', 'ERR');
        self::assertTrue($rst2);

        $rst3 = $this->log->write('cfz3', 'BUG', ['path' => './data/debug', 'file' => 'bug.log']);
        self::assertTrue($rst3);
	}
}
