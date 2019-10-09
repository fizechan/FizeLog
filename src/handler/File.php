<?php

namespace fize\log\handler;

use fize\log\LogHandler;
use fize\io\File as Fso;

/**
 * 文件形式日志类
 * @package fize\log\handler
 */
class File implements LogHandler
{

    /**
     * @var array 配置
     */
    protected $config;

    /**
     * 构造函数
     * @param array $config 支持参数[path]
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
     * 写入日志
     * @param string $str 要写入的日志主体内容
     * @param string $type 日志类型，
     * @param array $config 传入的其他参数,支持参数[path、file、max_size]
     * @return bool
     */
    public function write($str, $type = "INF", array $config = [])
    {
        $config = array_merge($this->config, $config);
        $file = $config['path'] . '/' . $config['file'];
        $fso = new Fso($file, 'a');
        if($fso->getSize() >= $config['max_size']) {
            $fso->copy($config['path'], $config['file'] . '.' . time() . '.log', true);
            $fso->putContents('');
            $fso->clearstatcache();
        }

        $content = date("Y-m-d H:i:s") . " [" . $type . "]:" . $str . "\n";
        $fso->open();
        $rst = $fso->write($content);
        $fso->close();
        return $rst === false ? false : true;
    }
}
