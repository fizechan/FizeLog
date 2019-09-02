<?php


namespace fize\log;

/**
 * 日志类
 * @package fize\log
 */
class Log
{

    /**
     * @var LogHandler
     */
    private static $handler;

    /**
     * 禁止构造
     */
    private function __construct()
    {
    }

    /**
     * 初始化
     * @param string $handler 处理句柄方式
     * @param array $options 配置项
     */
    public static function init($handler, array $options = [])
    {
        $class = 'fize\\log\\handler\\' . ucfirst($handler);
        self::$handler = new $class($options);
    }

    /**
     * 写入日志
     * @param string $str 要写入的日志主体内容
     * @param string $type 日志类型，
     * @param array $options 传入的其他参数
     * @return bool
     */
    public static function write($str, $type = "INF", array $options = [])
    {
        return self::$handler->write($str, $type, $options);
    }
}
