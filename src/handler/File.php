<?php

namespace fize\log\handler;

use fize\log\AbstractLog;
use Psr\Log\InvalidArgumentException;
use fize\io\File as Fso;

/**
 * 文件形式
 *
 * 文件形式日志类
 */
class File extends AbstractLog
{

    /**
     * @var array 配置
     */
    protected $config;

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
     * 可任意级别记录日志
     * @param string $level 日志级别
     * @param string $message 日志内容
     * @param array $context 占位符内容
     */
    public function log($level, $message, array $context = [])
    {
        if (!self::validLogLevel($level)) {
            throw new InvalidArgumentException();
        }

        $config = $this->config;
        $file = $config['path'] . '/' . $config['file'];
        $fso = new Fso($file, 'a+');
        if ($fso->size() >= $config['max_size']) {
            $fso->copy($config['path'], $config['file'] . '.' . time() . '.log', true);
            $fso->putContents('');
            $fso->clearstatcache();
        }

        $content = "[" . date("Y-m-d H:i:s") . "] [" . str_pad($level, 9) . "] " . self::interpolate($message, $context) . "\n";
        $fso->open();
        $fso->write($content);
        $fso->close();
    }
}
