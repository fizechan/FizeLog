<?php


namespace fize\log;

/**
 * 日志类
 * @todo 暂未遵循PSR标准
 * @package fize\log
 */
class Log
{
    const TYPE_INFO = 'INFO';

    const TYPE_ERROR = 'ERROR';

    const TYPE_DEBUG = 'DEBUG';

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
     * 取得单例
     * @param string $handler 使用的实际接口名称
     * @param array $config 配置项
     * @return LogHandler
     */
    public static function getInstance($handler, array $config = [])
    {
        if (empty(self::$handler)) {
            self::$handler = self::getNew($handler, $config);
        }
        return self::$handler;
    }

    /**
     * 新建实例
     * @param string $handler 使用的实际接口名称
     * @param array $config 配置项
     * @return LogHandler
     */
    public static function getNew($handler, array $config = [])
    {
        $class = '\\' . __NAMESPACE__ . '\\handler\\' . $handler;
        return new $class($config);
    }
}
