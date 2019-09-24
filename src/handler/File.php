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
     * 当前日志存储路径
     * @var string
     */
    private $_path = "./data/log";

    /**
     * 构造函数
     * @param array $options,支持参数[path]
     */
    public function __construct(array $options = [])
    {
        if (isset($options['path'])) {
            $this->_path = $options['path'];
        }
    }

    /**
     * 写入日志
     * @param string $str 要写入的日志主体内容
     * @param string $type 日志类型，
     * @param array $options 传入的其他参数,支持参数[path]
     * @return bool
     */
    public function write($str, $type = "INF", array $options = [])
    {
        if (isset($options['path'])){
            $file = $options['path'];
        }else{
            $file = $this->_path . "/" . date('Ymd') . '.log';
        }
        $content = date("Y-m-d H:i:s", time()) . " [" . $type . "]:" . $str . "\n";

        $fso = new Fso($file);
        $fso->open('a');
        $rst = $fso->write($content);
        $fso->close();
        return $rst === false ? false : true;
    }
}
