<?php

namespace Fize\Log\Handler;

use Fize\IO\File as FizeFile;
use Fize\Log\LogAbstract;
use Psr\Log\InvalidArgumentException;

/**
 * 文件形式
 *
 * 文件形式日志类
 */
class File extends LogAbstract
{

    /**
     * @var array 配置
     */
    protected $config;

    /**
     * @var array 待写入日志
     */
    protected $logs = [];

    /**
     * 构造函数
     * @param array $config 参数
     */
    public function __construct(array $config = [])
    {
        $default_config = [
            'path'     => './data/log',
            'file'     => date('Ymd') . '.log',
            'max_size' => 2 * 1024 * 1024
        ];

        $config = array_merge($default_config, $config);
        $this->config = $config;
    }

    /**
     * 析构
     *
     * 析构时一次性写入所有日志
     */
    public function __destruct()
    {
        $this->writeToFile();
    }

    /**
     * 可任意级别记录日志
     * @param string $level   日志级别
     * @param string $message 日志内容
     * @param array  $context 占位符内容
     */
    public function log($level, $message, array $context = [])
    {
        if (!self::validLogLevel($level)) {
            throw new InvalidArgumentException();
        }

        $this->logs[] = [
            'level'   => $level,
            'message' => $message,
            'context' => $context
        ];
    }

    /**
     * 将日志写入到文件
     */
    protected function writeToFile()
    {
        $config = $this->config;
        $file = $config['path'] . '/' . $config['file'];
        $FizeFile = new FizeFile($file, 'a+');
        if ($FizeFile->getSize() >= $config['max_size']) {
            $FizeFile->copy($config['path'], $config['file'] . '.' . time() . '.log', true);
            $FizeFile->putContents('');
            $FizeFile->clearstatcache();
        }
        $content = '';
        foreach ($this->logs as $log) {
            $content .= "[" . date("Y-m-d H:i:s") . "] [" . str_pad($log['level'], 9) . "] " . self::interpolate($log['message'], $log['context']) . "\n";
        }
        $FizeFile->fwrite($content);
    }
}
